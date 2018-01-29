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
        if (!$this->session->userdata('ADMIN_ID')) {
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
            $image_url = $this->config->item("images_url");
            $html .= '<tr>';
            $html .= '<td align="center"><p style="font-family: HelveticaNeue;font-size: 18px;color: #4A4A4A;letter-spacing: -0.13px;line-height: 30px;">' . $content . '<br><br>
            <a href="' . $url . '"><img src="' . $image_url . 'btn_reset_password.png"  height="40px"></a></p>';
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

    public function profile() {
        $res = $this->authenticate->check_login();
        if (!$res) {
            redirect('login');
        }
        $id = $this->session->userdata("ADMIN_ID");
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

            $temp_folder_path = $this->config->item("upload_root_dir") . 'admin';

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
            $img_path = $this->config->item('upload_root_dir') . $img;
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

    public function logout() {
        $this->session->unset_userdata("ADMIN_ID");
        $this->session->unset_userdata("ADMIN_UNAME");
        $this->session->unset_userdata("ADMIN_FNAME");
        $this->session->unset_userdata("ADMIN_LNAME");
        $this->session->unset_userdata("ADMIN_EMAIL");
        $this->session->unset_userdata("ADMIN_IMAGE");
        $this->session->set_flashdata('success', 'logout successfully');
        redirect($this->config->item('site_url') . 'login');
    }

}
