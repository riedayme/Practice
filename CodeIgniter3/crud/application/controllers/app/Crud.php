<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

class Crud extends MY_App
{

    private $redirect = 'app/crud';

    public function __construct()
    {

        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('app/M_Crud');
    }

    public function index()
    {

        $data = [
        'title' => 'Module Crud',
        'biodata' => $this->M_Crud->read(),
        ];

        $this->load->view('app/crud/index',$data);
    }

    public function create()
    {

        $data = [
        'title' => 'Create Data',
        'update' => false,
        ];

        $this->load->view('app/crud/form',$data); 
    }

    public function process_create()
    {

        $create = $this->M_Crud->create();

        if ($create == TRUE) {

            $this->session->set_flashdata('create', true);
        }
        else {

            $this->session->set_flashdata('create', 'failed');
        }    

        redirect($this->redirect);
    }

    public function update($id)
    {

        $data = [
        'title' => 'Update Data',
        'update' => true,
        'biodata' => $this->M_Crud->read_by($id),
        ];

        $this->load->view('app/crud/form',$data);
    }

    public function process_update($id)
    {

        if ($this->M_Crud->update($id) == TRUE) {

            $this->session->set_flashdata('edit', true);
        }else {

            $this->session->set_flashdata('edit', 'failed');
        }     

        redirect($this->redirect);   
    }

    public function process_delete($id)
    {


        if ($this->M_Crud->delete($id) == TRUE) {

            $this->session->set_flashdata('delete', true);
        }else {

            $this->session->set_flashdata('delete', true);
        }     

        redirect($this->redirect);
    }
}

?>
