<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

class M_Crud extends CI_Model 
{

    private $table = 'tb_biodata';
    private $storage_path = 'storage/uploads/';


    /**
     * Form Process    
     */
    
    public function _form_data($identity = false)
    {

        $this->_form_validation();

        $prepare_data = array(
            'name' => $this->input->post('name'),
            'gender' => $this->input->post('gender'),
            'birthday' => date('Y-m-d', strtotime($this->input->post('birthday'))),
            'hobby' => $this->input->post('hobby'),
            'about' => $this->input->post('about'),
            );

        if (!empty($_FILES['photo']['name'])) 
        {

            if ($identity) 
            {

                $delete_image = $this->db->get_where($this->table,$identity)->row_array();

                $this->__delete_file($delete_image['photo']);
            }

            $upload_image = $this->__upload_file();

            if ($upload_image !== 'failed') 
            {

                $photo = $upload_image;
            }else 
            {

                echo "failed upload photo, code error";
                exit;
            }

            $photo = array('photo' => $photo);
            $data = array_merge($prepare_data,$photo);

        }else 
        {

            $data = $prepare_data;
        }

        return $data;
    } 

    public function _form_validation()
    {
        $this->form_validation->set_rules('name','name','required');
        $this->form_validation->set_rules('gender','gender','required');
        $this->form_validation->set_rules('birthday','birthday','required');        
        $this->form_validation->set_rules('hobby','hobby','required');
        $this->form_validation->set_rules('about','about','required');

        $this->form_validation->set_error_delimiters('<span>', '</span>');

        if($this->form_validation->run() != false)
        {

            return true;
        }else{

            $data = array(
              'name' => form_error('name'),
              'gender' => form_error('gender'),
              'birthday' => form_error('birthday'),
              'hobby' => form_error('hobby'),
              'about' => form_error('about'),
              );

            $this->session->set_flashdata($data);

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

    public function read_by($id)
    {

        $identity = array('id' => $id);

        return $this->db->get_where($this->table,$identity)->row_array();
    }

    public function create()
    {

        $post_data = $this->_form_data();

        $this->db->insert($this->table,$post_data);

        return ($this->db->affected_rows() > 0) ? true : false;

    }

    public function update($id)
    {


        $identity = array('id' => $id);

        $post_data = $this->_form_data($identity);

        $this->db->trans_start();
        $this->db->update($this->table, $post_data, $identity);
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

    public function delete($id)
    {

        $identity = array('id' => $id);

        $this->db->db_debug = false;
        $read = $this->db->get_where($this->table,$identity);

        if ($read->num_rows() > 0) {

            $delete_image = $read->row_array();

            $this->__delete_file($delete_image['photo']);

            $this->db->delete($this->table,$identity);        

            return ($this->db->affected_rows() > 0) ? true : false;
        }

    }


    /**
     * File Process
     */

    public function __upload_file()
    {

        $this->load->library('upload');        

        $config_upload = [
        'upload_path' => $this->storage_path,
        'allowed_types' =>'jpg|png|ico',
        ];

        $this->upload->initialize($config_upload);

        if($this->upload->do_upload('photo'))
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

    public function __delete_file($file)
    {
        @unlink($this->storage_path.$file);
        @unlink($this->storage_path.'thumbnail/'.$file);
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
