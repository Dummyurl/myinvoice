<?php

class User_log_model extends CI_Model {

    private $another;

    function __construct() {
        parent::__construct();
        $this->another = $this->load->database();
    }

    public function insert($data) {
       $res =  $this->db->insert('tbl_user_log', $data);
    }
}