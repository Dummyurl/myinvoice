<?php

function get_logo() {
    $CI = & get_instance();
    $UserID = $CI->session->userdata('ID');
    $CI->db->select('*');
    $CI->db->from('tbl_setting');
    $CI->db->where('UserID', $UserID);
    $user_data = $CI->db->get()->result_array();
    $logoName = $user_data[0]['CompanyLogo'];
    return $logoName;
}

function CurrSymbol() {
    $CI = & get_instance();
    $UserID = $CI->session->userdata('ID');
    $CI->db->select('*');
    $CI->db->from('tbl_setting');
    $CI->db->where('ID', $UserID);
    $user_data = $CI->db->get()->result_array();
    $CurrSymbol = $user_data[0]['CurrencySymbol'];
    if ($CurrSymbol == '') {
        if ($CI->session->userdata('CurrSymbol') != '') {
            $CurrSymbol = $CI->session->userdata('CurrSymbol');
        } else {
            $CurrSymbol = "$";
        }
    }
    return $CurrSymbol;
}

function get_user_details() {
    $CI = & get_instance();
    $UserID = $CI->session->userdata('ID');
    $CI->db->select('*');
    $CI->db->from('tbl_users');
    $CI->db->where('ID', $UserID);
    $user_data = $CI->db->get()->result_array();
    return $user_data[0];
}

function get_customer_details($id) {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('tbl_customer');
    $CI->db->where('ID', $id);
    $user_data = $CI->db->get()->result_array();
    return $user_data[0];
}

?>
