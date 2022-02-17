<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

class M_Crud_Multiple extends CI_Model 
{

    private $table = 'tb_biodata';
    private $storage_path = 'storage/uploads/';


    /**
     * Form Process    
     */
    
    public function _form_data($identity = false)
    {

        foreach ($this->input->post('name') as $key => $x) {

            $this->_form_validation($key);

            $prepare_data = array(
                'name' => $this->input->post('name')[$key],
                'gender' => $this->input->post('gender')[$key],
                'birthday' => date('Y-m-d', strtotime($this->input->post('birthday')[$key])),
                'hobby' => $this->input->post('hobby')[$key],
                'about' => $this->input->post('about')[$key],
                );

            if ($identity) {
                $id = array('id' => $this->input->post('id')[$key]);
                $prepare_data = array_merge($prepare_data,$id);
            }            

            if (!empty($_FILES['photo']['name'][$key])) 
            {

                $upload_image = $this->__upload_file($key);


                if ($upload_image !== 'failed') 
                {

                    if ($identity) 
                    {

                        $delete_image = $this->db->get_where($this->table,$id)->row_array();

                        $this->__delete_file($delete_image['photo']);
                    }                    

                    $photo = $upload_image;

                    /**
                     * temp upload_image (succes uploaded)
                     */
                    $tmp_file[] = $upload_image;

                }else {

                    /**
                     * if upload image failed, delete all previous file
                     */
                    if (!empty($tmp_file)) {
                        $this->__delete_file($tmp_file,true);
                    }

                    $this->session->set_flashdata('validation','Oops... Failed Upload Photo.');

                    redirect($_SERVER['HTTP_REFERER']); 
                }


                $photo = array('photo' => $photo);
            }else {

                $photo = array('photo' => $this->input->post('photo_old')[$key]);
            }


            $data[] = array_merge($prepare_data,$photo);
        }   

        return $data;
    } 

    public function _form_validation($key)
    {
        $this->form_validation->set_rules("name[$key]",'name','required');
        $this->form_validation->set_rules("gender[$key]",'gender','required');
        $this->form_validation->set_rules("birthday[$key]",'birthday','required');                 
        $this->form_validation->set_rules("hobby[$key]",'hobby','required');
        $this->form_validation->set_rules("about[$key]",'about','required');

        $this->form_validation->set_error_delimiters('<span>', '</span>');

        if($this->form_validation->run() != false)
        {

            return true;
        }else{

            $this->session->set_flashdata('validation',validation_errors());

            redirect($_SERVER['HTTP_REFERER']);   
        }
    }


    /**
     * Database Process
     */

    public function read()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function read_multiple($id)
    {


        if (empty($id)) {

            redirect($_SERVER['HTTP_REFERER']);
        }else {


            $identity = explode('-', $id);

            $sql = $this->db->where_in('id', $identity)->get($this->table);

            return array(
                'count' => $sql->num_rows(),
                'data' => $sql->result_array(),
                );
        }
    }

    public function create_multiple()
    {

        $post_data = $this->_form_data();

        $this->db->insert_batch($this->table,$post_data);

        return ($this->db->affected_rows() > 0) ? true : false;

    }

    public function update_multiple()
    {


        $identity = 'id';

        $post_data = $this->_form_data($identity);

        $this->db->trans_start();
        $this->db->update_batch($this->table, $post_data, $identity);
        $this->db->trans_complete();

        if ($this->db->affected_rows() > 0) {
            return true;
        }else {
            if ($this->db->trans_status() === false) {
                return false;
            }else {                
                return true;
            }
        }   

    }    

    public function delete_batch()
    {

        if (empty($this->input->post('id'))) {

            return false;
        }else {

            foreach ($this->input->post('id') as $key => $id) {

                $identity = array('id' => $id);

                $this->db->db_debug = false;
                $read = $this->db->get_where($this->table,$identity);

                if ($read->num_rows() > 0) {

                    $delete_image = $read->row_array();

                    $this->__delete_file($delete_image['photo']);

                    $this->db->delete($this->table,$identity);        

                    $result[] = ($this->db->affected_rows() > 0) ? true : false;
                }
            }

            return true;
        }



    }


    /**
     * File Process
     */

    public function __upload_file($key)
    {

        $_FILES['photo[]']['name']     = $_FILES['photo']['name'][$key];
        $_FILES['photo[]']['type']     = $_FILES['photo']['type'][$key];
        $_FILES['photo[]']['tmp_name'] = $_FILES['photo']['tmp_name'][$key];
        $_FILES['photo[]']['error']    = $_FILES['photo']['error'][$key];
        $_FILES['photo[]']['size']     = $_FILES['photo']['size'][$key];

        $this->load->library('upload');        

        $config_upload = [
        'upload_path' => $this->storage_path,
        'allowed_types' =>'jpg|png|ico',
        'file_name' => $_FILES['photo']['name'][$key],
        ];

        $this->upload->initialize($config_upload);

        if($this->upload->do_upload('photo[]'))
        {

            $result = array('photo' => $this->upload->data());

            $create_thumb = $this->_thumbnail($result['photo']['file_name']);
            if ($create_thumb != 'success') {
                echo $create_thumb;
                exit;
            }

            return $result['photo']['file_name'];
        }else {
            return 'failed';
        }

    }

    public function __delete_file($file,$isarray = false)
    {

        if ($isarray == true) {
            foreach ($file as $x) {
                @unlink($this->storage_path.$x);
                @unlink($this->storage_path.'thumbnail/'.$x);
            }
        }else {        
            @unlink($this->storage_path.$file);
            @unlink($this->storage_path.'thumbnail/'.$file);
        }

    }


    /**
     * Image Process
     */

    public function _thumbnail($file_data)
    {

        $this->load->library('image_lib');

        $source_path = $this->storage_path.$file_data;
        $target_path = $this->storage_path.'thumbnail/';
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

}
