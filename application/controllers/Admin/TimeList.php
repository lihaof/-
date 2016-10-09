<?php
class TimeList extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->model("TimeListModel");
        $this->load->helper("common_helper");
    }

    public function index($year = "0", $month = "0", $day = "0") {
        //$year=$month=$day=0时,自动转为今天日期
        $list = $this->TimeListModel->fetchOneDay($year,$month,$day);
        $data["list"] = $list;
        $this->ui->load("Admin/TimeList",$data);
    }

    public function lock($listId = "0") {
        $listId = (int)$listId;
        $this->db->update("bms_time_list", array("status" => 3), array("list_id" => $listId, "status" => 1));
        if($this->db->affected_rows()==1){
            showNotice("关闭预约成功",site_url("Admin/TimeList"));      
        } else {
            showNotice("关闭预约失败,请返回重试",site_url("Admin/TimeList"));
        }
    }
    
    public function unlock($listId = "0") {
        $listId = (int)$listId;
        $this->db->update("bms_time_list", array("status" => 1), array("list_id" => $listId, "status" => 3));
        if($this->db->affected_rows()==1){
            showNotice("开放预约成功",site_url("Admin/TimeList"));      
        } else {
            showNotice("开放预约失败,请返回重试",site_url("Admin/TimeList"));
        }
    }
}