<?php
session_start();
	$config=require_once 'config.php';
	date_default_timezone_set('prc');
	$time=date('Y-m-d H:i:s',time());
	$conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
	$conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$insertInto=$conn->prepare("INSERT INTO `answerUp` (`id`, `up`, `down`, `doner`, `beDoner`, `question`, `time`) VALUES (?,?,?,?,?,?,'{$time}')");
?>