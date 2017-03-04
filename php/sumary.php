		<?php
			session_start();
			$title=$_GET['ques-title'];
			$content=$_GET['ques-content'];
			$author=$_SESSION['username'];
			$config=require_once 'config.php';
			$conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
			$conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
			$numbera=$conn->query("SELECT * FROM ques ORDER BY ques_id DESC")->fetch(PDO::FETCH_ASSOC);
			$number=$numbera['ques_id']+1;
			$demo=$conn->prepare("INSERT INTO ques (ques_id,ques_title,ques_content,questioner,questioner_id) VALUES (?,?,?,?,?)");
			$demo->bindParam(1,$number, PDO::PARAM_INT);
			$demo->bindParam(2,$title, PDO::PARAM_STR);
			$demo->bindParam(3,$content, PDO::PARAM_STR);
			$demo->bindParam(4,$author, PDO::PARAM_STR);
			$demo->bindParam(5,$_SESSION['id'], PDO::PARAM_STR);
			$demo->execute();
			echo "<script>alert('提问成功".$_SESSION['username']."2秒后将跳转至主页!');</script>";
			$url='"../zhihu.php"';
			header("refresh:2;url={$url}");
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>跳转中....</title>
		</head>
		<body>
		<a href="../zhihu.php" style="display: block;margin: 0 auto;"><h1>若未跳转请点击这里</h1></a>
		</body>
		</html>