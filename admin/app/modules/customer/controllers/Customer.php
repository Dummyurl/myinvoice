<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_customer');
    }

    public function index() {
        $res = $this->authenticate->check_login();
        if (!$res) {
            redirect('login');
        }
        $data['title'] = "Manage Customer";
        $data['customer_data'] = $this->model_customer->getData('', "*");
        $this->load->view('index', $data);
    }

}
