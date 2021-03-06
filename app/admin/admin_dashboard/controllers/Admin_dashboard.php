<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_dashboard extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_dashboard');
    }

    public function index() {
        $res = $this->authenticate->check_admin();
        if (!$res) {
            redirect('admin-login');
        }
        $data['title'] = "Dashboard";
        $data['total_user'] = $this->model_dashboard->TotalCount('tbl_users', "*");
        $data['total_customer'] = $this->model_dashboard->TotalCount('tbl_customer', "*");
        $this->load->view('index', $data);
    }

}
