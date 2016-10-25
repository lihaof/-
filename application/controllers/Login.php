<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        Login.php
 *  @Author:    gAnnOn
 *  @Generate:  2016/10/25
 */
class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("initor");
		$this->load->model("AdministratorModel");
		$this->load->helper("form");
		$this->load->library("session");
	}

	public function index() {
		// 模板文件放在 theme/default 目录里，如 Home.php 文件采用
		// $this->ui->load("Test") 调用
		// $this->ui->load("Test");
		$this->ui->load("login");
	}
	
    public function login_process() {
		$user = $this->input->post('user');
		$password = $this->input->post('password');
		$verify = $this->input->post('verify');
		$result1 = $this->AdministratorModel->checkAdministrator($user, $password);
		$result2 = ($verify == $this->session->tempdata("code"));
		if ($result1 && $result2) {
			echo "<script>window.location.href='".site_url("manage/index")."'</script>";
		}else{
			echo "<script>window.location.href='".site_url("login/")."'</script>";
		}
	}
}