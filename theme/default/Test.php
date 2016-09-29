<?php !defined("FCPATH") && exit("Access Denied!"); ?>

<!--{execute}-->
error_reporting(0);
header("Content-type: text/plain");
<!--{/execute}-->

输出SiteUrl：

{:site_url('Home')}

输出BaseUrl：

{:base_url('js/jquery.js')}

输出，something不一定为变量，也可以为表达式：
{:$something}

判断：
<!--{if $condition}-->
	1
<!--{elseif $cond2}-->
	2
<!--{else}-->
	3
<!--{/if}-->

foreach：
形式1：
<!--{foreach $arr $val}-->
<!--{/foreach}-->
形式2：
<!--{foreach $arr $key $val}-->
<!--{/foreach}-->

执行PHP代码：
<!--{execute}-->
echo "Hello World";
<!--{/execute}-->

