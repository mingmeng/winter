<?php
	session_start();
	$bedonerid=$_GET['bedoner'];
	$questionid=$_GET['question'];
	$answerid=$_GET['answerid'];
	$config=require_once 'config.php';
	date_default_timezone_set('prc');
	$time=date('Y-m-d H:i:s',time());
	$conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
	$conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$zero=0;
	$one=1;
	$demo=$conn->query("SELECT * FROM answerup WHERE answerid={$answerid} AND doner={$_SESSION['id']}")->fetch(PDO::FETCH_ASSOC);
	if ($bedonerid==$_SESSION['id']) {
		echo "不能给自己点赞哇!";
	}
	else if($demo)
	{
		echo "已经点过了~~~";
	}
	else
	{
		$insertInto=$conn->prepare("INSERT INTO `answerUp` (`up`, `down`, `doner`, `beDoner`, `question` ,`answerid`) VALUES (?,?,?,?,?,?)");
		$insertInto->bindParam(1,$one,PDO::PARAM_INT);
		$insertInto->bindParam(2,$zero,PDO::PARAM_INT);
		$insertInto->bindParam(3,$_SESSION['id'],PDO::PARAM_INT);
		$insertInto->bindParam(4,$bedonerid,PDO::PARAM_INT);
		$insertInto->bindParam(5,$questionid,PDO::PARAM_INT);
		$insertInto->bindParam(6,$answerid,PDO::PARAM_INT);
		$insertInto->execute();
		echo "成功点赞";
		header("location:../question.php?id=".$questionid);
	}		
?>