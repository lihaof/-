<?php
/**
 *  Basketball Management System 1.0
 *
 *  @Id:        TimeListModel.php
 *  @Author:    Weafung
 *  @Generate:  2016/09/29
 */

class TimeListModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper("common_helper");
    }

    public function fetchOneDay($year = "0", $month = "0", $day = "0") {
        if(checkdate($month, $day, $year)) {
            $date = $year."-".$month."-".$day;
            $date2 = $day."-".$month."-".$year; 
        } else {
            $date = date("Y-m-d",time());
            $date2 = date("d-m-Y",time());
        }
        $dateStrToTime = strtotime($date2);
        $todayStrToTime  = strtotime(date("d-m-Y",time()));
        $timeLimit = $this->getTimeLimit();
        if($timeLimit != 0 && ($dateStrToTime - time() > $timeLimit || $dateStrToTime < $todayStrToTime) ) {
            showNotice('只能查询今天到未来一周之内的时间段');
        }
        $query = $this->db->where('date',$date)->order_by('list_id','ASC')->get('time_list');
        if($query->num_rows() == 0) {
            $this->createDateData($date);
        }
        $query = $this->db->where('date',$date)->order_by('list_id','ASC')->get('time_list');
        return $query->result_array();
    }

    private function createDateData($date) {
        $openTime = $this->db->where('status','1')->get('open_time')->result_array();
        $this->db->trans_start();
        foreach ($openTime as $key => $value) {
            $data = array(
                'date' => $date,
                'start' => $value['start'],
                'end' => $value['end'],
                'price' => $value['price'],
                "court_num" => $value["court_num"],
                "surplus_num" => $value["court_num"],
                'status' => 1
            );
            $this->db->insert("bms_time_list",$data);
        }
        $this->db->trans_complete();
    }

    private function getTimeLimit() {
        $result = $this->db->where('time_limit_id','1')->get('time_limit')->row_array();
        if(isset($result)){
            return $result["time"];
        } else {
            return 0;    //0为无限制
        }
    }

    //不存在返回false,存在返回该条记录的指定内容
    public function listIdIsExist($listId = 0) {
        $listData = $this->db->where("list_id",$listId)->get("time_list")->row_array();
        if(empty($listData)) {
            return false;
        }
        return $listData;
    }

}