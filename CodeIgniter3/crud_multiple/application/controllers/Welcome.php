<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function index()
    {

        echo APP_NAME;      

        $this->load->view('welcome_message');
    }
}
