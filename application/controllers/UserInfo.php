<?php
class BackUserInfo extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library("ui");
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->helper("common_helper");
    }

    public function index() {


        $this->ui->load("BackUserInfo");
    }

    public function editUserinfo() {
    	$this->ui->load
    }
}