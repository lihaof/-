<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        Manage.php
 *  @Author:    weafung
 *  @Generate:  2016/11/15
 */
class Manage extends CI_Controller {

    private $user;

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->helper("form");
        $this->load->helper("common_helper");
        $this->load->library("session");
        $this->load->library("ui");
        $this->load->database();
        $this->load->model("time_list_model");
        $this->load->model("User_group_model");
    }

    public function index() {
        $token = $this->session->tempdata('token');
        $this->checkLogin($token);
        $data['module1'] = $this->getModule(0,5);
        $this->ui->load("Manage",$data);
    }

    private function checkLogin($token = '') {
        $query = $this->db->where('token',$token)->get('admin');
        if($query->num_rows()) {
            $this->user = $query->first_row('array');
        } else {
            header('location: '.site_url('Manage/login'));
            exit;
        }
    }

    public function login($doSubmit = 'no') {
        if($doSubmit == 'yes') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $verify = $this->input->post('verify');
            if($verify != $this->session->tempdata("code")) {
                showNotice('验证码错误');
            }
            if(!$username || !$password) {
                showNotice('用户名和密码不能为空');
            }
            if($this->verifyPwd($username, $password) === TRUE) {
                $token = md5($username.$password.time().rand(1000,9999));
                $this->session->set_tempdata('token', $token, 3600);
                $this->db->where('username',$username)->update('admin',array('token'=>$token));
                header('location: '.site_url('Manage/index'));
                exit;
            } else {
                showNotice('用户名或密码错误');
            }
        }
        $this->ui->load("Login");
    }

    private function verifyPwd($username,$password) {
        $user = $this->db->select('password')->where('username',$username)->get('admin')->first_row('array');
        if(md5(md5($password)) == $user['password']) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function iframe($url){
        $this->ui->load('iframe/'.$url);
    }

    private function getModule($pmid = "0", $level = "4") {
        $array = array('pmid' => $pmid, "level$level" => 1);
        $query= $this->db->where($array)->order_by('display_order','ASC')->get('bms_module_permissions');
        return $query->result_array();
    }

    public function logout(){
        $this->session->sess_destroy();
        header('location: '.site_url('Manage/index'));
        exit;
    }

}