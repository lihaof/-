<?php

/**
 *	Basketball Management System 1.0
 *
 *	@Id: 		Initor.php
 *	@Author: 	RuphiLau
 *	@Generate:	2016/09/29
 */

class Initor extends CI_Model {
	public $openId;
	public $uid ;
	public $info;
    public $group;
	public $wechatInfo;

	const APPID     = "wx69e65b6c4b56e608";
	const APPSECRET = "c7b34e86f8b18bed2b66443b4e7f270e";

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library("ui");
		$this->load->helper("url");
		$this->load->library("session");
		$this->load->helper("common_helper");

		if(!$this->session->tempdata("OPENID")) {
			$data = $this->snsapi_userinfo();
			$this->openId = $data["openid"];
			$this->wechatInfo = $data;
		} else {
			$this->openId = $this->session->tempdata("OPENID");
			$this->wechatInfo = $this->session->tempdata("WECHAT_INFO");
		}

		if(!$this->openId) {
			echo "系统初始化失败，请重新进入页面";
			exit();
		}

		$user = getUser("openid", $this->openId);
		if(!!$user) {
			$this->uid = $user['uid'];
			$this->info = $user;
		} else {
            $this->db->insert("bms_user_info", array(
            	'openid'   =>$this->openId,
            	'nickname' =>$this->wechatInfo['nickname'],
            	'picture'  =>$this->wechatInfo['headimgurl']
            	));
            $this->uid  = $this->db->insert_id();
            $this->info = getUser("uid",$this->uid);
		}
        $curModuleName = $this->router->class."/".$this->router->method;
		$validModules  = array(
			"User/addUserinfo",
			"User/addUser",
		);
/*

		$this->info = array(
		  "openid"=>"fhwoefewofowfwe",
		  "uid"=>"1",
		  "nickname"=>"wtt",
		  "weight"=>"47",
		  "height"=>"160",
		  "position"=>"4",
		  "point"=>"33",
		  "user_level"=>"1",
		  "team_id"=>"1",
		  "is_compelete"=>"1",
		  "picture"=>"0"
		)
		*/

		if($this->info['is_compelete']==0 && in_array($curModuleName, $validModules)!=1) {
			showNotice("您尚未完善个人信息，请先完善", site_url("User/addUserinfo"));
		}
	}

	private function snsapi_userinfo() {  
	    //1 第一步：用户同意授权，获取code
	    $snsapi_userinfo_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".SELF::APPID."&redirect_uri=".urlencode(site_url())."&response_type=code&scope=snsapi_userinfo&state=wtt#wechat_redirect";

	    $code = trim($this->input->get('code'));
	    if($code == "") {
	        header("Location:{$snsapi_userinfo_url}");
	    } else {

	    	//2 第二步：通过code换取网页授权access_token
		     $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".self::APPID."&secret=".self::APPSECRET."&code={$code}&grant_type=authorization_code";     
		     $result = $this->https_request($url);

		     $web_access_token = $result['access_token'];
		     $openid = $result['openid'];

		     //3获取用户信息
		     $userinfo_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$web_access_token}&openid={$openid}&lang=zh_CN";
		     $data = $this->https_request($userinfo_url);

		     $this->session->set_tempdata("WECHAT_INFO", $data, 7200);
		     $this->session->set_tempdata("OPENID",$data["openid"],7200);
		    // copy($data['headimgurl'], FCPATH."avatars/".$this->uid.".jpg");
		     return $data;
	    }
	}

	//https_request()请求
	private function https_request($url,$data=null) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	    curl_setopt($ch, CURLOPT_HEADER, 0);

	    if(!empty($data)) {
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	    }
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $res = curl_exec($ch);
	    curl_close($ch);
	    $res = json_decode($res,true);
	    return($res);
	}

	public function avatar($uid = 0) {
		if(!$uid) $uid = $this->uid;
		if(!file_exists(FCPATH."avatars/".$uid.".jpg")) {
			return base_url("image/default-avatar.png");
		}
		return base_url("avatars/".$uid.".jpg");
	}
}