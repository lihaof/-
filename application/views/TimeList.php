<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>预约</title>
</head>
<body>

<?php foreach($list as $val): ?>

date:<?php echo $val["date"]; ?> time:<?php echo $val["start"]; ?>--<?php echo $val["end"]; ?> <br/>
price:<?php echo $val["price"]; ?> 
status:
<?php if($val["status"]==1): ?>
	开放预约 <a href="<?php echo site_url('Order/add/'.$val['list_id']); ?>">预约</a>
<?php elseif($val["status"]==2): ?>
	已被预约
<?php else: ?>
	不开放预约
<?php endif; ?>
<br/>
<br/>
<?php endforeach; ?>
</body>
</html>