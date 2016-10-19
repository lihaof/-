<?php
class AdministratorModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getModule($pmid = "0", $level = "4") {
        $sql = "SELECT * FROM bms_module_permissions WHERE pmid = '$pmid' and level$level = 1 ORDER BY display_order ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function checkAdministrator($user, $password) {
    	$psd = md5($password);
    	$sql = "SELECT * FROM bms_administrator WHERE user = '$user' and password = '$psd'";
    	$query = $this->db->query($sql);
    	if ($query->num_rows() == 0) {
    		return 0;
    	}else{
    		return 1;
    	}
    }
}
?>