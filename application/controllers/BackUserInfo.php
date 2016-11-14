<?php
class BackUserInfo extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library("ui");
        $this->load->helper("url");
        $this->load->library("session");
        $this->load->helper("common_helper");
    }

    public $per_page = 10;

    public function index() {

       $this->load->library("pagination");
        $config['base_url'] = site_url('BackUserInfo/test');
        $config['total_rows'] = count($this->db->get('bms_user_info')->result_array());
        $config['per_page'] = $this->per_page;
        $config['first_link'] = "首页";
        $config['last_link'] = "末页";
        $config['next_link'] = "下一页";
        $config['prev_link'] = "上一页";

        $this->pagination->initialize($config);
        $query = $this->db->get('bms_user_info', $config['per_page'], intval($this->uri->segment(3)));
        $userList['userList'] = $query->result_array();
        $userList['page_links'] = $this->pagination->create_links();
        $this->ui->load('BackUserInfo', $userList);

    }
    
    public function test() {

        
    }

    public function editUserinfo() {
        $userpoint = $this->input->post();
        $i = 1;
        if(is_array($userpoint)) {
            foreach ($userpoint as $key => $value) {
                $data['point'] = $value;
                $this->db->where('uid',$key);
                $j = $this->db->update('bms_user_info',$data);
                $i = $i && $j;
            }

        }

        if($i == 1) {
            showNotice("修改成功！", site_url('BackUserInfo/index'));

        } else {
            showNotice("系统出错，请重新完善", site_url('BackUserInfo/index'));
        }

    }
}