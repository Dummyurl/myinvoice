<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Root extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_support');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index() {
        $this->load->view('home', $data);
    }

    public function login() {
        $data['title'] = "Login Form";
        $this->load->view('login', $data);
    }

    public function register() {
        $data['title'] = "User Registartion";
        $this->load->view('register', $data);
    }

    public function register_action() {
        $this->form_validation->set_rules('Firstname', 'Firstname ', 'required');
        $this->form_validation->set_rules('Lastame', 'Lastname ', 'required');
        $this->form_validation->set_rules('Email', 'Email Address', 'required|is_unique[tbl_users.Email]');
        $this->form_validation->set_rules('Phone', 'Phone', 'required|is_unique[tbl_users.Phone] ');
        $this->form_validation->set_rules('Username', 'Username', 'required');
        $this->form_validation->set_rules('Password', 'Password', 'required');
        $this->form_validation->set_rules('Cpassword', 'Confirm Password', 'required');
        $this->form_validation->set_error_delimiters('<div class = "error"> ', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $data = array(
                'Firstname' => $this->input->post('Firstname'),
                'Lastname' => $this->input->post('Lastame'),
                'Email' => $this->input->post('Email'),
                'Phone' => $this->input->post('Phone'),
                'Username' => $this->input->post('Username'),
                'Password' => md5($this->input->post('Password')),
                'CreatedDate' => date("Y-m-d H:i:s")
            );

            $result = $this->model_support->insert("tbl_users", $data);
            $this->session->set_flashdata('msg', "Your account has been created successfully.");
            $this->session->set_flashdata('msg_class', "success");
            redirect('login');
        }
    }

}
