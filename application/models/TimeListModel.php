<?php
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
        $sql = "SELECT * FROM bms_time_list WHERE date = '{$date}' ORDER BY list_id ASC";
        $query = $this->db->query($sql);
        if($query->num_rows() == 0) {
            $this->createDateData($date);
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    private function createDateData($date) {
        $sql = "SELECT * FROM bms_open_time WHERE status = '1'";
        $openTime = $this->db->query($sql)->result_array();
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
        $sql = "SELECT time FROM bms_time_limit WHERE time_limit_id = 1";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        if(isset($result)){
            return $result["time"];
        } else {
            return 0;    //0为无限制
        }
    }
}