<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

class Quote_Post extends MY_App 
{

    public $title = 'Post Quote';
    public $redirect = 'app/quote_post';

    public function __construct(){
        parent::__construct();

        $this->load->model('app/M_Quote_Post');
    }

    public function index(){

        $data['title'] = $this->lang->line('post_quote');
        $data['data_quote'] = $this->M_Quote_Post->read_data(); 

        // echo json_encode($data['data_quote']);
        // exit;
        
        $this->load->view('app/quote_post/index',$data);
    }

    public function create()
    {

        $data['title'] = $this->lang->line('post_quote_create');
        $data['update'] = false;
        $this->load->view('app/quote_post/form',$data);
    }

    public function process_create()
    {      

        # process insert
        if ($this->M_Quote_Post->insert_data() == true) {

            # set session
            $this->session->set_flashdata('create', true);

            # redirect
            redirect($this->redirect);
        } else {
            #failed insert post
        }

    }

    public function update($identity)
    {

        $data['title'] = $this->lang->line('post_quote_update');
        $data['update'] = true;
        $data['data_quote'] = $this->M_Quote_Post->get_data_update($identity); 

        $this->load->view('app/quote_post/form',$data);
    }

    public function process_update($identity)
    {      

        # process update
        if ($this->M_Quote_Post->update_data($this->input->post(),$identity) == true) {

            # set session
            $this->session->set_flashdata('edit', true);

            # redirect
            redirect($this->redirect);
        } else {
            #failed insert post
        }

    }    

    public function delete($identity)
    {

        if ($this->M_Quote_Post->delete_data($identity)) {
            # set session
            $this->session->set_flashdata('delete', true);

            # redirect
            redirect($this->redirect);
        }else {
             #failed send delete

            redirect($this->redirect);
        }

    }

    public function process_batch()
    {

        # get action
        $action =$this->input->post('action');

        
        if ($action == 'delete_batch') {

            if ($this->M_Quote_Post->delete_data_batch()) {
                # set session
                $this->session->set_flashdata('delete', true);

                redirect($this->redirect);
            }else {

                redirect($this->redirect);
            }        
        }

    }
}
