<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        User.php
 *  @Author:    wangtingting
 *  @Generate:  2016/10/19
 */
class User extends CI_Controller {
    public $cookietime = 24*60*60;
    public $info;
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->helper("common_helper");
    }
   
    public function index() {
       //var_dump($this->initor->info);
    }
    public function addUserinfo() {
        //完善用户界面
        $this->ui->load('adduserinfo');
    }
    
    //展示用户信息
    public function showUser() {
        $data = array();
        $data = getUser('uid', $this->initor->uid);
        $data['team_name'] = $team = getTeam('team_id',$data['team_id'],'team_name')['team_name'];
        $this->ui->load('UserInfo',$data);

    }

    //完善用户信息
    public function addUser() {
       // $data['uid'] = $this->initor->uid;
        $data['weight'] = $this->input->post('weight');
        $data['height'] = $this->input->post('height');
        $data['position'] = $this->input->post('position');
        $data['is_compelete'] = 1;
        $this->db->where('uid', $this->initor->uid);
        $result = $this->db->update('bms_user_info',$data);

        if($result == TRUE) {
            showNotice("完善成功！",site_url("User/showUser"));
        } else {
            showNotice("系统出错，请重新完善！",site_url("User/addUserinfo"));
        }
        
    }
    
    public function editPosition() {
        $data= $this->initor->info;
        $this->ui->load('editInfo/editPosition',$data);
    }
    public function editHeight() {
        $data= $this->initor->info;
        $this->ui->load('editInfo/editHeight',$data);
    }
    public function editWeight() {
        $data= $this->initor->info;
        $this->ui->load('editInfo/editWeight',$data);
    }

    //修改身高
    public function addHeight(){
       // $data['uid'] = $this->initor->uid;
        $this->db->set('height', $this->input->post('height'));
        $this->db->where('uid', $this->initor->uid);
        $result = $this->db->update('bms_user_info');     
        if($result == TRUE) {
            showNotice("完善成功！",site_url("User/showUser"));
        } else {
            showNotice("请重新完善！",site_url("User/editHeight"));
        }
    }

    //修改体重

    public function addWeight(){
        //$data['uid'] = $this->initor->uid;
        $this->db->set('weight', $this->input->post('weight'));
        $this->db->where('uid', $this->initor->uid);
        $result = $this->db->update('bms_user_info',$data);     
        if($result == TRUE) {
            showNotice("完善成功！",site_url("User/showUser"));
        } else {
            showNotice("请重新完善！",site_url("User/editWeight"));
        }
    }

    //修改场位

    public function addPosition(){
       // $data['uid'] = $this->initor->uid;
        $this->db->set('position', $this->input->post('position'));
        $this->db->where('uid', $this->initor->uid);
        $result = $this->db->update('bms_user_info',$data);     
        if($result == TRUE) {
            showNotice("完善成功！",site_url("User/showUser"));
        } else {
            showNotice("请重新完善！",site_url("User/editPosition"));
        }
    }

    


   

  

}