<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

class _Pagination extends CI_Model 
{

    public function pagination($count_bp,$max_result,$url,$segment,$display_pages = TRUE)
    {

        # load library
        $this->load->library('pagination');

        # setup config for pagination
        $config['base_url'] = $url;
        $config['total_rows'] = $count_bp;
        $config['per_page'] = $max_result;
        $config["uri_segment"] = $segment;
        $config['use_page_numbers'] = FALSE;
        $config['display_pages'] = $display_pages;
        $choice = $config["total_rows"] / $config["per_page"];

        # this is for show all number of pagination i disable because this is so longer result if have many post
        #$config["num_links"] = floor($choice);

        $config["num_links"] = 1;

        # setup for pagination style
        $config['first_link']       = $this->lang->line('first');
        $config['last_link']        = $this->lang->line('last');
        $config['next_link']        = $this->lang->line('next');
        $config['prev_link']        = $this->lang->line('prev');        

        $config['full_tag_open']    = '<nav class="c-pagination u-justify-right u-mt-medium"> <ul class="c-pagination__list">';
        $config['attributes'] = array('class' => 'c-pagination__link');
        $config['full_tag_close']   = '</ul> </nav>';

        $config['num_tag_open']     = '<li class="c-pagination__item">';
        $config['num_tag_close']    = '</li>';

        $config['cur_tag_open']     = '<li class="c-pagination__item"><span class="is-active c-pagination__link">';
        $config['cur_tag_close']    = '</span></li>';

        $config['next_tag_open']    = '<li class="c-pagination__item news">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';

        $config['prev_tag_open']    = '<li class="c-pagination__item">';
        $config['prev_tagl_close']  = 'Next</li>';

        $config['first_tag_open']   = '<li class="c-pagination__item">';
        $config['first_tagl_close'] = '</li>';

        $config['last_tag_open']    = '<li class="c-pagination__item">';
        $config['last_tagl_close']  = '</li>';


         # set config for pagination
        return array(
            'pagination' => $this->pagination->initialize($config),
            'total_pagination' => (!empty($count_bp) ? $count_bp : '0')
            );                 


    }      

}
