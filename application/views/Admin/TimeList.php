<?php !defined("FCPATH") && exit("Access Denied!"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>预约管理</title>
</head>
<body>

<?php foreach($list as $val): ?>

date:<?php echo $val["date"]; ?> time:<?php echo $val["start"]; ?>--<?php echo $val["end"]; ?> <br/>
price:<?php echo $val["price"]; ?> 
status:
<?php if($val["status"]==1): ?>
    开放预约
<?php elseif($val["status"]==2): ?>
    已被预约,预约人uid:<?php echo $val['uid']; ?>
<?php else: ?>
    不开放预约
<?php endif; ?>
<br/>
<?php if($val["status"]==1): ?>
    <a href="<?php echo site_url('Admin/TimeList/lock/'.$val['list_id']); ?>">关闭预约</a>
<?php elseif($val["status"]==2): ?>
    <a href="<?php echo site_url('Admin/TimeList/cancelOrder/'.$val['list_id']); ?>">撤销预约</a>
<?php elseif($val["status"]==3): ?>
    <a href="<?php echo site_url('Admin/TimeList/unlock/'.$val['list_id']); ?>">开放预约</a>
<?php endif; ?>
<br/>
<br/>
<?php endforeach; ?>
</body>
</html>