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
        $this->load->database();
        $this->load->library("ui");
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->helper("common_helper");

        $this->load->model("Administrator_model");
        $this->load->model("Time_list_model");
    }

    public function index() {
        $data['module1'] = $this->Administrator_model->getModule(0,5);

        $this->ui->load("Manage",$data);
    }

    public function iframe($url){
        $this->ui->load('iframe/'.$url);
    }
}