<?php

class Curl {
	public $ch;
	public $opts = array();
	public $result;
	public $showHeader = false;

	public function reset($url) {
		$this->ch = curl_init($url);
		$this->opts[CURLOPT_RETURNTRANSFER] = true;

		return $this;
	}

	/**
	 *	POST数据
	 *
	 *	@param $dataArr 要POST的数组
	 *	@access public
	 */
	public function setPost($dataArr) {
		$this->opts[CURLOPT_POST] = true;
		$this->opts[CURLOPT_POSTFIELDS] = http_build_query($dataArr);
		return $this;
	}

	/**
	 *	设置代理
	 *
	 *	@param $info 代理信息
	 *	@access public
	 */
	public function setProxy($info) {
		$param = explode(":", $info);
		$this->opts[CURLOPT_PROXY]	   = $param[0];
		$this->opts[CURLOPT_PROXYPORT] = $param[1];
		$this->opts[CURLOPT_TIMEOUT]   = 5;
		return $this;
	}

	/**
	 *	设置来源
	 *
	 *	@param $referer 来源URL
	 *	@access public
	 */
	public function setReferer($referer) {
		$this->opts[CURLOPT_REFERER] = $referer;
		return $this;
	}

	/**
	 *	传送COOKIE
	 *
	 *	@param $cookie COOKIE的值
	 *	@access public
	 */
	public function setCookie($cookie) {
		$this->opts[CURLOPT_COOKIE] = $cookie;
		return $this;
	}

	/**
	 *	设置IP
	 *
	 *	@param $ip IP地址
	 *	@access public
	 */
	public function setIP($ip) {
		$this->opts[CURLOPT_HTTPHEADER] = array(
			'X-FORWARDED-FOR:'.$ip,
			'CLIENT-IP:'.$ip
		);
		return $this;
	}

	/**
	 *	设置随机的IP
	 *
	 *	@access public
	 */
	public function setRandIP() {
		$IP = sprintf("%d.%d.%d.%d", rand(1,255), rand(0,255), rand(0,255), rand(0,255));
		$this->setIP($IP);
		return $this;
	}

	/**
	 *	HTTPS方式
	 *
	 *	@access public
	 */
	public function isHttps() {
		$this->opts[CURLOPT_SSL_VERIFYPEER] = FALSE;
		$this->opts[CURLOPT_SSL_VERIFYHOST] = FALSE;
		return $this;
	}

	/**
	 *	获取头部信息
	 *
	 *	@access public
	 */
	public function showHeader() {
		$this->opts[CURLOPT_HEADER] = true;
		return $this;
	}

	/**
	 *	跟踪跳转
	 *
	 *	@access public
	 */
	public function followLocation() {
		$this->opts[CURLOPT_FOLLOWLOCATION] = true;
		return $this;
	}

	/**
	 *	执行结果
	 *
	 *	@access public
	 */
	public function exec() {
		curl_setopt_array($this->ch, $this->opts);
		$this->result = curl_exec($this->ch);
		return $this;
	}

	/**
	 *	获取返回的结果
	 *
	 *	@access public
	 */
	public function result() {
		return $this->result;
	}

	/**
	 *	获取COOKIE，使用前需保证执行结果前调用过$this->showHeader()
	 *
	 *	@access public
	 */
	public function cookie() {
		preg_match_all("/Set\-Cookie:(.+?)\r\n/i", $this->result, $rawCookie);
		$cookie = implode(";", $rawCookie[1]);
		return $cookie;
	}

	public function close() {
		if($this->ch) {
			curl_close($this->ch);
		}
	}
}

?>