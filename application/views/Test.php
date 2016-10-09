<?php !defined("FCPATH") && exit("Access Denied!"); ?>

<?php

error_reporting(0);
header("Content-type: text/plain");

?>

输出SiteUrl：

<?php echo site_url('Home'); ?>

输出BaseUrl：

<?php echo base_url('js/jquery.js'); ?>

输出，something不一定为变量，也可以为表达式：
<?php echo $something; ?>

判断：
<?php if($condition): ?>
	1
<?php elseif($cond2): ?>
	2
<?php else: ?>
	3
<?php endif; ?>

foreach：
形式1：
<?php foreach($arr as $val): ?>
<?php endforeach; ?>
形式2：
<?php foreach($arr as $key => $val): ?>
<?php endforeach; ?>

执行PHP代码：
<?php

echo "Hello World";

?>

