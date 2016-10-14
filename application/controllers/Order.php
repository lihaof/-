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
        $sql = "SELECT list_id,date,start,end,price,status FROM bms_time_list WHERE list_id='{$listId}' AND status='1'";
        $query = $this->db->query($sql);
        if($query->num_rows() == 0) {
            showNotice("预约失败,请返回重试");      
        }
        $this->db->trans_start();
        $this->db->update("bms_time_list", array("uid"=>$uid, "status"=>2, "time"=>time()), array("list_id"=>$listId, "status"=>1));
        $this->db->insert("bms_user_order", array("uid"=>$uid, "list_id"=>$listId, "status"=>1, "time"=>time()));
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            //TODO:调用微信通知,添加跳转页面
            showNotice("预约成功",site_url("Order/showOrderList"));      
        } else {
            showNotice("预约失败,请返回重试",site_url("TimeList/index"));   
        }
    }

    public function showOrderList() {
        $uid = 1;    //TODO:动态获取uid
        $sql = "SELECT * FROM bms_user_order WHERE uid={$uid} order by order_id DESC";
        $query = $this->db->query($sql);
        $list = $query->result_array();
        foreach ($list as $key => &$value) {
            $sql = "SELECT start,end,price,date FROM bms_time_list WHERE list_id = {$value['list_id']}";
            $query = $this->db->query($sql);
            $queryResult = $query->row_array();
            $value = array_merge($value,$queryResult);
        }
        unset($value);
        $data = array();
        $data["list"] = $list;
        $this->ui->load("Order",$data);
    }
}