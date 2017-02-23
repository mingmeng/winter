<?php
	$request_q_id=$_GET['id'];
	$config=require_once 'config.php';
	$conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
	$conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$sql="SELECT * FROM ques WHERE ques_id={$request_q_id}";
	$data=$conn->query($sql)->fetch(PDO::FETCH_ASSOC);
?>
	<!DOCTYPE html>
	<meta charset="utf-8">
	<html>
	<head>
		<title><?php echo $data['ques_title']; ?></title>
	</head>
	<body>
	<div class=""><?php echo $data['ques_title']; ?></div>
	<h2><?php echo $data['questioner'];?></h2>
	<p><?php echo $data['ques_content']; ?></p>
	</body>
	</html>