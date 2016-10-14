<?php
class TimeList extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->model("TimeListModel");
        $this->load->helper("common_helper");
    }

    public function index($year = "0", $month = "0", $day = "0") {
        //当$year=$month=$day=0时,自动转为今天日期
        $list = $this->TimeListModel->fetchOneDay($year,$month,$day);
        $data["list"] = $list;
        $this->ui->load("Admin/TimeList",$data);
    }

    public function lock($listId = 0) {
        $listId = (int)$listId;
        $this->db->update("bms_time_list", array("status" => 3), array("list_id" => $listId, "status" => 1));
        if($this->db->affected_rows()==1){
            showNotice("关闭预约成功",site_url("Admin/TimeList"));      
        } else {
            showNotice("关闭预约失败,请返回重试",site_url("Admin/TimeList"));
        }
    }
    
    public function unlock($listId = 0) {
        $listId = (int)$listId;
        $this->db->update("bms_time_list", array("status" => 1), array("list_id" => $listId, "status" => 3));
        if($this->db->affected_rows()==1){
            showNotice("开放预约成功",site_url("Admin/TimeList"));      
        } else {
            showNotice("开放预约失败,请返回重试",site_url("Admin/TimeList"));
        }
    }

    public function cancelOrder($listId = 0) {
        $listId = (int)$listId;
        $uid = 1;    //TODO:动态获取uid
        $listData = $this->listIdIsExist($listId);
        if(!$listData || $listData["status"] == 1) {
            showNotice("该记录不存在,撤销预约失败",site_url("Admin/TimeList/index"));
        } else {
            $this->db->trans_start();
            //将此时段设置为开放
            $this->db->update('bms_time_list', array("uid"=>"", "status"=>1), array("list_id"=>$listId));
            //将此用户的订单设置为撤销 
            $this->db->update('bms_user_order', array("status"=>2), array("uid"=>$uid, "list_id"=>$listId));    
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                showNotice("撤销成功",site_url("Admin/TimeList/index"));      
            } else {
                showNotice("撤销失败,请返回重试",site_url("Admin/TimeList/index"));   
            }
        }
    }

    //不存在返回false,存在返回该条记录的指定内容
    private function listIdIsExist($listId = 0) {
        $listId = (int)$listId;
        $sql = "SELECT * FROM bms_time_list WHERE list_id='{$listId}'";
        $query = $this->db->query($sql);
        $list = $query->result_array();
        if(empty($list)) {
            return false;
        }
        return $list[0];
    }
}