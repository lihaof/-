<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        TimeList.php
 *  @Author:    Weafung
 *  @Generate:  2016/10/19
 */
class TimeList extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->model("TimeListModel");
    }
    
    public function index($year = "0", $month = "0", $day = "0") {
        //$year=$month=$day=0时,自动转为今天日期
        $list = $this->TimeListModel->fetchOneDay($year,$month,$day);
        $data["list"] = $list;
        $this->ui->load("TimeList",$data);
    }

}