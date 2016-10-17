<?php
class Manage extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
    }

    public function index() {
        $this->ui->load("Manage");
    }

    public function iframe($url){
        $this->ui->load('/iframe/'.$url);
    }
}