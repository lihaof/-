<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        Manage.php
 *  @Author:    gAnnOn
 *  @Generate:  2016/10/25
 */
class Manage extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->model("AdministratorModel");
    }

    public function index() {
        $data['module1'] = $this->AdministratorModel->getModule(0,5);

        $this->ui->load("Manage",$data);
    }

    public function iframe($url){
        $this->ui->load('iframe/'.$url);
    }
}