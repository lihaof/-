<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        Reserve.php
 *  @Author:    Weafung
 *  @Generate:  2016/10/19
 */
class Reserve extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->model("time_list_model");
    }
    
    public function index($year = "0", $month = "0", $day = "0") {
        //$year=$month=$day=0时,自动转为今天日期
        $list = $this->time_list_model->fetchOneDay($year,$month,$day);
        $data["list"] = $list;

        if(checkdate($month, $day, $year)) {
            $date = $year."-".$month."-".$day;
        } else {
            $date = date("Y-m-d",time());
        }
        $data["date"] = $date;

        $this->ui->load("Reserve",$data);
    }

}