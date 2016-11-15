<?php
class OptionModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getOptNum() {
    	$query= $this->db->select('*')->from('bms_website_option')->order_by('oorder','ASC')->get();
    	$array = $query->result_array();
    	$num = count($array);
    	return $num;
    }

    public function getOptType($num) {
		$query= $this->db->select('*')->from('bms_website_option')->where('oorder',$num)->get();
    	$array = $query->result_array();
    	return $array[0]['otype'];
    }

    public function getOption() {
    	$query= $this->db->select('*')->from('bms_website_option')->order_by('oorder','ASC')->get();
    	$array = $query->result_array();
    	$num = $this->getOptNum();
    	for($i=0;$i<$num;$i++) {
    		$array[$i]['oselection'] = explode(";", $array[$i]['oselection']);
    		$array[$i]['ovalue'] = explode(";", $array[$i]['ovalue']);
    	}
    	return $array;
    }

    public function saveOpt($num, $value) {
    	$this->db->set('ovalue', $value)->where('oorder',$num)->update('bms_website_option');
    }
}
?>