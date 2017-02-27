<?php
	session_start();
	$answer=$_GET['answer_content'];
	$ques=$_GET['ques_id'];
	$config=require_once 'config.php';
	$zero=0;
	$conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
	$conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$number=$conn->query("SELECT answer_id FROM answer ORDER BY answer_id DESC")->fetch(PDO::FETCH_ASSOC)['answer_id']+1;
	$author=$conn->query("SELECT id FROM user WHERE user_name='{$_SESSION['username']}'")->fetch(PDO::FETCH_ASSOC)['id'];
	$insert_into=$conn->prepare("INSERT INTO answer (answer_id,answer_content,answer_author,answer_up,answer_down,answer_pq_id) VALUES (?,?,?,?,?,?)");
	$insert_into->bindParam(1,$number, PDO::PARAM_INT);
	$insert_into->bindParam(2,$answer, PDO::PARAM_STR);
	$insert_into->bindParam(3,$author, PDO::PARAM_STR);
	$insert_into->bindParam(4,$zero, PDO::PARAM_INT);
	$insert_into->bindParam(5,$zero, PDO::PARAM_INT);
	$insert_into->bindParam(6,$ques, PDO::PARAM_INT);
	$insert_into->execute();
	echo "回答成功,将在三秒后跳转";
	header("location:../question.php?id=".$ques);
?>