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
		$uid = $this->initor->uid;//待获取
		$data["team"] = $this->getMyTeam($uid);
		$data["myteam"] = $this->getCreatedTeam($uid);
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
	 *处理球队头像
	 *@param 
	 *@return pictUrl
	 */
	public function getTeamPort() {
		//获取上传的图片
		$config['upload_path']    = './image/team/';
		$config['allowed_types']  = 'gif|jpg|png|PNG|JPG';
		$config['max_size']       = 6000;
		$config['max_width']	  = 6000;
		$config['max_height']	  = 6000;
		$config['file_name']      = md5(uniqid(microtime(true),true));
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('teamPort')){
			//showNotice("头像上传出错,请重新上传");
			$returnData = array('error' => $this->upload->display_errors("",""));
		} else {
			//图片上传成功
			$this->load->library('upload');
			$team_picture = $config['file_name'].$this->upload->data('file_ext');
			$returnData = array('success' => $team_picture);
		}
		echo json_encode($returnData);
	}
	/**
	 *申请球队
	 *@param $uid,$team_name
	 *@return boolean
	 */
	public function applyTeam() {
		$team_name = $this->input->post('team_name');
		$team_slogan = $this->input->post('team_slogan');
		$team_picture = $this->input->post('team_picture');
		if($team_name=="") return;
		if($team_picture=="") $team_picture = "default.png";
		$uid = $this->initor->uid;//待获取
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
				'team_slogan' => $team_slogan,
				'team_picture' => $team_picture,
				'team_status' => '0'
			);
			$this->db->insert("team",$data);

			//根据球队名称和队长id获取球队id
			$team_id = $this->fetchTeam($uid,$team_name);

			//将队长id插入到球队成员列表中
			$memmber = array(
				'team_id' => $team_id['0']['team_id'],
				'uid' => $uid,
				'team_memmber_status' => '2'
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
		$uid = $this->initor->uid;//待获取
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
		$uid = $this->initor->uid; //待获取
		$team_memmber_status = 1;
		$team_memmber_id = $this->input->post("team_memmber_id");
		if(empty($team_memmber_id)) { echo "获取参数失败"; return;  }
		$this->db->select("team_id");
		$this->db->where("team_memmber_id",$team_memmber_id);
		$team_id = $this->db->get("team_memmber")->result_array();
		if($this->checkLeader($team_id,$uid)) { echo "无操作权限"; return;  }  //该用户不是队长

		$this->db->where("team_memmber_id",$team_memmber_id);
		$this->db->set("team_memmber_status",$team_memmber_status);
		if($this->db->update("team_memmber")) {
			echo "设置成功";
		} else {
			echo "设置失败";
		}
	}
	/**
	 *队长审核，拒绝加入球队
	 *@param $team_memmber_id
	 *@return boolean
	 */
	public function refuseTeam() {
		$uid = $this->initor->uid; //待获取
		$team_memmber_status = 3;
		$team_memmber_id = $this->input->post("team_memmber_id");
		if(empty($team_memmber_id)) return;
		$this->db->select("team_id");
		$this->db->where("team_memmber_id",$team_memmber_id);
		$team_id = $this->db->get("team_memmber")->result_array();
		$this->db->select("team_id");
		$this->db->where("team_id",$team_id);
		$this->db->where("team_leader",$uid);
		if($this->db->get("team")) return;  //该用户不是队长

		$this->db->where("team_memmber_id",$team_memmber_id);
		$this->db->set("team_memmber_status",$team_memmber_status);
		if($this->db->update("team_memmber")) {
			echo "设置成功";
		} else {
			echo "设置失败";
		}
	}
	/**
	 *显示自己加入的球队
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
		foreach($teamInfo as &$each) {
			$leader = $this->getUserInfoById($each['team_leader']);
			$each['team_leader']  = $leader['0']['nickname'];
			$each['teammate_num'] = $this->getTeammateNum($each['team_id']);
		}
		unset($each);
		return $teamInfo;
	}
	/**
	 *显示自己的创建的球队
	 *@param $uid
	 *@return teamInfo
	 */
	public function getCreatedTeam($uid) {
		$teamInfo = array();
		$this->db->select("*");
		$this->db->where("team_leader",$uid);
		$this->db->where("team_status",1);
		$teamInfo = $this->db->get("team")->result_array();
		foreach($teamInfo as &$each) {
			$leader = $this->getUserInfoById($each['team_leader']);
			$each['team_leader']= $leader['0']['nickname'];
			$each['teammate_num'] = $this->getTeammateNum($each['team_id']);
			$each['apply_Num']    = $this->getApplyNum($each['team_id']);
		}
		unset($each);
		return $teamInfo;
	}
	/**
	 *显示加入的球队成员(未审核通过的队员不能显示)
	 *@param $team_id
	 *@return uid
	 */
	public function getValidTeammate() {
		$team_id = $this->input->post("team_id");
		$validStatus = array("1","2");
		$this->db->select("position,uid");
		$this->db->where("team_id",$team_id);
		$this->db->where_in("team_memmber_status",$validStatus);
		$resultData = $this->db->get("team_memmber")->result_array();
		foreach($resultData as &$each) {
			$uid = $this->getUserInfoById($each['uid']);
			$each['uid']= $uid['0']['nickname'];
			$each['position'] = $this->changeAsAccb($each['position']);
		}
		echo json_encode($resultData);
	}
	/**
	 *显示申请加入的球队成员
	 *@param $team_id
	 *@return uid
	 */
	public function getApplyTeammate() {
		$team_id = $this->input->post("team_id");
		if($team_id=="") return;
		$this->db->select("team_memmber_id,position,uid");
		$this->db->where("team_id",$team_id);
		$this->db->where("team_memmber_status","0");
		$resultData = $this->db->get("team_memmber")->result_array();
		foreach($resultData as &$each) {
			$uid = $this->getUserInfoById($each['uid']);
			$each['uid']= $uid['0']['nickname'];
			$each['position'] = $this->changeAsAccb($each['position']);
		}
		echo json_encode($resultData);
	}
	/**
	 *查找球队(模糊查找),参数为空时显示全部球队
	 *@param $team_name
	 *@return $team_id
	 */
	public function serchTeam() {
		$team_name = $this->input->post("team_name");
		$this->db->where("team_status",1);
		$this->db->like("team_name",$team_name);
		$teamInfo = $this->db->get("team")->result_array();
		foreach($teamInfo as &$each) {
			$leader = $this->getUserInfoById($each['team_leader']);
			$each['team_leader']= $leader['0']['nickname'];
		}
		unset($each);
		echo json_encode($teamInfo);
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
	/**
	 *场位映射
	 *@param $position
	 *@return $position
	 */
	public function changeAsAccb($position) {
		$result = "";
		switch ($position) {
			case '0':
				$result = "未指定场位";
				break;
			case '1':
				$result = "得分后卫";
				break;
			case '2':
				$result = "组织后卫";
				break;
			case '3':
				$result = "小前锋";
				break;
			case '4':
				$result = "大前锋";
				break;
			case '5':
				$result = "中锋";
				break;
			default:
				$result = "未指定场位";
				break;
		}
		return $result;
	}
	/**
	 *获取球队球员数量
	 *@param $team_id
	 *@return $num
	 */
	public function getTeammateNum($team_id) {
		$allowStatus = array("1","2");
		$this->db->select("team_memmber_id");
		$this->db->where_in("team_memmber_status",$allowStatus);
		$this->db->where("team_id",$team_id);
		return $this->db->get("team_memmber")->num_rows();
	}
	/**
	 *获取申请加入该球队的球员数量
	 *@param $team_id
	 *@return $num
	 */
	public function getApplyNum($team_id) {
		$this->db->select("team_memmber_id");
		$this->db->where("team_memmber_status",0);
		$this->db->where("team_id",$team_id);
		return $this->db->get("team_memmber")->num_rows();
	}
	/**
	 *更改场位
	 *@param $team_memmber_id,$positon
	 *@return $boolean
	 */
	/**
	 *退出球队
	 *@param $team_id,$uid
	 *@return $boolean
	 */
	public function exitTeam() {
		$team_id = $this->input->post("team_id");
		$uid = $this->initor->uid; //待获取
		if($team_id=="") return ;
		$this->db->where("uid",$uid);
		$this->db->where("team_id",$team_id);
		if($this->db->delete("team_memmber")) echo 1;
		else echo 0;
	}
	/**
	 *解散球队
	 *@param $team_id,$uid
	 *@return $boolean
	 */
	public function dissolution() {
		$team_id = $this->input->post("team_id");
		$uid = $this->initor->uid; //待获取
		if($team_id=="") return ;
		//验证是否队长
		if(!$this->checkLeader($team_id,$uid)) return ;
		$this->db->where("team_id",$team_id);
		if($this->db->delete("team_memmber")) echo 1;
		else echo 0;
	}
	/**
	 *验证是否队长
	 *@param $team_id,$uid
	 *@return $boolean
	 */
	public function checkLeader($team_id,$uid) {
		$this->db->select("team_id");
		$this->db->where("team_id",$team_id);
		$this->db->where("team_leader",$uid);
		return $this->db->get("team")->result_array();
	}
}