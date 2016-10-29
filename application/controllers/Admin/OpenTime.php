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
                $data = array('success'=>true,'message'=>'添加成功');
                echo json_encode($data);
                exit;
            } else {
                $data = array('success'=>false,'message'=>'添加失败,请重新尝试');
                echo json_encode($data);
                exit;
            }
        }
    }

    private function checkOpenTimeData($data) {
        if(!$this->timeIsValid($data["start"])) {
            $data = array('success'=>false,'message'=>'开始时间格式错误');
            echo json_encode($data);
            exit;
        }
        if(!$this->timeIsValid($data["end"])) {
            $data = array('success'=>false,'message'=>'结束时间格式错误');
            echo json_encode($data);
            exit;
        }
        if(!is_numeric($data['price']) || $data['price'] < 0) {
            $data = array('success'=>false,'message'=>'收费价格错误');
            echo json_encode($data);
            exit;
        }
        if(!is_numeric($data['court_num']) || $data['court_num'] < 0) {
            $data = array('success'=>false,'message'=>'收费价格错误');
            echo json_encode($data);
            exit;
        }
    }

    private function timeIsValid($time) {
        $time = trim($time);
        $regex1 = "/^((0?[0-9])|(1[0-9]|2[0-3])):([0-5]?[0-9]):([0-5]?[0-9])$/"; //时分秒正则,合法格式1: 13:43:59
        $regex2 = "/^((0?[0-9])|(1[0-9]|2[0-3])):([0-5]?[0-9])$/"; //时分正则,合法格式2: 13:43
        if(preg_match($regex1, $time) || preg_match($regex2, $time)) {
            return true;
        } else {
            return false;
        }
    }

    public function change($submit = "no") {
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
            $this->db->update("open_time", $data);
            if($this->db->affected_rows() < 1){
                $data = array('success'=>false,'message'=>'修改失败,请重新尝试');
                echo json_encode($data);
                exit;
            } else {
                $data = array('success'=>true,'message'=>'修改成功');
                echo json_encode($data);
                exit;
            }
        }
    }

    //不存在返回false,存在返回该条记录的指定内容
    private function timeIdIsExist($timeId = 0) {
        $timeId = (int)$timeId;
        $list = $this->db->where("time_id", $timeId)->get("open_time")->row_array();
        if(empty($list)) {
            return false;
        }
        return $list;
    }

    public function del($submit = "no") { 
        if($submit == 'yes') {
            $time_id = $this->input->post('time_id');
            $this->db->delete("open_time", array("time_id" => $time_id));
            if(!$this->db->affected_rows()){
                $data = array('success'=>false,'message'=>'删除失败,请重新尝试');
                echo json_encode($data);
                exit;
            } else {
                $data = array('success'=>true,'message'=>'删除成功');
                echo json_encode($data);
                exit;
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

    public function changStatus() {
        $time_id = $this->input->post('time_id');
        $data = $this->timeIdIsExist($time_id);
        if($data) {
            $data["status"] = ($data["status"]==1) ? 2 : 1;
            $this->db->where("time_id", $time_id)->update("bms_open_time", $data);
            if($this->db->affected_rows()){
                // showNotice("启用成功",site_url("Admin/OpenTime/index"));
                $data = array('success'=>true,'message'=>'切换成功');
                echo json_encode($data);
                exit;
            } else {
                // showNotice("启用失败,请重新尝试",site_url("Admin/OpenTime/index"));
                $data = array('success'=>false,'message'=>'切换失败,请重新尝试');
                echo json_encode($data);
                exit;         
            }
        } else {
            // showNotice("启用失败,请重新尝试",site_url("Admin/OpenTime/index"));
            $data = array('success'=>false,'message'=>'切换失败,请重新尝试');
            echo json_encode($data);
            exit;       
        }
    }
    
    public function test() {
        var_dump($this->timeIsValid('14:55'));
    }
}