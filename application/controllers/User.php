<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        User.php
 *  @Author:    wangtingting
 *  @Generate:  2016/10/19
 */
class User extends CI_Controller {
    public $cookietime = 24*60*60;

	public function __construct() {
		parent::__construct();
		$this->load->model("initor");
        $this->load->helper("common_helper");
	}
    public function test() {
        //var_dump($this->input->post);
        $data['openid'] = $this->input->cookie('openid');
        $data['nickname'] = $this->input->cookie('nickname');
        $data['uid'] = $this->input->cookie('uid');
        $data['weight'] = $this->input->post('weight');
        $data['height'] = $this->input->post('height');
        $data['position'] = $this->input->post('position');
        $data['iscompelete'] = 1;

        var_dump($data);
        echo "<br />";
        var_dump($this->input->post['weight']);
    }

    public function test1() {
       echo $this->cookietime;
    }

	public function index() {

		/*

        $redirect_uri = "<?php echo site_url('Admin/User/index');?>";
        $result = snsapi_userinfo($redirect_uri);
        $data['openid'] = $result['openid'];
        $data['nickname'] = $result['neckname'];

        */


        $data['openid'] = 'fweifugw';
        $data['nickname'] = '1afufewfhwefe1';

        $this->input->set_cookie('openid',$data['openid'],$this->cookietime);
        $this->input->set_cookie('nickname',$data['nickname'],$this->cookietime);

        $this->db->select('uid, iscompelete');
        $this->db->from('bms_user_info');
        $this->db->where('openid',$data['openid']);
        $query = $this->db->get();
        $user = $query->result_array();
        //var_dump($this->input->cookie('openid'));
        //exit();
        //var_dump($user);
        //exit();
        if(empty($user)) {
            //新用户
         
            $query = $this->db->insert('bms_user_info',$data);

            $this->db->select('uid');
            $this->db->from('bms_user_info');
            $this->db->where('openid',$data['openid']);
            $query = $this->db->get();
            $user = $query->result_array();
            $this->input->set_cookie('uid',$user[0]['uid'],$this->cookietime);
            
            if($query == TRUE) {
                //提醒完善信息
                showNotice("注意完善个人信息！",site_url("User/addUserinfo"));
            } else {
                showNotice("注意完善个人信息！",site_url("User/index"));
            }
            
        } else if($user[0]['iscompelete'] == 0) {
            //未完善个人信息用户
            $this->db->select('uid');
            $this->db->from('bms_user_info');
            $this->db->where('openid',$data['openid']);
            $query = $this->db->get();
            $user = $query->result_array();
            $this->input->set_cookie('uid',$user[0]['uid'],$this->cookietime);

            $this->ui->load('adduserinfo');
        } else {
            //已完善信息的用户
            $this->db->select('uid');
            $this->db->from('bms_user_info');
            $this->db->where('openid',$data['openid']);
            $query = $this->db->get();
            $user = $query->result_array();
            $this->input->set_cookie('uid',$user[0]['uid'],$this->cookietime);

            echo "已完善用户";
           // echo $this->input->cookie('uid');
            exit();
        }


	}
    public function addUserinfo() {
        //完善用户界面
        $this->ui->load('adduserinfo');
    }
    
    //展示用户信息
    public function showUser() {

        $this->db->select('*');
        $this->db->from('bms_user_info');
        $this->db->where('uid',$this->input->cookie('uid'));
        $query = $this->db->get();
        $data = $query->result_array();
        var_dump($data);
        exit();

    }

    //修改、添加用户信息
    public function addUser() {

        $data['openid'] = $this->input->cookie('openid');
        $data['nickname'] = $this->input->cookie('nickname');
        $data['uid'] = $this->input->cookie('uid');
        $data['weight'] = $this->input->post('weight');
        $data['height'] = $this->input->post('height');
        $data['position'] = $this->input->post('position');
        $data['iscompelete'] = 1;
        $result = $this->db->replace('bms_user_info',$data);

        if($result == TRUE) {
            showNotice("完善成功！",site_url("User/showUser"));
        } else {
            showNotice("请重新完善！",site_url("User/addUserinfo"));
        }
        
    }

    


   

  

}