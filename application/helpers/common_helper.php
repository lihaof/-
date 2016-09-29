<?php

/**
 *  This is a lottery learning soft, use should be under local law terms.
 *  Don't use it as a formal soft, money trades in the platform is forbidden,
 *  or else you should bear all the consequences caused by yourself.
 *
 *  Module: common_helper
 */

define("HISTORY_BACK", "__history_goes_back");

function checkTrimEmpty() {
	$data = array();

	foreach(func_get_args() as $each) {
		$tmp = trim(get_instance()->input->post($each[0]));
		if($tmp == "") showNotice($each[1]);

		$data[$each[0]] = $tmp;
	}

	return $data;
}

function writeLog($uid, $content) {
    $ci =& get_instance();
    $data = array(
        'operator' => intval($uid),
        'content'  => $content,
        'dateline' => time()
    );
    return $ci->db->insert("logs", $data);
}

function writeTemp($key, $val) {
    $ci =& get_instance();
    $data = array(
        'key' => $key,
        'val' => $val,
        'dateline' => time()
    );
    return $ci->db->replace("temps", $data);
}

function getTemp($key) {
    $ci =& get_instance();
    $data = $ci->db->get_where("temps", array('key' => $key))->first_row('array');
    return $data['val'];
}

function isWin($code, $type, $drawInfo) {
    $drawDict  = array();
    $parseInfo = explode(",", $drawInfo);
    foreach($parseInfo as $each) {
        $exp = explode(":", $each);
        $drawDict[$exp[0]] = $exp[1];
    }

    if($type == 1) {
        if(is_numeric($code)) {
            $parseType = "特码";
        } elseif($code == "tedan" || $code == "teshuang") {
            $parseType = "特码单双";
        } elseif($code == "teda" || $code == "texiao") {
            $parseType = "特码大小";
        } elseif($code == "hedan" || $code == "heshuang") {
            $parseType = "合数单双";
        } elseif($code == "heda" || $code == "hexiao") {
            $parseType = "合数大小";
        } elseif($code == "hongbo" || $code == "lanbo" || $code == "lvbo") {
            $parseType = "波色";
        }
    } elseif($type == 2) {
        if($code == "zda" || $code == "zxiao") {
            $parseType = "大小";
        } elseif($code == "zdan" || $code == "zshuang") {
            $parseType = "单双";
        }
    } elseif($type == 3) {
        $parseType = "尾数";
    } elseif($type == 4) {
        $parseType = "半波";
    }

    return $drawDict[$parseType] == convertName($code, true);
}

function convertName($engName, $simple = false) {
    switch($engName) {
        case "tedan":       return $simple ? "单" : "特单";
        case "teshuang":    return $simple ? "双" : "特双";
        case "teda":        return $simple ? "大" : "特大";
        case "texiao":      return $simple ? "小" : "特小";
        case "heda":        return $simple ? "大" : "合大";
        case "hexiao":      return $simple ? "小" : "合小";
        case "hedan":       return $simple ? "单" : "合单";
        case "heshuang":    return $simple ? "双" : "合双";
        case "zda":         return $simple ? "大" : "总大";
        case "zxiao":       return $simple ? "小" : "总小";
        case "zdan":        return $simple ? "单" : "总单";
        case "zshuang":     return $simple ? "双" : "总双";
        case "hongbo":      return "红波";
        case "lanbo":       return "蓝波";
        case "lvbo":        return "绿波";
        case "hongdan":     return "红单";
        case "hongshuang":  return "红双";
        case "landan":      return "蓝单";
        case "lanshuang":   return "蓝双";
        case "lvdan":       return "绿单";
        case "lvshuang":    return "绿双";
    }

    return $engName;
}

function getDayStart() {
    return strtotime(date("Y/m/d"));
}

function getDayEnd() {
    return strtotime(date("Y/m/d 23:59:59"));
}

