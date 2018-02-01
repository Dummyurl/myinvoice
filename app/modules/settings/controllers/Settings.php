<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MX_Controller {

    private $UserID;

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $res = $this->authenticate->check_login();
        if (!$res) {
            redirect('login');
        }
        $this->UserID = (int) $this->session->userdata('ID');
        $this->load->model('content/model_support');
        $this->load->model('model_settings');
        $this->load->library('general');
    }

    public function index() {
        $result = $this->model_settings->getData("", "*", "UserID=$this->UserID");
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
        $data['GSTNo'] = trim($this->input->post('GSTNo'));
        $data['State'] = trim($this->input->post('State'));
        $data['CurrencySymbol'] = $this->input->post('CurrencySymbol');
        $this->session->set_userdata("CurrSymbol", $this->input->post('CurrencySymbol'));

        if (isset($_FILES['CompanyLogo']) && $_FILES['CompanyLogo']['name'] != '') {
            $uploadPath = 'assets/upload/images';
            $tmp_name = $_FILES["CompanyLogo"]["tmp_name"];
            $temp = explode(".", $_FILES["CompanyLogo"]["name"]);
            $newfilename = (uniqid()) . '.' . end($temp);
            move_uploaded_file($tmp_name, "$uploadPath/$newfilename");

            $data['CompanyLogo'] = $newfilename;
        }
        $get_result = $this->model_settings->getData("", "*", "UserID=$this->UserID");
        if (count($get_result) > 0) {
            $where = "UserID=$this->UserID";
            $success = $this->model_settings->update('', $data, $where);
            $action= "updated";
        } else {
            $data['UserID'] = $this->UserID;
            $id = $this->model_settings->insert('', $data);
            $action= "inserted";
        }
        $this->session->set_flashdata('success', "Setting has been $action successfully.");
        redirect("settings");
    }

}
