<?php
/**
 * Created by PhpStorm.
 * User: Vonlion
 * Date: 2016/11/12
 * Time: 下午11:45
 */
class ReserveMessage extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
    }

    public function index() {
        $this->ui->load("ReserveMessage");
    }
}