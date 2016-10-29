<?php
class Reserve extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->model("TimeListModel");
    }
    
    public function index($year = "0", $month = "0", $day = "0") {
        //$year=$month=$day=0时,自动转为今天日期
        $list = $this->TimeListModel->fetchOneDay($year,$month,$day);
        $data["list"] = $list;
        $data["date"] = $year.'-'.$month.'-'.$day;
        $this->ui->load("Reserve",$data);
    }


    // public function index() {
    //     $this->ui->load("Reserve");
    // }
}