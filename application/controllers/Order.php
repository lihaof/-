<?php
class Order extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->helper("common_helper");
    }

    public function add($listId = 0) {
        $listId = (int)$listId;
        $uid = 1;    //TODO:动态获取uid
        $listData = $this->listIdIsExist($listId);
        if(!$listData) {
            showNotice("该记录不存在,请返回重试");      
        }
        $sql = "SELECT * FROM bms_user_order WHERE list_id='{$listId}' AND status='1' AND uid='{$uid}'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            showNotice("您已预约该时段,不能重复预约");      
        }
        $this->db->trans_start();
        $this->db->update("bms_time_list", array("surplus_num"=>$listData["surplus_num"]-1), array("list_id"=>$listId, "status"=>1));
        $this->db->insert("bms_user_order", array("uid"=>$uid, "list_id"=>$listId, "status"=>1, "time"=>time()));
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            //TODO:调用微信通知,添加跳转页面
            showNotice("预约成功",site_url("Order/showOrderList"));      
        } else {
            showNotice("预约失败,请返回重试",site_url("TimeList/index"));   
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

    public function showOrderList() {
        $uid = 1;    //TODO:动态获取uid
        $sql = "SELECT * FROM bms_user_order WHERE uid={$uid} order by order_id DESC";
        $query = $this->db->query($sql);
        $list = $query->result_array();
        foreach ($list as $key => &$value) {
            $sql = "SELECT * FROM bms_time_list WHERE list_id = {$value['list_id']}";
            $query = $this->db->query($sql);
            $queryResult = $query->row_array();
            unset($queryResult["status"]);
            $value = array_merge($value,$queryResult);
        }
        unset($value);
        $data = array();
        $data["list"] = $list;
        $this->ui->load("Order",$data);
    }
}