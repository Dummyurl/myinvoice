<?php

function get_logo() {
    $CI = & get_instance();
    $UserID = $CI->session->userdata('ADMIN_ID');
    $CI->db->select('*');
    $CI->db->from('tbl_setting');
    $CI->db->where('UserID', $UserID);
    $user_data = $CI->db->get()->result_array();
    $logoName = $user_data[0]['CompanyLogo'];
    return $logoName;
}

function CurrSymbol() {
    $CI = & get_instance();
    $UserID = $CI->session->userdata('ADMIN_ID');
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

function get_admin_details() {
    $CI = & get_instance();
    $UserID = $CI->session->userdata('ADMIN_ID');
    $CI->db->select('*');
    $CI->db->from('tbl_admin_users');
    $CI->db->where('ID', $UserID);
    $user_data = $CI->db->get()->result_array();
    return $user_data[0];
}

function getGstDetail() {
    $CI = & get_instance();
    $CI->db->select('GSTPercentage');
    $CI->db->where('ID', 1);
    $array = $CI->db->get('tbl_setting')->result_array();
    return $array;
}

?>
