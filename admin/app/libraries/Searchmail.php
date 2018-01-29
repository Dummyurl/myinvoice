<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include APPPATH . 'third_party/Mail/class.phpmailer.php';
//include APPPATH . "third_party/Mail/class.smtp.php";

class Searchmail {

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

        $logo_img = base_url() . "assets/images/logo.png";
        $image_url = $CI->config->item("upload_url");

        $html = '<table align="center" style="background-color:#ffffff;">';
        $html .= '<tr style="background-color:#565D64; width:575px;height:150px">';
        $html .= '<td width="575" align="center"><img src="' . $logo_img . '"  height="150px">';
        $html .= '</td>';
        $html .= '</tr>';

        //main content
        $html.=$html_body;

        //footer
        $html .= '<tr>';
        $html .= '<td align="center">';
        $html .= '<p style="font-family: HelveticaNeue;font-size: 16px;color: #4A4A4A; margin-bottom:25px;">
                If you have any questions,<br/>contact one of our representatives: <strong>+91 (903) 338-3870 </strong><br/>or send us an email <strong>hello@meghinfotech.com</strong></p>';
        $html .= '</td>';
        $html .= '</tr>';

        $html .= '</table>';
        $html .= '<table style="margin-top:25px;" align="center">';
        $html .= '<tr>';
        $html .= '<td align="center">';
        $html .= '<p style="color:#C1C7CA">' . MY_SITE_NAME . '</p>';
        $html .= '</td>';
        $html .= '</tr></table>';

        $mail->addAddress($to_email, $to_name);
        $mail->WordWrap = 50;
        $mail->isHTML(true);
        if ($attachment != NULL) {
            $mail->addAttachment($attachment);
        }
        $mail->Subject = $subject;
        $mail->Body = $html;
        if (MAIL_SWITCH == true) {
            if (!$mail->send()) {
                //Log email error message
            }
        }
    }

}
