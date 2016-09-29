<?php

class Test extends CI_Controller {
	public function __construct() {
		$this->load->model("initor");
	}

	public function index() {
		// 模板文件放在 theme/default 目录里，如 Home.php 文件采用
		// $this->ui->load("Test") 调用
		$this->ui->load("Test");
	}
}