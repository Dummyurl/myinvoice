<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends MX_Controller {

    public function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
        $this->load->model('model_support');
    }

    public function index() {
        redirect('dashboard');
    }

    public function login() {
        if (!$this->session->userdata('ID')) {
            $data['title'] = "Login";
            $this->load->view('login', $data);
        } else {
            redirect('dashboard');
        }
    }

    public function login_action() {
        $postvar = $this->input->post();

        $rply = $this->model_support->authenticate($postvar['email'], md5($postvar['password']));
        if ($rply['errorCode'] == 1) {
            $this->session->set_flashdata('success', 'Welcome to ' . MY_SITE_NAME);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('failure', $rply['errorMessage']);
            redirect('login');
        }
    }

    // Forgot Password
    public function forgotpassword() {
        $this->load->view('forgot_password');
    }

    public function content_management() {

        $content_data = $this->model_support->getData("content_master", "", array(), "");
        $data['content_data'] = $content_data;
        $data['title'] = "Content Management";
        $this->load->view("content_management", $data);
    }

    public function forgotpassword_action() {
        $postvar = $this->input->post();
        $rply = $this->model_support->check_username($postvar['email']);
        $this->load->helper('string');
        $password = random_string('alnum', 10);

        if ($rply['errorCode'] == 1) {
            $define_param['to_name'] = $rply['username'];
            $define_param['to_email'] = $rply['email'];

            $userid = $rply['ID'];
            $hidenuseremail = $rply['email'];
            $hidenusername = $rply['username'];

            $update['reset_password_check'] = 0;
            $result = $this->model_support->update("tbl_admin_users", $update, "ID='" . $userid . "'");
            //Encryprt data

            $encid = $this->general->encryptData($userid);
            $encemail = $this->general->encryptData($hidenuseremail);
            $url = $this->config->item("site_url") . "reset_password_admin/?uemail=" . $encemail . "&encid=" . $encid;
            $subject = "Reset Password";

            $define_param['to_name'] = $hidenusername;
            $define_param['to_email'] = $hidenuseremail;

            $message = "Need to reset your password?";
            $content = "We have received a request to reset your password. You can <br> change your password by hitting the button below.";

            $html = '<tr>';
            $html .= '<td align="center"><h3 style="font-family: HelveticaNeue-Bold;font-size: 24px;color: #4A4A4A;letter-spacing: 0;line-height: 30px;margin-top:25px;">' . $message . '</h3>';
            $html .= '</td>';
            $html .= '</tr>';

            //content
            $image_url = $this->config->item("upload_url");
            $html .= '<tr>';
            $html .= '<td align="center"><p style="font-family: HelveticaNeue;font-size: 18px;color: #4A4A4A;letter-spacing: -0.13px;line-height: 30px;">' . $content . '<br><br>
            <a href="' . $url . '"><img src="' . $image_url . '/images/btn_reset_password.png"  height="40px"></a></p>';
            $html .= '</td>';
            $html .= '</tr>';

            $send = $this->searchmail->send($define_param, $subject, $html);
            $this->session->set_flashdata('success', 'Reset password link has been sent to your registered email.');
            redirect('login');
        } else {
            $this->session->set_flashdata('failure', $rply['errorMessage']);
            redirect('forgotpassword');
        }
    }

    public function dashboard() {
        $res = $this->authenticate->check_login();
        if (!$res) {
            redirect('login');
        }

        //remove all statement file
        foreach (new DirectoryIterator(STATEMENT_PDF) as $fileInfo) {
            if (!$fileInfo->isDot()) {
                unlink($fileInfo->getPathname());
            }
        }

        $deault_Search = true;
        $search_condition = "ID>0";
        $CustomerList = (int) $this->input->get('CustomerList');
        $MonthList = (int) $this->input->get('MonthList');
        $YearList = (int) $this->input->get('YearList');

        if ($CustomerList != "" && $CustomerList != 0) {
            $deault_Search = FALSE;
            $search_condition.=" AND CustomerID=" . $CustomerList;
        }
        if ($MonthList != "" && $MonthList != 0) {
            $deault_Search = FALSE;
            $search_condition.=" AND MONTH(CreatedOn)=" . $MonthList;
        }
        if ($YearList != "" && $YearList != 0) {
            $deault_Search = FALSE;
            $search_condition.=" AND YEAR(CreatedOn)=" . $YearList;
        }


        $invoice_data = $this->model_support->getData("tbl_invoice", "*", $search_condition);

        //get all customer
        $customer_data = $this->model_support->getData("customer", "*");

        //get all customer
        $year_data = $this->model_support->getData("tbl_invoice", "DISTINCT YEAR(`CreatedOn`) as Year", "", "", "YEAR(`CreatedOn`) ASC");

        //month list
        $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        $data['customer_data'] = $customer_data;
        $data['invoice_data'] = $invoice_data;
        $pdf_file_name = 0;
        if (count($invoice_data) > 0) {
            $pdf_file_name = $this->GeneratePDF("E", $invoice_data);
        }



        $data['months'] = $months;
        $data['pdf_file_name'] = $pdf_file_name;
        $data['deault_Search'] = $deault_Search;
        $data['year'] = $year_data;
        $data['title'] = "Manage Dashboard";
        $this->load->view("dashboard", $data);
    }

    public function profile() {
        $res = $this->authenticate->check_login();
        if (!$res) {
            redirect('login');
        }
        $id = $this->session->userdata("ID");
        $rply = $this->model_support->getData("tbl_admin_users", "*", "ID=" . $id);
        $data['all'] = $rply[0];
        $this->load->view("profile", $data);
    }

    public function profile_action() {
        $postvar = $this->input->post();

        $logged_email = $this->session->userdata('EMAIL');
        $logged_username = $this->session->userdata('UNAME');

        $id = $postvar['aid'];
        $ImageFile = $_FILES['image'];
        $val['Firstname'] = $postvar['firstname'];
        $val['Lastname'] = $postvar['lastname'];
        $val['Email'] = $postvar['email'];

        if ($postvar['chnagepass'] == "1") {
            $val['Password'] = md5($postvar['password']);
        }

        $this->model_support->update("tbl_admin_users", $val, "ID=" . $id);

        if ($ImageFile['name'] != '') {
            $redirectUrl = 'profile';
            if ($id != '') {
                $redirectUrl .= '?id=' . urlencode($this->general->encryptData($id));
            }

            $this->load->library('upload');

            $temp_folder_path = $this->config->item('upload_path') . 'admin';

            $file_name = $ImageFile['name'];

            $upload_config = array(
                'upload_path' => $temp_folder_path,
                'allowed_types' => "jpg|jpeg|gif|png", //*
                'max_size' => 1028 * 1028 * 2,
                'file_name' => $file_name,
                'remove_space' => TRUE,
                'overwrite' => True
            );

            $this->upload->initialize($upload_config);

            if ($this->upload->do_upload('image')) {
                $file_info = $this->upload->data();
                $uploadedFile = $file_info['file_name'];
                $postimg['ProfileImage'] = $uploadedFile;

                $ext_cond = 'ID ="' . $id . '"';
                $this->model_support->update("tbl_admin_users", $postimg, $ext_cond);
            } else {
                echo $this->upload->display_errors();
                exit;
            }
        }

        $this->session->set_flashdata('success', 'profile updated successfully');
        redirect("profile");
    }

    public function profile_image_delete() {
        $postvar = $this->input->post();

        $id = $postvar['id'];
        $fields = "ProfileImage,ID";
        $ext_cond = ' ID ="' . $id . '"';
        $reply = $this->model_support->getData("tbl_admin_users", $fields, array(), $ext_cond);


        $image = $reply[0]['ProfileImage'];

        if ($image != '') {
            $img = 'admin/' . $reply[0]['ID'] . '/' . $image;
            $img_path = $this->config->item('upload_path') . $img;
            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }
        $data['ProfileImage'] = '';
        $this->model_support->update("tbl_admin_users", $data, array(), $ext_cond);
    }

    public function reset_password_admin() {
        $uemail = $this->general->decryptData($_REQUEST['uemail']);
        $id = $this->general->decryptData($_REQUEST['encid']);
        $rply = $this->model_support->getData("tbl_admin_users", "*", "ID=" . $id);
        $data['email'] = $uemail;
        $data['id'] = $id;
        if ($rply[0]['reset_password_check'] == 0) {
            $update['reset_password_check'] = 1;
            $result = $this->model_support->update("tbl_admin_users", $update, "ID='" . $id . "'");

            $this->load->view("reset_password_admin", $data);
        } else {
            $this->load->view("reset_password_admin_fail", $data);
        }
    }

    public function reset_admin_action() {
        $postvar = $this->input->post();
        $id = $postvar['id'];
        $password = $postvar['password'];
        $update['Password'] = md5($password);
        $result = $this->model_support->update("tbl_admin_users", $update, "ID='" . $id . "'");
        $this->session->set_flashdata('success', 'Your password has been changed successfully');
        redirect("login");
    }

    public function reset_password_user() {
        $uemail = $this->general->decryptData($_REQUEST['uemail']);
        $id = $this->general->decryptData($_REQUEST['encid']);
        $rply = $this->model_support->getData("tbl_end_user", "*", "end_user_id=" . $id);
        $data['email'] = $uemail;
        $data['id'] = $id;
        if ($rply[0]['reset_password_check'] == 0) {
            $update['reset_password_check'] = 1;
            $result = $this->model_support->update("tbl_end_user", $update, "end_user_id='" . $id . "'");
            $this->load->view("reset_password_user", $data);
        } else {
            $this->load->view("reset_password_admin_fail", $data);
        }
    }

    public function reset_user_action() {
        $postvar = $this->input->post();
        $id = $postvar['id'];
        $password = $postvar['password'];
        $update['password'] = $password;
        $result = $this->model_support->update("tbl_end_user", $update, "end_user_id='" . $id . "'");
        $this->load->view("reset_password_success");
    }

    /* Reset password for stylist */

    public function reset_password_partner() {
        $uemail = $this->general->decryptData($_REQUEST['uemail']);
        $id = $this->general->decryptData($_REQUEST['encid']);
        $rply = $this->model_support->getData("tbl_partner", "*", "partner_id=" . $id);
        $data['id'] = $id;
        $data['email'] = $uemail;
        if ($rply[0]['reset_password_check'] == 0) {
            $update['reset_password_check'] = 1;
            $result = $this->model_support->update("tbl_partner", $update, "partner_id='" . $id . "'");
            $this->load->view("reset_password_partner", $data);
        } else {
            $this->load->view("reset_password_admin_fail", $data);
        }
    }

    public function reset_partner_action() {
        $postvar = $this->input->post();
        $id = $postvar['id'];
        $password = $postvar['password'];
        $update['password'] = $password;
        $result = $this->model_support->update("tbl_partner", $update, "partner_id='" . $id . "'");
        $this->load->view("reset_password_success");
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'logout successfully');
        redirect($this->config->item('site_url') . 'login');
    }

    public function add_content() {
        redirect('content_management');
    }

    public function update_content() {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $id = $this->general->decryptData($_REQUEST['id']);
        $content_data = $this->model_support->getData("content_master", "*", "id=" . $id);

        if (!empty($content_data)) {
            $data['title'] = "Update Content";
            $data['content_data'] = $content_data;

            $this->load->view("update_content", $data);
        } else {
            $this->session->set_flashdata('failure', "Request is in valid. Please try again.");
            redirect('content_management');
        }
    }

    public function content_update_action() {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $id = $this->input->post('id');
        $ec_id = $this->general->encryptData($id);
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('content', 'Content', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['ids'] = $id;
            $this->load->view('update_content', $data);
        } else {
            $data['content'] = $this->input->post('content');
            $result = $this->model_support->update("content_master", $data, "id=" . $id);

            $this->session->set_flashdata('success', "Content has been updated successfully.");
            redirect('content_management');
        }
    }

    public function deleteContent() {
        $id = $this->input->post('id');
        $SQL = 'DELETE FROM `content_master` WHERE id=' . $id;
        $query = $this->db->query($SQL);
        $this->session->set_flashdata('success', "Content has been deleted successfully.");
        echo true;
    }

    public function GeneratePDF($flag, $idata) {

        include APPPATH . 'third_party/PDF/statement.php';

        //create a FPDF object
        $pdf = new PDF();
        $j = 0;
        global $conn;

        $pdf->AliasNbPages();
        $pdf->AddPage();


        $pdf->SetXY(5, 50);
        $pdf->Write(10, 'Invoice Details');

        $pdf->SetXY(5, 60);
        $pdf->Cell(20, 10, 'SrNo.', 1, 0, 'C');

        $pdf->SetXY(25, 60);
        $pdf->Cell(40, 10, 'Invoice No.', 1, 0, 'C');

        $pdf->SetXY(65, 60);
        $pdf->Cell(60, 10, 'Customer Name', 1, 0, 'C');

        $pdf->SetXY(125, 60);
        $pdf->Cell(30, 10, 'Date', 1, 0, 'C');

        $pdf->SetXY(155, 60);
        $pdf->Cell(50, 10, 'Net Amount', 1, 0, 'C');

        $yval = 10;

        $spdata = array();
        $invoice_net_amount = 0;
        $srno = 1;
        foreach ($idata as $val) {
            $invoice_net_amount = $invoice_net_amount + $NetAmount;

            $pdf->SetXY(5, 60 + $yval);
            $pdf->Cell(20, 10, $srno, 1, 0, 'C');

            $pdf->SetXY(25, 60 + $yval);
            $pdf->Cell(40, 10, 'GT/' . str_pad($val['ID'], 3, 0, STR_PAD_LEFT), 1, 0, 'C');

            $pdf->SetXY(65, 60 + $yval);
            $pdf->Cell(60, 10, $val['CustomerName'], 1, 0, 'C');

            $pdf->SetXY(125, 60 + $yval);
            $pdf->Cell(30, 10, date('d/m/Y', strtotime($val['CreatedOn'])), 1, 0, 'C');

            $pdf->SetXY(155, 60 + $yval);
            $pdf->Cell(50, 10, number_format($val['NetAmount'], 2), 1, 0, 'C');
            $yval = $yval + 10;
            $srno++;
        }

        //calculate round of 

        $rounf_off = round($invoice_net_amount, 0, PHP_ROUND_HALF_EVEN);
        $rval = $rounf_off - $invoice_net_amount;

        $pdf->netTotal = $invoice_net_amount;
        $pdf->RoundOff = $rval;
        $pdf->grandTotal = $rounf_off;

        if ($flag == "E") {
            $filename = 'satetement' . uniqid() . '.pdf';
            $pdf->Output(STATEMENT_PDF . $filename, 'F');
            chmod(STATEMENT_PDF . $filename, 0777);
            return $filename;
        } else {
            $pdf->Output('satetement' . uniqid() . '.pdf', $flag);
        }
    }

}
