<?php
/**
 *	Basketball Management System 1.0
 *
 *	@Id: 		Admin/Team.php
 *	@Author: 	CG
 *	@Generate:	2016/10/19
 */
class Team extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("initor");
		$this->load->database();
        $this->load->helper("common_helper");
	}
	public function index() {
		$data["team"] = $this->getTeamInfo();
		$this->ui->load("Admin/Team",$data);
	}
	/**
	 *显示球队所有信息
	 *@param 
	 *@return teamInfo
	 */
	public function getTeamInfo() {
		$this->db->select("*");
		$this->db->from("team");
		return $this->db->get()->result_array();
	}
	/**
	 *根据球队id获取所有球员列表
	 *@param $team_id
	 *@return uid
	 */
	public function getTeammate() {
		$team_id = $this->input->post("team_id");
		$this->db->select("*");
		$this->db->where("team_id",$team_id);
		$this->db->from("team_memmber");
		echo json_encode($this->db->get()->result_array());
	}
	/**
	 *后台审核,申请通过
	 *@param $team_id
	 *@return boolean
	 */
	public function verifyTeam() {
		$team_id = $this->input->get('team_id');
		$team_status = 1;
		$this->db->where("team_id",$team_id);
		$this->db->set("team_status",$team_status);
		if($this->db->update("team")) {
			return true;
		} else {
			return false;
		}
	}

}