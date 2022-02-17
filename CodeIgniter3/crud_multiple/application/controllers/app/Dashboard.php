<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

class Dashboard extends MY_App 
{


    public function index(){

        $data = [
        'title' => APP_NAME,
        ];
        
        $this->load->view('app/dashboard',$data);
    }
}
