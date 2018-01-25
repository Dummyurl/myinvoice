<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $res = $this->authenticate->check_login();
        if (!$res) {
            redirect('login');
        }
        $this->load->model('content/model_support');
        $this->load->model('model_settings');
        $this->load->library('general');
    }

    public function index() {
        $result = $this->model_settings->getData("", "*", "ID=1");

        $data['title'] = "Manage settings";
        $data['all'] = $result[0];
        $this->load->view("index", $data);
    }

    public function updateservice() {
        $data['specialization_name'] = trim($this->input->post('specialization_name_update'));
        $service_id = trim($this->input->post('specialization_service'));
        $data['description'] = $this->input->post('description_update');
        $specialization_id = $this->input->post('specialization_id');

        $condition = 'specialization_name = "' . $data['specialization_name'] . '" AND service_id=' . $service_id . ' AND specialization_id!=' . $specialization_id;
        $result = $this->model_settings->getData("tbl_specialization", "*", $condition);

        if (!empty($result)) {
            echo 'exist';
        } else {
            $where = "specialization_id=" . $specialization_id;
            $success = $this->model_settings->update('tbl_specialization', $data, $where);
            $this->session->set_flashdata('success', "Specialization " . $data['specialization_name'] . " has been updated successfully.");
            echo TRUE;
            exit();
        }
    }

    public function invoice_action() {
        $data['CompanyName'] = trim($this->input->post('CompanyName'));
        $data['OwnerName'] = trim($this->input->post('OwnerName'));
        $data['CompanyPhone'] = trim($this->input->post('CompanyPhone'));
        $data['CompanyMobile'] = trim($this->input->post('CompanyMobile'));
        $data['Address'] = trim($this->input->post('Address'));
        $data['City'] = trim($this->input->post('City'));
        $data['PinCode'] = trim($this->input->post('PinCode'));
        $data['GSTPercentage'] = trim($this->input->post('GSTPercentage'));
        $data['State'] = trim($this->input->post('State'));

        $where = "ID=1";
        $success = $this->model_settings->update('', $data, $where);
        $this->session->set_flashdata('success', "Setting has been updated successfully.");
        redirect("settings");
    }

}
