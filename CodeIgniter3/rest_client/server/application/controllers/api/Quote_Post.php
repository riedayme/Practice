<?php  
defined('BASEPATH') OR exit('No Direct Script');


# require REST Library
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

# use REST Class
use Restserver\Libraries\REST_Controller;

class Quote_Post extends REST_Controller {

    function __construct(){
        parent::__construct();

        $this->load->model('api/M_Quote_Post');
    }

    public function read_all_get(){ 

        $read = $this->M_Quote_Post->read_all($this->get());

        $this->response($read,REST_Controller::HTTP_OK);
    }

    public function read_by_get(){ 

        $read = $this->M_Quote_Post->read_by($this->get());

        $this->response($read,REST_Controller::HTTP_OK);
    }

    public function post_post(){

        $post = $this->M_Quote_Post->create($this->post());

        $this->response($post, REST_Controller::HTTP_OK);
    }

    public function update_post(){

        $update = $this->M_Quote_Post->update($this->post());

        $this->response($update, REST_Controller::HTTP_OK);
    }

    public function delete_by_get(){

        $delete = $this->M_Quote_Post->delete_by($this->get());

        $this->response($delete, REST_Controller::HTTP_OK);
    }

    public function delete_batch_delete(){

        $delete = $this->M_Quote_Post->delete_batch($this->delete());

        $this->response($delete, REST_Controller::HTTP_OK);
    }    

}
