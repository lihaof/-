<?php
/**
 *	Basketball Management System 1.0
 *
 *	@Id: 		Team.php
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
		$uid = 1;//待获取
		$data["team"] = $this->getMyTeam($uid);
		$this->ui->load("Team",$data);
	}
	/**
	 *根据球队名称和队长id获取球队id
	 *@param $uid,$team_name
	 *@return $team_id
	 */
	public function fetchTeam($uid,$team_name) {
		$this->db->select("team_id");
		$this->db->from("team");
		$this->db->where("team_name",$team_name);
		$this->db->where("team_leader",$uid);
		return $this->db->get()->result_array();
	}
	/**
	 *申请球队
	 *@param $uid,$team_name
	 *@return boolean
	 */
	public function applyTeam() {
		$team_name = $this->input->post('team_name');
		$uid = 1;//待获取
		//验证该用户是否已创建相同的球队
		if($this->fetchTeam($uid,$team_name)) {
			/*showNotice("你已创建该球队,如未查询到,可能是后台未审核");*/
			$result=array("status"=>"false","info"=>"你已创建该球队,如未查询到,可能是后台未审核");
			echo json_encode($result);
		} else {
			//新建球队
			$data = array(
				'team_name' => $team_name,
				'team_leader' => $uid,
				'team_slogan' => '',
				'team_picture' => '',
				'team_status' => '0'
			);
			$this->db->insert("team",$data);

			//根据球队名称和队长id获取球队id
			$team_id = $this->fetchTeam($uid,$team_name);

			//将队长id插入到球队成员列表中
			$memmber = array(
				'team_id' => $team_id['0']['team_id'],
				'uid' => $uid,
				'team_memmber_status' => '1'
			);
			if($this->db->insert("team_memmber",$memmber)){
				/*showNotice("球队创建成功");*/
				$result=array("status"=>"true","info"=>"球队创建成功,请等待管理员审核");
				echo json_encode($result);
			} else {
				/*showNotice("创建失败,请稍后再试");*/
				$result=array("status"=>"false","info"=>"创建失败,请稍后再试");
				echo json_encode($result);
			};
		}
	}
	/**
	 *加入球队
	 *@param $team_id,$uid
	 *@return boolean
	 */
	public function joinTeam() {
		$team_id = $this->input->get('team_id');
		$uid = 2;//待获取
		$this->db->select("team_memmber_id,team_memmber_status");
		$this->db->from("team_memmber");
		$this->db->where("team_id",$team_id);
		$this->db->where("uid",$uid);
		$result = $this->db->get()->result_array();
		if($result) {
			if($result['0']['team_memmber_status']) showNotice("你已在该球队了");
			else showNotice("你的审核已提交,等待队长审核");
		}


		$data = array(
			'team_id' => $team_id,
			'uid' => $uid,
			'team_memmber_status' =>'0'
		);
		if($this->db->insert("team_memmber",$data)) {
			showNotice("申请提交成功,等待队长审核");
		} else {
			showNotice("提交申请失败");

		}
	}
	/**
	 *队长审核，通过加入请求
	 *@param $team_memmber_id
	 *@return boolean
	 */
	public function admitTeam() {
		/*最好验证一下该用户是否是球队队长，等待完善*/
		$team_memmber_status = 1;
		$team_memmber_id = $this->input->get("team_memmber_id");
		$this->db->where("team_memmber_id",$team_memmber_id);
		$this->db->set("team_memmber_status",$team_memmber_status);
		if($this->db->update("team_memmber")) {
			showNotice("设置成功");
		} else {
			showNotice("设置失败");
		}
	}
	/**
	 *显示自己的加入的球队
	 *@param $uid
	 *@return teamInfo
	 */
	public function getMyTeam($uid) {
		$teamInfo = array();
		$this->db->select("team_id");
		$this->db->where("uid",$uid);
		$this->db->where("team_memmber_status",1);
		$query = $this->db->get("team_memmber")->result_array();
		foreach($query as $each_id) {
			$this->db->select("*");
			$this->db->where("team_id",$each_id["team_id"]);
			$this->db->where("team_status",1);
			$eachInfo = $this->db->get("team")->result_array();
			$teamInfo = array_merge($teamInfo,$eachInfo);
		}
		return $teamInfo;
	}
	/**
	 *显示加入的球队成员(未审核通过的队员不能显示)
	 *@param $team_id
	 *@return uid
	 */
	public function getValidTeammate() {
		$team_id = $this->input->post("team_id");
		$this->db->select("position,uid");
		$this->db->where("team_id",$team_id);
		$this->db->where("team_memmber_status",1);
		echo json_encode($this->db->get("team_memmber")->result_array());
	}
	/**
	 *显示创建的球队成员(队长，显示包括未审核的队员)
	 *@param $team_id
	 *@return uid
	 */
	public function getTeammate() {
		$team_id = $this->input->post("team_id");
		$this->db->select("*");
		$this->db->where("team_id",$team_id);
		echo json_encode($this->db->get("team_memmber")->result_array());
	}
	/**
	 *查找球队(模糊查找),参数为空时显示全部球队
	 *@param $team_name
	 *@return $team_id
	 */
	public function serchTeam() {
		$team_name = $this->input->post("team_name");
		$this->db->like("team_name",$team_name);
		echo json_encode($this->db->get("team")->result());
	}
	
}