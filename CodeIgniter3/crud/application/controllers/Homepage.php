<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

class Homepage extends MY_Site 
{

    public function __construct(){
        parent::__construct();
    }


    public function index(){

        $data = [
        'title' => APP_NAME,
        ];
        
        $this->load->view('site/homepage',$data);
    }
}
