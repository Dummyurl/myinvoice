<?php

class MY_Form_validation extends CI_Form_validation {

    public function edit_unique($str, $field) {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return isset($this->CI->db) ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id))->num_rows() === 0) : FALSE;
    }

    public function edit_customer_unique($str, $field) {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return isset($this->CI->db) ? ($this->CI->db->limit(1)->get_where($table, array($field => $str, 'ID !=' => $id))->num_rows() === 0) : FALSE;
    }

}
