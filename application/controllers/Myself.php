<?php
class Myself extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
    }

    public function index() {
    	$data = $this->initor->info;
        $this->ui->load("Myself", $data);
    }
}