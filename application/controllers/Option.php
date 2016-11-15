<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        Option.php
 *  @Author:    gAnnOn
 *  @Generate:  2016/11/07
 */
class Option extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("initor");
        $this->load->model("OptionModel");
        $this->load->helper("form");
    }

    public function index() {
		$data['option'] = $this->OptionModel->getOption();
		$data['number'] = 0;
		$data['nameNum'] = 1;

		$this->ui->load('Option',$data);
    }

    public function save_option() {
		$num = $this->OptionModel->getOptNum();
		for($i=1;$i<=$num;$i++) {
			$type = $this->OptionModel->getOptType($i);
			if ($type == 2) {
				$value = implode(";", $this->input->post("$i"));
			}else{
				$value = $this->input->post("$i");
			}
			$this->OptionModel->saveOpt($i, $value);
		}
		echo "<script>window.location.href='".site_url("option")."'</script>";
	}
}