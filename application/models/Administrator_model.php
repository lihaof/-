<?php

class Administrator_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getModule($pmid = "0", $level = "4") {
        $array = array('pmid' => $pmid, "level$level" => 1);
        $query= $this->db->select('*')->from('bms_module_permissions')->where($array)->order_by('display_order','ASC')->get();
        return $query->result_array();
    }

    public function checkAdministrator($user, $password) {
    	$psd = md5($password);
        $array = array('user' => $user, "password" => $psd);
        $query = $this->db->select('*')->from('bms_administrator')->where($array)->get();
    	if ($query->num_rows() == 0) {
    		return 0;
    	}else{
    		return 1;
    	}
    }
}
?>