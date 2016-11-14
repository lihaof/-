<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        Manage.php
 *  @Author:    gAnnOn
 *  @Generate:  2016/10/25
 */
class BackUserGroup extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("AdministratorModel");
        $this->load->model("TimeListModel");
        $this->load->library("ui");
    }

    public function index() {

        $data['group'] = $this->db->get('bms_group')->result_array();

        $this->ui->load('BackUserGroup',$data);
       
    }

    public function editgroup(){
        
    }

    public function addgroup(){
        ;
    }
}