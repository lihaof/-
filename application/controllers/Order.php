<?php
class Order extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->helper("common_helper");
    }

    public function add($listId = "0") {
        $listId = (int)$listId;
        $uid = 1;
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
            showNotice("预约成功");      
        } else {
            showNotice("预约失败,请返回重试");   
        }
    }

    public function test() {
        echo "Test";
    }
}