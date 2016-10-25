<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        OpenTime.php
 *  @Author:    Weafung
 *  @Generate:  2016/10/19
 */
class OpenTime extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->helper("common_helper");
    }

    public function index() {
        $this->db->order_by("time_id","DESC");
        $list = $this->db->get("open_time")->result_array();
        $data["list"] = $list;
        $this->ui->load("Admin/OpenTime",$data);
    }

    public function add($submit = "no") {
        if($submit == "yes") {
            $data = array(
                "start" => $this->input->post("start"),
                "end" => $this->input->post("end"),
                "price" => $this->input->post("price"),
                "court_num" => $this->input->post("court_num"),
                "time" => time(),
                "status" => 1,
            );
            $this->checkOpenTimeData($data);
            $this->db->insert("open_time", $data);
            if($this->db->insert_id() > 0) {
                // showNotice("添加成功",site_url("Admin/OpenTime/index"));
                $data = array('success'=>true,'message'=>'添加成功');
                echo json_encode($data);
                exit;
            } else {
                // showNotice("添加失败,请重新尝试");
                $data = array('success'=>false,'message'=>'添加失败,请重新尝试');
                echo json_encode($data);
                exit;
            }
        }
    }

    private function checkOpenTimeData($data) {
        if(!$this->timeIsValid($data["start"])) {
            // showNotice("开始时间格式错误");
            $data = array('success'=>false,'message'=>'开始时间格式错误');
            echo json_encode($data);
            exit;
        }
        if(!$this->timeIsValid($data["end"])) {
            // showNotice("结束时间格式错误");
            $data = array('success'=>false,'message'=>'结束时间格式错误');
            echo json_encode($data);
            exit;
        }
        if(!is_numeric($data['price']) || $data['price'] < 0) {
            // showNotice("收费价格错误");
            $data = array('success'=>false,'message'=>'收费价格错误');
            echo json_encode($data);
            exit;
        }
        if(!is_numeric($data['court_num']) || $data['court_num'] < 0) {
            // showNotice("开放球场数量");
            $data = array('success'=>false,'message'=>'收费价格错误');
            echo json_encode($data);
            exit;
        }
    }

    private function timeIsValid($time) {
        $regex1 = "/^((0?[0-9])|([1-2][0-3])):([0-5]?[0-9]):([0-5]?[0-9])$/"; //时分秒正则,合法格式1: 13:43:59
        $regex2 = "/^((0?[0-9])|([1-2][0-3])):([0-5]?[0-9])$/"; //时分正则,合法格式2: 13:43
        if(preg_match($regex1, $time) || preg_match($regex2, $time)) {
            return true;
        } else {
            return false;
        }
    }

    public function change($timeId = 0,$submit = "no") {
        if($submit == "yes") {
            $data = array(
                "start" => $this->input->post("start"),
                "end" => $this->input->post("end"),
                "price" => $this->input->post("price"),
                "court_num" => $this->input->post("court_num"),
                "time" => time(),
                "status" => 1,
            );
            $this->checkOpenTimeData($data);
            $this->db->where("time_id", $this->input->post("time_id"));
            $this->db->update("bms_open_time", $data);
            if(!$this->db->affected_rows()){
                showNotice("修改失败,请重新尝试");
            } else {
                showNotice("修改成功");
            }
        }
        $data['data'] = $this->timeIdIsExist($timeId);
        if(!$data['data']) {
            showNotice("记录不存在,请返回重试");
        }
        $this->ui->load("Admin/OpenTime_change",$data);
    }

    //不存在返回false,存在返回该条记录的指定内容
    private function timeIdIsExist($timeId = 0) {
        $timeId = (int)$timeId;
        $this->db->where("time_id", $timeId);
        $list = $this->db->get("open_time")->row_array();
        if(empty($list)) {
            return false;
        }
        return $list;
    }

    public function del($time_id = 0, $submit = "no") { 
        if($submit == 'yes') {
            $this->db->delete("open_time", array("time_id" => $time_id));
            if(!$this->db->affected_rows()){
                showNotice("删除失败,请重新尝试",site_url("Admin/OpenTime/index"));
            } else {
                showNotice("删除成功",site_url("Admin/OpenTime/index"));
            }
        }
    }

    public function lock($timeId = 0) {
        $data = $this->timeIdIsExist($timeId);
        if($data) {
            $data["status"] = 2;
            $this->db->where("time_id", $timeId);
            $this->db->update("bms_open_time", $data);
            if($this->db->affected_rows()){
                showNotice("停用成功",site_url("Admin/OpenTime/index"));
            } else {
                showNotice("停用失败,请重新尝试",site_url("Admin/OpenTime/index"));
            }
        } else {
            showNotice("停用失败,请重新尝试",site_url("Admin/OpenTime/index"));
        }
    }

    public function unlock($timeId = 0) {
        $data = $this->timeIdIsExist($timeId);
        if($data) {
            $data["status"] = 1;
            $this->db->where("time_id", $timeId);
            $this->db->update("bms_open_time", $data);
            if($this->db->affected_rows()){
                showNotice("启用成功",site_url("Admin/OpenTime/index"));
            } else {
                showNotice("启用失败,请重新尝试",site_url("Admin/OpenTime/index"));
            }
        } else {
            showNotice("启用失败,请重新尝试",site_url("Admin/OpenTime/index"));
        }
    }
    
}