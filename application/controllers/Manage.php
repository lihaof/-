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
        if(substr($url,-4) == 'html'){
        $url = substr($url,0,-5);
        }
    	$this->ui->load("iframe/".$url);
    }
}