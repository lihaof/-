<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        Manage.php
 *  @Author:    gAnnOn
 *  @Generate:  2016/10/25
 */
class BackUserGroup extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("User_group_model");
    }

    public function index() {
       
    }
    //修改
    public function editgroup() {
        $group_id   = $this->input->post("group_id");
        $group_name = $this->input->post("group_name");
        $min_point  = $this->input->post("min_point");
        $max_point  = $this->input->post("max_point");
        if($group_id && $group_name && $min_point && $max_point) {
            $data = array(
                'group_id'   => $group_id,
                'group_name' => $group_name,
                'min_point'  => $min_point,
                'max_point'  => $max_point
            );
            echo $this->db->replace("group",$data);
        } else {
            echo "获取参数失败";
        }
    }
    //新增
    public function addgroup() {
        $group_name = $this->input->post("group_name");
        $min_point  = $this->input->post("min_point");
        $max_point  = $this->input->post("max_point");
        if($group_name && $min_point && $max_point) {
            $data = array(
                'group_name' => $group_name,
                'min_point'  => $min_point,
                'max_point'  => $max_point
            );
            echo $this->db->insert("group",$data);
        } else {
            echo "获取参数失败";
        }
    }
    //删除
    public function deletegroup() {
        $group_id   = $this->input->post("group_id");
        $group_name = $this->input->post("group_name");
        $min_point  = $this->input->post("min_point");
        $max_point  = $this->input->post("max_point");
        if($group_id && $group_name && $min_point && $max_point) {
            $data = array(
                'group_id'   => $group_id,
                'group_name' => $group_name,
                'min_point'  => $min_point,
                'max_point'  => $max_point
            );
            echo $this->db->delete("group",$data);
        } else {
            echo "获取参数失败";
        }
    }
}