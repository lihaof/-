<?php

/**
 *	Basketball Management System 1.0
 *
 *	@Id: 		Initor.php
 *	@Author: 	RuphiLau
 *	@Generate:	2016/09/29
 */

class Initor extends CI_Model {
	public function __construct() {
		parent::__construct();

		$this->load->database();

		$this->load->library("ui");
		$this->load->helper("url");
	}
}