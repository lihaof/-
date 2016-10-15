<?php
class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("initor");
        $this->load->helper("common_helper");
	}

	public function index() {
		$redirect_uri = "<?php echo site_url('Admin/User/index'); ?>";
        $result=$this->snsapi_userinfo($redirect_uri);
 
        $data['openid'] = $result['openid'];
        $data['nickname'] = $result['neckname'];

        $sql = "SELECT uid FROM bms_user_info WHERE openid = ".$data['openid'];
        $query = $this->db->query($sql);
        $uid = $query->result_array();

        if(empty($uid)) {
            //新用户
            $this->db->insert('bms_user_info',$data);

            //提醒完善信息
            showNotice("注意完善个人信息！",site_url("Admin/User/showUser"));
        }

        } else {
            //非新用户
            //跳转 ？ 页面

        }


	}
    
    //展示用户信息
    public function showUser(){
        $redirect_uri = "<?php echo site_url('Admin/User/showUser'); ?>";
        $result=$this->snsapi_userinfo($redirect_uri);
        $data['openid'] = $result['openid'];
        $sql = "SELECT * FROM bms_user_info WHERE openid = ".$data['openid'];
        $query = $this->db->query($sql);
        $userinfo = $query->result_array();
    }

    //修改、添加用户信息
    public function addUser(){

        $redirect_uri="<?php echo site_url('Admin/User/addUser'); ?>"
        $result=$this->snsapi_userinfo($redirect_uri);

        $data['openid'] = $result['openid'];
        $data['nickname'] = $result['neckname'];

        $data['weight']=$this->input->post('weight');
        $data['height']=$this->input->post('height');
        $data['positon']=$this->input->post('position');

        //更新数据
        $this->db->replace('bms_user_info',$data);

    }

    
    
    //用户创建球队
    public function createTeam(){


    }

    //用户加入某球队
    public function joinTeam(){


    }

    //队长审核队员加入球队
    public function checkTmember(){

    }

    public function snsapi_base($redirect_uri){

         //appid  appsecret
    	 $appid = "wx274a5600eb3baa04";
	     $appsecret = "da4480ace51a57892c4c1c32b25351bc";
         
	     $redirect_uri = urlencode($redirect_uri);
    	//1 第一步：用户同意授权，获取code
        $snsapi_base_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state=wtt#wechat_redirect";
       
        if(!isset($_GET['code']))
        {
        	header("Location:{$snsapi_base_url}");
        }
         $code = $this->input->get('code');
		//2 第二步：通过code换取网页授权access_token
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$code}&grant_type=authorization_code";     
        return $this->https_request($url);

    }

    public function snsapi_userinfo($redirect_uri)
    {
         $appid = "wx274a5600eb3baa04";
         $appsecret = "da4480ace51a57892c4c1c32b25351bc";
         
         $redirect_uri = urlencode($redirect_uri);
        //1 第一步：用户同意授权，获取code
        $snsapi_userinfo_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=wtt#wechat_redirect";
         if(!isset($_GET['code']))
        {
            header("Location:{$snsapi_userinfo_url}");
        }
         $code = $this->input->get('code');
        //2 第二步：通过code换取网页授权access_token
         $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$code}&grant_type=authorization_code";     
         $result = $this->https_request($url);
         $web_access_token = $result['access_token'];
         $openid = $result['openid'];
         //3获取用户信息
         $userinfo_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$web_access_token}&openid={$openid}&lang=zh_CN";

         return $this->https_request($userinfo_url);
    }

    private function https_request($url,$data=null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if(!empty($data))
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res,true);
        return($res);
    }

}