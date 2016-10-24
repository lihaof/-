<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        User.php
 *  @Author:    wangtingting
 *  @Generate:  2016/10/19
 */
class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("initor");
        $this->load->helper("common_helper");
	}
    public function test() {
        $result = getUser('uid','1','teamid');
        print_r($result);
    }
	public function index() {

		$redirect_uri = "<?php echo site_url('Admin/User/index'); ?>";
        $result = snsapi_userinfo($redirect_uri);
 
        $data['openid'] = $result['openid'];
        $data['nickname'] = $result['neckname'];

        $sql = "SELECT uid FROM bms_user_info WHERE openid = ".$data['openid'];
        $query = $this->db->query($sql);
        $uid = $query->result_array();

        if(empty($uid)) {
            //新用户
            $query = $this->db->insert('bms_user_info',$data);
            if($query == TRUE) {
                //提醒完善信息
                showNotice("注意完善个人信息！",site_url("Admin/User/showUser"));
            } else {
                showNotice("注意完善个人信息！",site_url("Admin/User/index"));
            }
            
        } else {
            //非新用户
            //跳转 ？ 页面

        }


	}
    
    //展示用户信息
    public function showUser() {

        $redirect_uri = "<?php echo site_url('Admin/User/showUser'); ?>";
        $result = snsapi_userinfo($redirect_uri);
        $data['openid'] = $result['openid'];
        $sql = "SELECT * FROM bms_user_info WHERE openid = {$data['openid']} ";
        $query = $this->db->query($sql);
        $userinfo = $query->result_array();
        //从数据库中查询用户信息，传递给个人主页
    }

    //修改、添加用户信息
    public function addUser() {

        $redirect_uri = "<?php echo site_url('Admin/User/addUser'); ?>";
        $result = snsapi_userinfo($redirect_uri);

        $data['openid'] = $result['openid'];
        $data['nickname'] = $result['neckname'];

        $data['weight'] = $this->input->post('weight');
        $data['height'] = $this->input->post('height');
        $data['positon'] = $this->input->post('position');
        
        //更新数据
        $sql = " UPDATE bms_user_info SET weight = {$data['weight']}, height = {$data['height']}, position = {$data['position']} WHERE openid = {$data['openid']}";
        $query = $this->db->query($sql);
        if($query == TRUE) {
            showNotice("完善成功！",site_url("Admin/User/showUser"));
        } else {
            showNotice("请重新完善！",site_url("???"));
        }
        
    }

    
    
    //用户创建球队
    public function createTeam() {
        //$this->ui->load("");


    }

    //用户加入某球队
    public function joinTeam(){


    }

    //队长审核队员加入球队
    public function checkTmember(){

    }


   

  

}