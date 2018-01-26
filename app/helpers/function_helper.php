<?php


function get_logo() {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('tbl_setting');
    $CI->db->where('ID', 1);
    $user_data = $CI->db->get()->result_array();
    $logoName = $user_data[0]['CompanyLogo'];
    return $logoName;
}

?>
