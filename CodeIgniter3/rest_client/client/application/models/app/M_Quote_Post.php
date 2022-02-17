<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

# define guzzle
use GuzzleHttp\Client;

class M_Quote_Post extends CI_Model 
{

    private $client;
    private $auth;    
    private $app_key;
    private $storage_path = 'storage/';

    public function __construct(){
        parent::__construct();

        $this->auth = ['admin','admin'];
        $this->app_key = 'admin';

        $this->client = new Client([
            'base_uri' => 'http://localhost/rest_server/api/quote_post/',
            'auth' => $this->auth,
            'query' => ['APP_KEY' => $this->app_key],
            ]);
    }

    public function read_data(){

        $curent_page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;    
        $get_display = $this->input->get('display');
        $display = !empty($get_display) ? $get_display : 5;

        $data = ['query' => ['order_by' => 'id','order_type' => 'DESC','limit' => $display,'index' => $curent_page, 'APP_KEY' => $this->app_key]];

        $read_data = $this->client->request('GET','read_all', $data);

        if ($read_data->getStatusCode() == '200') {

            $result = json_decode($read_data->getBody()->getContents(), TRUE);

            if ($result['status'] == 'failed') {
                return array(
                    'content' => false,
                    'pagination' => false,
                    'total_pagination' => '0'
                    );
            }else {

                $this->load->model('_Pagination');
                $get_pagination = $this->_Pagination->pagination(@$result['row_count'],$display,base_url('app/quote_post/index'),4);

                $result = array(
                    'content' => (!empty($result['content'])) ? $result['content'] : false,
                    'pagination' => $get_pagination['pagination']->create_links(),
                    'total_pagination' => $get_pagination['total_pagination']
                    );

                return $result;
            }
            

        }else {
            return false;
        }        
    }

    public function insert_data(){

        $data = $this->input->post();

        # create image
        $image = $this->__upload_file($data);

        # send data
        $insert_data = $this->client->request('POST', 'post', $this->__all_column($data,$image));

        if ($insert_data->getStatusCode() == '200') {
            $result = json_decode($insert_data->getBody()->getContents(), TRUE);

            if ($result['status'] == 'success') {
                $status =  true;
            }else{
                $status =  false;
            }
        }else {
            $status = false;
        }

        #delete temp file
        unlink($image);

        if ($status) {
            return true;
        }else{
            return false;
        }

    }

    public function get_data_update($identity) {

        $data = ['query' => ['key' => 'id', 'value' => $identity, 'APP_KEY' => $this->app_key]];

        $read_data = $this->client->request('GET','read_by', $data);
        
        if ($read_data->getStatusCode() == '200') {
            $result = json_decode($read_data->getBody()->getContents(), TRUE);

            if ($result['status'] == 'failed') {
                return false;
            }else {

                $data = $result['content'];

                return array(
                    'id' => $data['id'],
                    'title' => $data['title'],
                    'slug' => $data['slug'],
                    'image' => $data['image'],
                    'image_thumbnail' => $data['image_thumbnail'],
                    'time' => $data['time'],
                    'updated' => $data['updated'],
                    'category' => $data['category'],
                    'content' => $data['content'],
                    'views' => $data['views'],
                    'status' => $data['status'],
                    );
            }
        }else {
            return false;
        }  

    }

    public function update_data($data,$identity){

        # create image
        $image = $this->__upload_file($data);     

        $put_data = $this->__all_column($data,$image,$identity);

        # send data
        $update_data = $this->client->request('POST', 'update', $put_data);

        if ($update_data->getStatusCode() == '200') {
            $result = json_decode($update_data->getBody()->getContents(), TRUE);

            if ($result['status'] == 'success') {
                $status =  true;
            }else{
                $status =  false;
            }
        }else {
            $status = false;
        }

        #delete temp file
        unlink($image);

        if ($status) {
            return true;
        }else{
            return false;
        }

    }    


    public function delete_data($identity){

        # build data
        $data = ['query' => ['key' => 'id', 'value' => $identity, 'APP_KEY' => $this->app_key]];

        # send request
        $delete_data = $this->client->request('GET', 'delete_by', $data);

        if ($delete_data->getStatusCode() == '200') {

            $result = json_decode($delete_data->getBody()->getContents(), TRUE);

            if ($result['status'] == 'failed') {
                return false;
            }else {
                return true;
            }
        }else {
            return false;
        }   
    }

    public function delete_data_batch(){

        # build data
        $id_array = $this->input->post('id');

        $data = ['form_params' => ['key' => 'id', 'value' => $id_array, 'APP_KEY' => $this->app_key]];

        # send request
        $delete_data = $this->client->request('DELETE', 'delete_batch', $data);

        if ($delete_data->getStatusCode() == '200') {

            $result = json_decode($delete_data->getBody()->getContents(), TRUE);

            if ($result['status'] == 'failed') {
                return false;
            }else {
                return true;
            }
        }else {
            return false;
        }   

    }



    /**
     * logic process
     */
    
    public function __upload_file($data){

        // disable this because if the image update alyaws update image
        if (empty($_FILES['image']['name'])) {            
            return 'noimage';
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
            $path_image = $this->storage_path.$result['image']['file_name'];
            return $path_image;
        }else {
            return 'failed';
        }

    }

    public function __all_column($data,$image,$identity = false){

        $prepare_data = [
        'multipart' => [  
        [
        'name' => 'key',
        'contents' => 'id'
        ],         
        [
        'name' => 'value',
        'contents' => $identity
        ],                   
        [
        'name' => 'title',
        'contents' => strip_tags($data['title'])
        ],
        [
        'name' => 'slug',
        'contents' => strip_tags($data['slug'])
        ],
        [
        'name' => 'time',
        'contents' => date('Y-m-d H:i:s')
        ],
        [
        'name' => 'updated',
        'contents' => date('Y-m-d H:i:s')
        ],
        [
        'name' => 'category',
        'contents' => $data['category']
        ],
        [
        'name' => 'content',
        'contents' => strip_tags($data['content'])
        ],
        [
        'name' => 'views',
        'contents' => 0
        ],
        [
        'name' => 'status',
        'contents' => strip_tags($data['status'])
        ],
        [
        'name' => 'APP_KEY',
        'contents' => $this->app_key
        ]
        ]];

        if ($image == 'noimage') {
            $data = $prepare_data;
        }else {
            $data = array_merge_recursive($prepare_data,
                [
                'multipart' => [
                [
                'name' => 'image',
                'filename' => $image,
                'contents' => file_get_contents($image)
                ]
                ]]);
        }

        return $data;
    }

}
