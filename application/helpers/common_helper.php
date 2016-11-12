<?php

/**
 *  Basketball Management System 1.0
 *
 *  @Id:        common_help.php
 *  @Author:    Everyone
 *  @Generate:  2016/10/19
 */

define("HISTORY_BACK", "__history_goes_back");

function showNotice($str, $smartMode = HISTORY_BACK) {
    $str = str_replace("\n", "", $str);
    echo '<DOCTYPE HTML>';
    echo '<html>';
    echo '<head>';
    echo '<meta charset="UTF-8" />';
    echo '<title>提示信息</title>';
    echo '</head>';
    echo '<body>';
    echo '<script language="javascript">';
    echo "alert('".addslashes($str)."');";
    if($smartMode == HISTORY_BACK)
        echo 'window.history.go(-1);';
    else 
        echo 'window.location.href="'.$smartMode.'";';
    echo '</script>';
    echo '</body>';
    echo '</html>';
    exit;
}

function authcode($string, $key = '', $operation = 'DECODE', $expiry = 0) {
	$ckey_length = 4;
 
    $key = md5($key); 
 
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    // 产生密匙簿
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE') {
        if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc.str_replace('=', '', base64_encode($result));
    }
}

//获取用户信息  WHERE中的$name表示字段名、$value表示字段值，  $status为null时表示接受全部信息，不为null时表示接受某些值
function getUser($name, $value, $status = null) {
    //用$ci 代替 $this
    $ci = & get_instance();
    if($status == null) {
        $ci->db->select('*');
        $ci->db->from('bms_user_info');
        $ci->db->where("$name",$value);
    } else {
        $ci->db->select("$status");
        $ci->db->from('bms_user_info');
        $ci->db->where("$name",$value);
    }
    $query = $ci->db->get();
    $result = $query->row_array();
    return $result;
}

function getTeam($name, $value, $status = null) {
    //用$ci 代替 $this
    $ci = & get_instance();
    if($status == null) {
        $ci->db->select('*');
        $ci->db->from('bms_team');
        $ci->db->where("$name",$value);
    } else {
        $ci->db->select("$status");
        $ci->db->from('bms_team');
        $ci->db->where("$name",$value);
    }
    $query = $ci->db->get();
    $result = $query->row_array();
    return $result;
}
