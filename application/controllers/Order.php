<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        TimeList.php
 *  @Author:    Weafung
 *  @Generate:  2016/10/19
 */
class Order extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->helper("common_helper");
        $this->load->model("time_list_model");
    }

    public function add($listId = 0) {
        $listId = (int)$listId;
        $uid = $this->initor->uid;
        $listData = $this->time_list_model->listIdIsExist($listId);
        if(!$listData) {
            showNotice("该记录不存在,请返回重试");      
        }
        $this->db->where( array("list_id"=>$listId, "status"=>1, "uid"=>$uid) );
        if($this->db->get("user_order")->num_rows() > 0) {
            showNotice("您已预约该时段,不能重复预约");      
        }
        $this->db->trans_start();
        //更新剩余球场数量
        $this->db->set('`surplus_num`', '`surplus_num`-1', FALSE)->where(array("list_id"=>$listId, "status"=>1))->update("time_list");
        //添加至用户预定记录
        $this->db->insert("user_order", array("uid"=>$uid, "list_id"=>$listId, "status"=>1, "time"=>time()));
        $this->db->trans_complete();
        if ($this->db->trans_status() === TRUE) {
            //TODO:调用微信通知
            showNotice("预约成功",site_url("Order/showOrderList"));      
        } else {
            showNotice("预约失败,请返回重试",site_url("Resreve/index"));   
        }
    }

    public function showOrderList() {
        $uid = $this->initor->uid;
        $this->db->order_by("order_id","DESC");
        $this->db->where('uid', $uid);
        $list = $this->db->get("user_order")->result_array();
        foreach ($list as $key => &$value) {
            $this->db->where('list_id', $value['list_id']);
            $queryResult = $this->db->get("time_list")->row_array();
            unset($queryResult["status"]);
            $value = array_merge($value,$queryResult);
        }
        $data["list"] = $list;
        $this->ui->load("ReserveMessage",$data);
    }
}