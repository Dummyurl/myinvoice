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
        redirect('dashboard');
    }

    public function login() {
        if (!$this->session->userdata('ID')) {
            $cookiedata = $this->cookie->read('userarray');
            $data['emailid'] = $cookiedata['user_emailid'];
            $data['password'] = $cookiedata['user_password'];
            $data['remember'] = '';

            if (is_array($cookiedata) && $cookiedata['nspl_username'] != '') {
                $data['emailid'] = $cookiedata['nspl_username'];
                $data['password'] = $cookiedata['nspl_password'];
                $data['remember'] = 'On';
            }
            $this->load->view('login', $data);
        } else {
            redirect('dashboard');
        }
    }

    public function register() {
        $data['title'] = "User Registartion";
        $this->load->view('register', $data);
    }

    public function register_action() {
        $this->form_validation->set_rules('Firstname', 'Firstname ', 'required');
        $this->form_validation->set_rules('Lastname', 'Lastname ', 'required');
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
                'Lastname' => $this->input->post('Lastname'),
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

    public function login_action() {
        $postvar = $this->input->post();
        $this->load->library('cookie');
        ///print_r($postvar);exit;
        if ($postarr['remember'] == 'on') {
            $cookiedata = array(
                'user_emailid' => $postarr['email'],
                'user_password' => $postarr['password']
            );
            $this->cookie->write('userarray', $cookiedata);
        } else {
            $cookiedata = array(
                'nspl_username' => '',
                'nspl_password' => ''
            );
            $this->cookie->write('userarray', $cookiedata);
        }
        $rply = $this->model_support->authenticate($postvar['email'], md5($postvar['password']));
        if ($rply['errorCode'] == 1) {
            $this->session->set_flashdata('success', 'Welcome to ' . MY_SITE_NAME);
            redirect('home');
        } else {
            $this->session->set_flashdata('failure', $rply['errorMessage']);
            redirect('login');
        }
    }

    // Forgot Password
    public function forgotpassword() {
        $this->load->view('forgot_password');
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
            $result = $this->model_support->update("tbl_users", $update, "ID='" . $userid . "'");
            //Encryprt data

            $encid = $this->general->encryptData($userid);
            $encemail = $this->general->encryptData($hidenuseremail);
            $url = $this->config->item("site_url") . "reset_password_user/?uemail=" . $encemail . "&encid=" . $encid;
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

    public function reset_password_user() {
        $uemail = $this->general->decryptData($_REQUEST['uemail']);
        $id = $this->general->decryptData($_REQUEST['encid']);
        $rply = $this->model_support->getData("tbl_users", "*", "ID=" . $id);
        $data['email'] = $uemail;
        $data['id'] = $id;
        if ($rply[0]['reset_password_check'] == 0) {
            $update['reset_password_check'] = 1;
            $result = $this->model_support->update("tbl_users", $update, "ID='" . $id . "'");

            $this->load->view("reset_password", $data);
        } else {
            $this->load->view("reset_password_fail", $data);
        }
    }

    public function reset_user_action() {
        $postvar = $this->input->post();
        $id = $postvar['id'];
        $password = $postvar['password'];
        $update['Password'] = md5($password);
        $result = $this->model_support->update("tbl_users", $update, "ID='" . $id . "'");
        $this->session->set_flashdata('success', 'Your password has been changed successfully');
        redirect("login");
    }

    public function logout() {
        $user_id = $this->session->userdata('ID');
        $deleted = $this->model_support->delete("tbl_login_master", "UserID=" . $user_id);
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'logout successfully');
        redirect($this->config->item('site_url') . 'login');
    }

}
