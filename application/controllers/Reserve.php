<?php
class Reserve extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
    }

    public function index() {
        $this->ui->load("Reserve");
    }
}