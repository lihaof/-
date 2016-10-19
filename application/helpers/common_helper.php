<?php

/**
 *  This is a lottery learning soft, use should be under local law terms.
 *  Don't use it as a formal soft, money trades in the platform is forbidden,
 *  or else you should bear all the consequences caused by yourself.
 *
 *  Module: common_helper
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
    //用￥ci 代替 $this
    $ci = & get_instance();
    if($status == null) {
        $sql = "SELECT * FROM bms_user_info WHERE $name = $value";
        $query = $ci->db->query($sql);
        $result = $query->result_array();
    } else {
        $sql ="SELECT $status FROM bms_user_info WHERE $name = $value";
        $query = $ci->db->query($sql);
        $result = $query->result_array();
    }
    
    return $result;
}

//微信网页授权--静默型--获取用户 openid，返回为包含 openid、还有一个不记得  的数组 
function snsapi_base($redirect_uri) {

    //appid  appsecret
    $appid = "wx274a5600eb3baa04";
    $appsecret = "da4480ace51a57892c4c1c32b25351bc";
     
    $redirect_uri = urlencode($redirect_uri);
    //1 第一步：用户同意授权，获取code
    $snsapi_base_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state=wtt#wechat_redirect";
   
    if(!isset($_GET['code'])) {
        header("Location:{$snsapi_base_url}");
    }
    $code = $this->input->get('code');
    //2 第二步：通过code换取网页授权access_token
    $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$appsecret}&code={$code}&grant_type=authorization_code";     
    return https_request($url);

}

//微信网页授权--获取用户详细信息，返回为包含 openid、nickname、等相关信息的数组
function snsapi_userinfo($redirect_uri) {
    $appid = "wx274a5600eb3baa04";
    $appsecret = "da4480ace51a57892c4c1c32b25351bc";
     
    $redirect_uri = urlencode($redirect_uri);
    //1 第一步：用户同意授权，获取code
    $snsapi_userinfo_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=wtt#wechat_redirect";
    if(!isset($_GET['code'])) {
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

     return https_request($userinfo_url);
}

//https_request()请求
function https_request($url,$data=null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    if(!empty($data)) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($ch);
    curl_close($ch);
    $res = json_decode($res,true);
    return($res);
}
