<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logmaster {

    public function save_log($user_id, $activity, $location) {
        $CI = & get_instance();
        $CI->load->model('user_log_model');
        $CI->load->library('user_agent');
        

        if ($CI->agent->is_browser()) {
            $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
        } elseif ($CI->agent->is_robot()) {
            $agent = $CI->agent->robot();
        } elseif ($CI->agent->is_mobile()) {
            $agent = $CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }
        $platform = $CI->agent->platform();

        $data = array(
            'date' => date("Y-m-d H:i:s"),
            'user_id' => $user_id,
            'user_ip' => isset($location['ip']) ? $location['ip'] : "",
            'city' => isset($location['city']) ? $location['city'] : "",
            'state' => isset($location['region']) ? $location['region'] : "",
            'country' => isset($location['country']) ? $location['country'] : "",
            'loc' => isset($location['loc']) ? $location['loc'] : "",
            'activity' => isset($activity) ? $activity : "",
        );
        $CI->user_log_model->insert($data);
    }

}

?>