function getUser($qcol, $qval, $rcol = "") {
	$ci =& get_instance();

	if(is_array($qcol)) {
		foreach($qcol as $col => $val) {
			$ci->db->where($col, $val);
		}
		$rcol = $qval;
	} else {
		$ci->db->where($qcol, $qval);
	}

	$rdat = $ci->db->get("users")->first_row('array');

	if($rcol == "") {
		return $rdat;
	} else {
		return $rdat[$rcol];
	}
}

function isUpper($uidToFind, $uid) {
    $upperUid = getUser("uid", $uid, "upper_uid");

    if($upperUid == $uidToFind) {
        return true;
    } elseif($upperUid == 0) {
        return false;
    } else {
        return isUpper($uidToFind, $upperUid);
    }
}

function getLevelName($level) {
    switch($level) {
        case 1: return "会员";
        case 4: return "代理";
        case 5: return "总代理";
        case 6: return "股东";
        case 7: return "超级管理员";
    }
}

function setting($settingName) {
    get_instance()->db->where("key", $settingName);
    $tmp = get_instance()->db->get("settings")->first_row('array');
    return $tmp['value'];
}

function updateCredit($type = 1, $uid, $value) {
    $ci =& get_instance();
    switch($type) {
        case 1: $type = "fixed_credit";     break;
        case 2: $type = "available_credit"; break;
        case 3: $type = "used_credit";      break;
    }
    $sign = $value > 0 ? "+" : "-";
    $sql = sprintf(
        "UPDATE %s SET %s = %s %s '%lf' WHERE `uid`='%d'",
        $ci->db->dbprefix("users"),
        $type,
        $type,
        $sign,
        abs($value),
        intval($uid)
    );

   return $ci->db->query($sql);
}

function setBetResult($cid, $status, $draw, $winNum = -1) {
    $ci =& get_instance();

    $data['status'] = $status;
    $data['draw']   = $draw;
    if($winNum > 0) $data['winnum'] = $winNum;

    $ci->db->where("cid", intval($cid));
    return $ci->db->update("bet_records", $data);
}

function setBetRecords($cid, $row, $value) {
    $ci =& get_instance();
    $data[$row] = $value;
    $ci->db->where("cid", intval($cid));
    return $ci->db->update("bet_records", $data);
}

function tellRuleName($type) {
    switch($type) {
        case 1: return "特码";
        case 2: return "总分";
        case 3: return "尾数";
        case 4: return "半波";
        default: return "未知";
    }
}

function getPeriod($time = 0) {
    if(!$time) $time = time();

    $timeOriginal = strtotime(date("Y/m/d"));
    $timeRelative = ($time - $timeOriginal) / 60;

    $period = 0;
    if($timeRelative < 120) {
        $period = $timeRelative / 5 + 1;
    } elseif($timeRelative < 600) {
        $period = 24;
    } elseif($timeRelative <= 1320) {
        $period = 24 + ($timeRelative - 600) / 10 + 1; 
    } elseif($timeRelative <= 1440) {
        $period = 96 + ($timeRelative - 1320) / 5 + 1;
    }

    $period = floor($period);

    $timeStart = 0;
    $timeEnd   = 0;
    if($period > 0 && $period < 24) {
        $timeStart = $timeOriginal + ($period-1)*300;
        $timeEnd   = $timeOriginal + $period*300 - 1;
    } elseif($period == 24) {
        $timeStart = $timeOriginal + 23*300;
        $timeEnd   = $timeOriginal + 3600*10 - 1;
    } elseif($period <= 96) {
        $timeStart = $timeOriginal + 3600*10 + ($period-24-1)*600;
        $timeEnd   = $timeOriginal + 3600*10 + ($period-24)*600 - 1;
    } elseif($period <= 120) {
        $timeStart = $timeOriginal + 3600*22 + ($period-96-1)*300;
        $timeEnd   = $timeOriginal + 3600*22 + ($period-96)*300 - 1;
    }

    return array(
        'period' => $period,
        'start'  => $timeStart,
        'end'    => $timeEnd
    );
}

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