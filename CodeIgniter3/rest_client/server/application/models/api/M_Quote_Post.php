<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Quote_Post extends CI_Model 
{

    public $table = 'tb_quote_post';
    public $storage_path = 'storage/uploads/';

    public function count(){
        return $this->db->count_all_results($this->table, FALSE);
    }

    public function read_all($data){

        if (!empty($data['order_by']) AND !empty($data['order_type'])) {
            $this->db->order_by($data['order_by'],$data['order_type']);
        }

        $read = $this->db->get($this->table, $data['limit'] , $data['index']);

        if ($read->num_rows() > 0) {

            $extract_data = $this->extract_data($read->result_array(),true);

            $response = array(
             'status' => 'success',
             'content' => $extract_data,
             'row_count' => $this->M_Quote_Post->count()
             );            
        }else {
            $response = array (
                'status' => 'failed',
                'content' => false,
                );
        }

        return $response;        
    }

    public function read_by($data){

        if (empty($data['key']) or empty($data['value'])) {
            $response = array (
                'status' => 'failed',
                'content' => 'require key and value params',
                );

            return $response;
        }else {

            $identity = [$data['key'] => $data['value']];    

            $this->db->db_debug = false;
            $read = $this->db->get_where($this->table,$identity);

            if (empty($read)) {
                $response = array (
                    'status' => 'failed',
                    'content' => 'key not found on table',
                    );

                return $response;
            }

            if ($read->num_rows() > 0) {

                $extract_data = $this->extract_data($read->row_array(),false);

                $response = array(
                    'status' => 'success',
                    'content' => $extract_data,
                    );
            }else {

                $response = array (
                    'status' => 'failed',
                    'content' => 'value '. $data['value'] .' with key '. $data['key'] .' not found',
                    );
            }

            return $response;             
        }       
    }

    public function create($data){


        $post_data = $this->_all_column($data);

        $this->db->insert($this->table,$post_data);

        if ($this->db->affected_rows() > 0) {

            $response = array(
                'status' => 'success',
                'message' => 'success create quote post',
                );
        }else {

            $response = array(
                'status' => 'failed',
                'message' => 'failed create quote post',
                );
        }

        return $response;
    }

    public function update($data){


        $identity = [$data['key'] => $data['value']];

        if (!empty($_FILES['image'])) {
            $delete_image = $this->db->get_where($this->table,$identity)->row_array();

            @unlink($this->storage_path.$delete_image['image']);
            @unlink($this->storage_path.'thumbnail/'.$delete_image['image']);           
        }

        $post_data = $this->_all_column($data);

        $this->db->trans_start();
        $this->db->update($this->table, $post_data, $identity);
        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            $response = array(
                'status' => 'success',
                'message' => 'success update quote post',
                );
        }else {
            if ($this->db->trans_status() === false) {
                $response = array(
                    'status' => 'failed',
                    'message' => 'failed update quote post',
                    );
            }else {                
                $response = array(
                    'status' => 'success',
                    'message' => 'success update quote post',
                    );
            }
        }   

        return $response;     
    }

    public function delete_by($data) {

        if (empty($data['key']) or empty($data['value'])) {
            $response = array (
                'status' => 'failed',
                'content' => 'require key and value params',
                );

            return $response;
        }else {

            $identity = [$data['key'] => $data['value']]; 

            $this->db->db_debug = false;
            $read = $this->db->get_where($this->table,$identity);

            if (empty($read)) {
                $response = array (
                    'status' => 'failed',
                    'content' => 'key not found on table',
                    );

                return $response;
            }else {

                if ($read->num_rows() > 0) {

                    $read = $read->row_array();

                    @unlink($this->storage_path.$read['image']);
                    @unlink($this->storage_path.'thumbnail/'.$read['image']);        

                    $this->db->delete($this->table,$identity);        

                    if ($this->db->affected_rows() > 0) {

                        $response = array(
                            'status' => 'success',
                            'content' => 'success delete quote post with key ' .$data['key'] . ' and value '. $data['value'],
                            );
                    }else {

                        $response = array(
                            'status' => 'failed',
                            'content' => 'failed delete quote post with key ' .$data['key'] . ' and value '. $data['value'],
                            );
                    }


                }else {

                    $response = array (
                        'status' => 'failed',
                        'content' => 'value '. $data['value'] .' with key '. $data['key'] .' not found',
                        );
                }

                return $response;

            }

        }

    }

    public function delete_batch($data) {

        if (empty($data['key']) or empty($data['value'])) {
            $response = array (
                'status' => 'failed',
                'content' => 'require key and value params',
                );

            return $response;
        }else {

            foreach($data['value'] as $id) {

                $identity = [$data['key'] => $id]; 

                $this->db->db_debug = false;
                $read = $this->db->get_where($this->table,$identity);

                if (empty($read)) {
                    $response = array (
                        'status' => 'failed',
                        'content' => 'key not found on table',
                        );

                    return $response;
                }else {

                    if ($read->num_rows() > 0) {

                        $read = $read->row_array();

                        @unlink($this->storage_path.$read['image']);
                        @unlink($this->storage_path.'thumbnail/'.$read['image']);        

                        $this->db->delete($this->table,$identity);        

                        if ($this->db->affected_rows() > 0) {

                            $response[] = array(
                                'status' => 'success',
                                'content' => 'success delete quote post with key ' .$data['key'] . ' and value '. $id,
                                );
                        }else {

                            $response[] = array(
                                'status' => 'failed',
                                'content' => 'failed delete quote post with key ' .$data['key'] . ' and value '. $id,
                                );
                        }


                    }else {

                        $response[] = array (
                            'status' => 'failed',
                            'content' => 'value '. $id .' with key '. $data['key'] .' not found',
                            );
                    }


                }
            }

            return array(
                'status' => 'success',
                'content' => $response
                );


        }

    }    

    /**
     * 
     * logic progress
     * 
     */
    
    public function _upload($data){

        if (empty($_FILES['image'])) {
            return 'noimage';
            exit;
        }

        #load library upload
        $this->load->library('upload');        

        $config_upload = [
        'upload_path' => $this->storage_path,
        'allowed_types' =>'jpg|png|ico',
        ];

        $this->upload->initialize($config_upload);

        if($this->upload->do_upload('image')){

            $result = array('image' => $this->upload->data());

            $create_thumb = $this->_thumbnail($result['image']['file_name'],$config_upload['upload_path']);
            if ($create_thumb != 'success') {
                echo $create_thumb;
                exit;
            }

            return $result['image']['file_name'];
        }else {
            return 'failed';
        }

    }

    public function _thumbnail($file_data,$path_dir)
    {

        #load library image_lib
        $this->load->library('image_lib');
        $source_path = $path_dir.$file_data;
        $target_path = $path_dir.'thumbnail/';
        $config = array(
          'image_library' => 'gd2',
          'source_image' => $source_path,
          'new_image' => $target_path,
          'maintain_ratio' => TRUE,
          'width' => 320,
          );

        $this->image_lib->clear();
        $this->image_lib->initialize($config);

        if (!$this->image_lib->resize()) {
            return $this->image_lib->display_errors();
        }
        else {

            return 'success';
        }        
    }

    public function _all_column($data){

        # file upload
        $file = $this->_upload($data);

        $prepare_data = array(
            'title' => $data['title'] ,
            'slug' => $data['slug'] ,           
            'time' => $data['time'] ,
            'updated' => $data['updated'] ,
            'category' => $data['category'] ,
            'content' => $data['content'] ,
            'views' => $data['views'] ,
            'status' => $data['status'] ,           
            );


        if ($file !== 'noimage') {
            $prepare_data['image'] = $file;
        }

        $post_data = $prepare_data;

        return $post_data;
    }

    public function extract_data($read,$multiple){
        if ($multiple) {
            foreach ($read as $data) {
                $extract_data[] = array(
                    'id' => $data['id'],                        
                    'title' => $data['title'],
                    'slug' => $data['slug'],
                    'image' => base_url($this->storage_path.$data['image']),
                    'image_thumbnail' => base_url($this->storage_path.'thumbnail/'.$data['image']),                        
                    'time' => $data['time'],
                    'updated' => $data['updated'],
                    'category' => $data['category'],
                    'content' => $data['content'],
                    'views' => $data['views'],
                    'status' => $data['status'],
                    );
            }
        }else {

            $data = $read;

            $extract_data = array(
                'id' => $data['id'],                        
                'title' => $data['title'],
                'slug' => $data['slug'],
                'image' => base_url('storage/uploads/'.$data['image']),
                'image_thumbnail' => base_url('storage/uploads/thumbnail/'.$data['image']),                        
                'time' => $data['time'],
                'updated' => $data['updated'],
                'category' => $data['category'],
                'content' => $data['content'],
                'views' => $data['views'],
                'status' => $data['status'],
                );
        }

        return $extract_data;
    }    

}
