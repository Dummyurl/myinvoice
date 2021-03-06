<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends MX_Controller {

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
        $this->load->model('model_customer');
        $this->load->library('general');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    public function index() {
        $invoice_data = $this->model_customer->getData("", "*");
        $data['invoice_data'] = $invoice_data;
        $data['title'] = "Manage Customer";
        $this->load->view("manage_customer", $data);
    }

    public function cleandashspace($string) {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/-/', '', $string);
    }

    public function add_customer() {
        $data['title'] = "Add Customer";
        $this->load->view("add_customer", $data);
    }

    public function edit_customer() {
        $id = (int) $this->input->get("id");
        if ($id > 0) {
            $rply = $this->model_customer->getData("", "*", "ID=" . $id);

            if (count($rply) > 0) {
                $data['Customer'] = $rply[0];
                $data['title'] = "Update Customer";
                $this->load->view("edit_customer", $data);
            } else {
                $this->session->set_flashdata('failure', 'Invalid request.');
                redirect("customer");
            }
        } else {
            $this->session->set_flashdata('failure', 'Invalid request.');
            redirect("customer");
        }
    }

    public function add_invoice_action() {

        $customer_data['UserID'] = $this->UserID;
        $customer_data['Firstname'] = $this->input->post('Firstname');
        $customer_data['Lastname'] = $this->input->post('Lastname');
        $customer_data['Email'] = $this->input->post('Email');
        $customer_data['Phone'] = $this->input->post('Phone');
        $customer_data['Address'] = $this->input->post('Address');
        $customer_data['GSTno'] = $this->input->post('GSTno');
        $customer_data['CreatedOn'] = date("Y-m-d H:i:s");

        $this->form_validation->set_rules('Firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('Lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('Email', 'Email', 'valid_email');
        $this->form_validation->set_rules('Phone', 'Phone', 'required|is_unique[tbl_customer.Phone]');
        $this->form_validation->set_rules('Address', 'Address', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('add_customer');
        } else {
            $id = $this->model_customer->insert('', $customer_data);
            if ($id) {
                $this->session->set_flashdata('msg', 'Customer has been added successfully.');
                $this->session->set_flashdata('msg_class', 'success');
                redirect("customer");
            } else {
                $this->session->set_flashdata('msg', 'Unable to add customer.');
                $this->session->set_flashdata('msg_class', 'failure');
                redirect("customer");
            }
        }
    }

    public function update_invoice_action() {

        $customer_data['UserID'] = $this->UserID;
        $customer_data['Firstname'] = $this->input->post('Firstname');
        $customer_data['Lastname'] = $this->input->post('Lastname');
        $customer_data['Email'] = $this->input->post('Email');
        $customer_data['Phone'] = $this->input->post('Phone');
        $customer_data['Address'] = $this->input->post('Address');
        $customer_data['GSTno'] = $this->input->post('GSTno');
        $ID = $this->input->post('ID');
        $customer_data['CreatedOn'] = date("Y-m-d H:i:s");

        $this->form_validation->set_rules('Firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('ID', 'ID', 'required');
        $this->form_validation->set_rules('Lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('Email', 'Email', 'valid_email');
        $this->form_validation->set_rules('GSTno', 'GSTno', 'trim');
        $this->form_validation->set_rules('Phone', 'Phone', 'required|edit_customer_unique[tbl_customer.Phone.' . $ID . ']');
        $this->form_validation->set_rules('Address', 'Address', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('edit_customer');
        } else {
            $id = $this->model_customer->update('', $customer_data, "ID=" . $ID);
            if ($id) {
                $this->session->set_flashdata('msg', 'Customer has been updated successfully.');
                $this->session->set_flashdata('msg_class', 'success');
                redirect("customer");
            } else {
                $this->session->set_flashdata('msg', 'Unable to update customer.');
                $this->session->set_flashdata('msg_class', 'failure');
                redirect("customer");
            }
        }
    }

    public function delete_customer() {
        $id = (int) $this->input->get('id');
        $invoice_data = $this->model_customer->getData("tbl_invoice", "*", "CustomerID='$id'");
        if (count($invoice_data) > 0 && $invoice_data[0]['invoice_name'] != '') {
            $dirPath = INVOICE_PDF;
            if (is_dir($dirPath)) {
                $dir_handle = opendir($dirPath);
                if (!$dir_handle) {
                    return false;
                }
                while ($file = readdir($dir_handle)) {
                    if (!is_dir($dirPath . "/" . $invoice_data[0]['invoice_name']))
                        unlink($dirPath . "/" . $invoice_data[0]['invoice_name']);
                }
            }
        }
        $this->model_customer->delete('', 'ID', $id);
        $this->model_customer->delete('tbl_invoice', 'CustomerID', $id);
        $this->session->set_flashdata('msg', 'Customer has been deleted successfully.');
        $this->session->set_flashdata('msg_class', 'success');
        redirect('customer');
    }

    public function customer_status() {
        $id = (int) $this->input->get('id');
        $customer_data['Status'] = $this->input->get('status');
        $this->model_customer->update('', $customer_data, "ID=" . $id);
        $status = $this->input->get('status');
        $mess = isset($status) && $status == "A" ? "Active" : "Inactive";
        $this->session->set_flashdata('msg', "Customer has been $mess successfully.");
        $this->session->set_flashdata('msg_class', 'success');
        redirect('customer');
    }

}
