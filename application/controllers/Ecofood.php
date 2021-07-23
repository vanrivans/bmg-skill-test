<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

/*
 * Class Ecofood
 */
class Ecofood extends CI_Controller {

    var $trending = array(
                            'Lorem ipsum dolor sit amet',
                            'Consectetur adipisicing elit',
                            'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua',
                            'Ut enim ad minim veniam',
                            'Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',
                            'Sed ut perspiciatis',
                            'Unde omnis iste natus error sit voluptatem accusantium doloremque laudantium',
                            'Totam rem aperiam eaque ipsa',
                            'Nemo enim ipsam voluptatem',
                            'quia voluptas sit'
    );

    public function __construct() {
        parent::__construct();

        $this->load->model('article_model');
    }
    // End of function __construct()

    public function index() {

        $data = array(
                        'trending'  => $this->trending
        );
        
        $this->load->view('public/layout/header', $data);
        $this->load->view('public/layout/body', $data);
        $this->load->view('public/layout/footer', $data);
    }
    // End of function index

    public function detail($id) {
        
        $query = $this->article_model->get_by_id($id);

        $data = array(
                        'trending'  => $this->trending,
                        'article'   => $query,
                        'news'      => $this->article_model->get_data_article("SELECT * FROM article LIMIT 2")
        );
        
        $this->load->view('public/layout/header', $data);
        $this->load->view('public/layout/body-detail', $data);
        $this->load->view('public/layout/footer', $data);
    }
    // End of function detail

    public function get_data() {

        $query = $this->article_model->get_article_asc();

        echo json_encode($query);
    }
    // End of function get_data

}
/* End of file Ecofood.php */
/* Location: ./application/controllers/Ecofood.php/ */
