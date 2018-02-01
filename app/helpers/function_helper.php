<?php

function get_logo() {
    $CI = & get_instance();
    $UserID = $CI->session->userdata('ID');
    $AdminID = $CI->session->userdata('ADMIN_ID');
    $Where = 0;
    if ($UserID > 0) {
        $Where = $UserID;
    } else if ($AdminID > 0) {
        $Where = $AdminID;
    }
    $CI->db->select('*');
    $CI->db->from('tbl_setting');
    $CI->db->where('UserID', $Where);
    $user_data = $CI->db->get()->result_array();
    $logoName = $user_data[0]['CompanyLogo'];
    return $logoName;
}

function CurrSymbol() {
    $CI = & get_instance();
    $UserID = $CI->session->userdata('ID');
    $AdminID = $CI->session->userdata('ADMIN_ID');
    $Where = 0;
    if ($UserID > 0) {
        $Where = $UserID;
    } else if ($AdminID > 0) {
        $Where = $AdminID;
    }
    $CI->db->select('*');
    $CI->db->from('tbl_setting');
    $CI->db->where('ID', $Where);
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

function getGstDetail() {
    $CI = & get_instance();
    $UserID = (int) $CI->session->userdata('ID');
    if ($UserID > 0) {
        $CI->db->where('UserID', $UserID);
    } else {
        $CI->db->where('ID', 1);
    }
    $CI->db->select('GSTPercentage');
    $array = $CI->db->get('tbl_setting')->result_array();
    return $array;
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

?>