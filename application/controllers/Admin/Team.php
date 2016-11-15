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
		$this->load->database();
		$this->load->library("ui");
		$this->load->helper("url");
        $this->load->helper("common_helper");
	}
	public function index() {
		$data["noauteam"] = $this->getNoAudiedTeamInfo();
		$data["auteam"]   = $this->getAudiedTeamInfo();
		$this->ui->load("iframe/IframeTeam",$data);
	}
	/**
	 *显示未审核球队所有信息
	 *@param 
	 *@return teamInfo
	 */
	public function getNoAudiedTeamInfo() {
		$this->db->select("*");
		$this->db->from("team");
		$this->db->where("team_status","0");
		$resultData = $this->db->get()->result_array();
		foreach($resultData as &$each) {
			$uid = $this->getUserInfoById($each['team_leader']);
			$each['team_leader']= $uid['0']['nickname'];
		}
		return $resultData;
	}
	/**
	 *显示已审核球队所有信息
	 *@param 
	 *@return teamInfo
	 */
	public function getAudiedTeamInfo() {
		$this->db->select("*");
		$this->db->from("team");
		$this->db->where("team_status","1");
		$resultData = $this->db->get()->result_array();
		foreach($resultData as &$each) {
			$uid = $this->getUserInfoById($each['team_leader']);
			$each['team_leader']= $uid['0']['nickname'];
		}
		return $resultData;
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
	public function verifyTeamYes() {
		$team_id = $this->input->post('team_id');
		$team_status = 1;
		$this->db->where("team_id",$team_id);
		$this->db->set("team_status",$team_status);
		if($this->db->update("team")) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 *后台审核,申请不通过
	 *@param $team_id
	 *@return boolean
	 */
	public function verifyTeamNo() {
		$team_id = $this->input->post('team_id');
		$team_status = 3;
		$this->db->where("team_id",$team_id);
		$this->db->set("team_status",$team_status);
		if($this->db->update("team")) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 *根据uid获取用户昵称
	 *@param $uid
	 *@return $userinfo
	 */
	public function getUserInfoById($uid) {
		$this->db->select("nickname");
		$this->db->where("uid",$uid);
		return $this->db->get("user_info")->result_array();
	}

}