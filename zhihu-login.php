<?php
session_start();

if (isset($_SESSION['id'])) {
	header("location:zhihu.php");
}
/*if (isset($_COOKIE['username'])&&isset($_COOKIE['password'])) 
{
	$config=require_once 'php/config.php';
	$conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
	$conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	$sql="SELECT * FROM user WHERE user_name={$_COOKIE['username']}";
	if($conn->query($sql)->fetch(PDO::FETCH_ASSOC)['user_pw']==$_COOKIE['password'])
	{
		header("location:zhihu.php");
	}
}*/

?>






<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<title>知乎 - 与世界分享你的知识、经验和见解</title>
	<link rel="stylesheet" media="screen" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/zhihu-login.css" />
	<link rel="icon" href="zhihubyliu-yang/image/mingmeng.ico" type="image/x-icon" />
	<link rel="icon" href="https://static.zhihu.com/static/favicon.ico" type="image/x-icon" />
</head>
<body>

	<div class="container">
		<div class="header">
			<h1 class="logo-zhihu"></h1>
			<h2 class="sub-title">与世界分享你的知识、经验和见解</h2>
		</div>
		<div class="reg-log">
			<a  type="button" class="reg" >注册</a>
			<a  type="button" class="log" >登录</a>
		</div>
		<div class="register" >
			<form method="POST" action="php/reg.php" onsubmit="return check();">
				<div class="reg-inputs">
					<div class="reg-username-box">
						<input type="text" name="reg-username" placeholder="请输入用户名" class="username" id="username" />
					</div>
					<div class="reg-password-box">
						<input type="password" name="reg-upw" placeholder="请输入密码" class="password" id="password" />
					</div>
				</div>
				<button type="submit" class="reg-submit">注册知乎</button>
			</form>
		</div>
		<div class="login">
			<form method="POST" action="php/log.php">
				<div class="log-inputs">
					<div class="log-username-box">
						<input type="text" name="log-username" class="username" placeholder="用户名" id="username" />
					</div>
					<div class="log-password-box">
						<input type="password" name="log-upw" id="password" class="password" placeholder="密码" />
					</div>
				</div>
					<button type="submit" class="log-submit">登录</button>
			</form>
		</div>
	</div>
	<div class="copyright">
		<div>
			<p>© 2017 知乎 · 知乎圆桌 · 发现 · 移动应用 · 使用机构帐号登录 · 联系我们 · 来知乎工作<br>京 ICP 证 110745 号 · 京公网安备 11010802010035 号 · 出版物经营许可证</p>
		</div>
	</div>

	<div id="particles-js"></div>
<script src="js/particles.js"></script>
<script src="js/app.js"></script>
<script type="text/javascript" src="js/zhihu-login.js"></script>

</body>
</html>