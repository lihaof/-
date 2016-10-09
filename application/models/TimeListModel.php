<?php
class TimeListModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function fetchOneDay($year = "0", $month = "0", $day = "0") {
        if(checkdate($month, $day, $year)) {
            $date = $year."-".$month."-".$day;
        } else {
            $date = date("Y-m-d",time());
        }
        $sql = "SELECT list_id,uid,date,start,end,price,status FROM bms_time_list WHERE date = '{$date}' ORDER BY list_id ASC";
        $query = $this->db->query($sql);
        if($query->num_rows() == 0) {
            $this->createDateData($date);
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    private function createDateData($date) {
        $sql = "SELECT time_id,start,end,price FROM bms_open_time WHERE status = '1'";
        $openTime = $this->db->query($sql)->result_array();
        foreach ($openTime as $key => $value) {
            $data = array(
                'date' => $date,
                'start' => $value['start'],
                'end' => $value['end'],
                'price' => $value['price'],
                'status' => 1
            );
            $this->db->insert("bms_time_list",$data);
        }
    }
}