<!DOCTYPE html>
<html>
<head>
	<title><?php echo $navTitle ? $navTitle : ""; ?></title>
	<script type="text/javascript" src="<?php echo base_url('js/vue.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('js/component.js'); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('image/reset.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('image/style.css'); ?>">
	<script type="text/javascript">
	var toastData = {
		content: ""
	}
	</script>
</head>
<body id="globalBody">