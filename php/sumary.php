	<?php
		session_start();
			$title=$_GET['ques-title'];
			$content=$_GET['ques-content'];
			$author=$_SESSION['username'];
			$config=require_once 'config.php';
			$conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
			$conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
			$number=$conn->query("SELECT ques_id FROM ques ORDER BY ques_id DESC")->fetch(PDO::FETCH_ASSOC)['ques_id']+1;
			$demo=$conn->prepare("INSERT INTO ques (ques_id,ques_title,ques_content,questioner) VALUES (?,?,?,?)");
			$demo->bindParam(1,$number, PDO::PARAM_INT);
			$demo->bindParam(2,$title, PDO::PARAM_STR);
			$demo->bindParam(3,$content, PDO::PARAM_STR);
			$demo->bindParam(4,$author, PDO::PARAM_STR);
			$demo->execute();
			echo "<script>alert('提问成功".$_SESSION['username']."')</script>";
			header("location:../zhihu.php");
		?>