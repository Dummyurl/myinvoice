<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include APPPATH . 'third_party/Mail/class.phpmailer.php';
include APPPATH . "third_party/Mail/class.smtp.php";

class Sendmail {

    public function send($toparam = array(), $subject, $html_body, $attachment = NULL) {
        $CI = & get_instance();
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPSecure = SMTPSecure;
        $mail->Port = MAIL_PORT;
        $mail->From = MAIL_FROM_EMAIL;
        $mail->FromName = MAIL_FROM_NAME;

        if (isset($toparam) && count($toparam) > 0) {
            $to_email = $toparam['to_email'];
            $to_name = $toparam['to_name'];
        }

        $logo_img = $this->config->item("root_dir") . img_path . "/logo.png";
        $fb_img = $this->config->item("root_dir") . img_path . "/mail/long_shadowv1_12.gif";
        $google_img = $this->config->item("root_dir") . img_path . "/mail/long_shadowv1_11.gif";
        $twitter_img = $this->config->item("root_dir") . img_path . "/mail/long_shadowv1_13.gif";

        $html = '<table align="center" cellpadding="0" cellspacing="0" width="600px">
        <tr>
            <td align="center" valign="top" width="100%">

            <center>

                <table cellspacing="0" cellpadding="0" width="600" class="w320">
                    <tr>
                      <td align="center" valign="top">


                      <table style="margin:0 auto;" cellspacing="0" cellpadding="0" width="100%">
                        <tr>
                          <td style="text-align: center;">
                            <a href="#"><img class="w320" width="170" src="' . $logo_img . '" alt="company logo" ></a>
                          </td>
                        </tr>
                      </table>';

        //main content
        $html .= $html_body;

        //footer
        $html .= '<table style="margin: 0 auto;width: 80%;color: #6f6f6f;" cellspacing="0" cellpadding="0">';
        $html .= '<tr>';
        $html .= ' <td style="text-align: left;">
                    <br>
                      Thank you, <br>
                      ' . MY_SITE_NAME . '
                    </td>';
        $html .= '</tr>';
        $html .= '</table>';
//        $html .= '</center>';
        $html .= '<table cellspacing="0" cellpadding="0" bgcolor="#363636"  style="width: 100%;margin: 30px auto 0;">';
        $html .= '<tr>';
        $html .= ' <td style="background-color:#363636; text-align:center;"> <br>
                   <br>
                    <a href="https://www.facebook.com/BoulderCigs/"><img width="62" height="56" src="' . $fb_img . '"></a>
                   <br>
                  <br>
                  </td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="color:#f0f0f0; font-size: 14px; text-align:center; padding-bottom:4px;">'
                . '© ' . date("Y") . ' All Rights Reserved
                 </td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="font-size:12px;">
                    &nbsp;
                  </td>';
        $html .= '</tr>';


        $html .= '</table>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</table>';


        $mail->addAddress($to_email, $to_name);
        if ($attachment != NULL) {
            $mail->addAttachment($attachment);
        }
        $mail->WordWrap = 50;
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $html;

        if (MAIL_SWITCH == true) {
            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }
        }
    }

}
