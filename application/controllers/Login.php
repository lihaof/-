<?php

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("initor");
		$this->load->model("AdministratorModel");
		$this->load->helper("form");
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
		$result = $this->AdministratorModel->checkAdministrator($user, $password);
		if ($result) {
			echo "<script>window.location.href='".site_url("manage/")."'</script>";
		}else{
			echo "<script>window.location.href='".site_url("login/")."'</script>";
		}
	}
}