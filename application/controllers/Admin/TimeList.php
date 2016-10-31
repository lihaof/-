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
        $this->load->helper("common_helper");
    }

    public function index($year = "0", $month = "0", $day = "0") {
        //当$year=$month=$day=0时,自动转为今天日期
        $list = $this->TimeListModel->fetchOneDay($year,$month,$day);
        $data["list"] = $list;
        $this->ui->load("Admin/TimeList",$data);
    }

    public function lock() {
        $listId = $this->input->post('list_id');
        $this->db->where(array("list_id" =>$listId, "status" => 1))->update("time_list", array("status" => 3));
        if($this->db->affected_rows() > 0){
            // showNotice("关闭预约成功",site_url("Admin/TimeList")); 
            $data = array('success'=>true,'message'=>'关闭预约成功');
            echo json_encode($data);
            exit;    
        } else {
            // showNotice("关闭预约失败,请返回重试",site_url("Admin/TimeList"));
            $data = array('success'=>false,'message'=>'关闭预约失败,请返回重试');
            echo json_encode($data);
            exit; 
        }
    }
    
    public function unlock() {
        $listId = $this->input->post('list_id');
        $this->db->where( array("list_id" => $listId, "status" => 3) );
        $this->db->update("time_list", array("status" => 1));
        if($this->db->affected_rows() == 1){
            // showNotice("开放预约成功",site_url("Admin/TimeList"));  
            $data = array('success'=>true,'message'=>'开放预约成功');
            echo json_encode($data);
            exit;    
        } else {
            // showNotice("开放预约失败,请返回重试",site_url("Admin/TimeList"));
            $data = array('success'=>false,'message'=>'开放预约失败,请返回重试');
            echo json_encode($data);
            exit;    
        }
    }

    public function cancelOrder($listId = 0, $uid = 0) {
        $listId = (int)$listId;
        $uid = (int)$uid;    //TODO:动态获取uid,并检查合法性
        $listData = $this->TimeListModel->listIdIsExist($listId);
        $orderData = $this->userIsOrder($listId, $uid);
        if(!$listData || !$orderData || $orderData["status"] == 2) {
            showNotice("该记录不存在,撤销预约失败",site_url("Admin/TimeList/index"));
        } else {
            $this->db->trans_start();
            //将此时段剩余场数+1
            $this->db->where( array("list_id" => $listId) );
            $this->db->update('bms_time_list', array("surplus_num"=>$listData["surplus_num"]+1));
            //将此用户的订单设置为撤销 
            $this->db->where( array("uid"=>$uid, "list_id"=>$listId));
            $this->db->update('bms_user_order', array("status"=>2));    
            $this->db->trans_complete();
            if ($this->db->trans_status() === TRUE) {
                showNotice("撤销成功",site_url("Admin/TimeList/index"));      
            } else {
                showNotice("撤销失败,请返回重试",site_url("Admin/TimeList/index"));   
            }
        }
    }


    //不存在返回false,存在返回该条记录的指定内容
    private function userIsOrder($listId = 0, $uid = 0) {
        $listId = (int)$listId;
        $uid = (int)$uid;    //TODO:动态获取uid,并检查合法性
        $this->db->where(array("list_id" => $listId, "uid" => $uid));
        $list = $this->db->get("user_order")->result_array();
        if(empty($list)) {
            return false;
        }
        return true;
    }

    public function showOrderUser($listId = 0) {
        $listId = (int)$listId;
        $this->db->where(array("list_id" => $listId,"status" => 1));
        $list = $this->db->get("user_order")->result_array();
        $data["list"] = $list;
        $this->ui->load("Admin/TimeList_showOrderUser",$data);
    }

}