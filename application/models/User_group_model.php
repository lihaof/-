<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        User_group_model.php
 *  @Author:    CG
 *  @Generate:  2016/11/16
 */

class User_group_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('common_helper');
    }
    public function getUserGroup() {
        $this->db->select("*");
        return $this->db->get("group")->result_array();
    }

}