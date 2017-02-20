<?php
session_start();
$usernames=$_POST['log-username'];
$passwords=md5($_POST['log-upw']);
$url="../zhihu-login.html";
header( 'Content-Type:text/html;charset=utf-8 ');
if($usernames!=''&&$passwords!=''&&ctype_alnum($usernames)&&ctype_alnum($passwords)){
	try
	{
		$config=require_once 'config.php';
	    $conn = new PDO($config['db_linkname'],$config['db_username'],$config['db_password']);
	    if(!$conn)
	    {
	    	die("<script>alert('连接失败!');</script>");
	    }
	    $conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	    $data=$conn->query("SELECT * FROM user WHERE user_name='{$usernames}'");
	    $user=$data-> fetch(PDO::FETCH_BOTH);
	    if($user['user_pw']==$passwords)
	    {
	    	echo "<script>alert('登陆成功!".$user['user_name']."按下确认键跳转返回登录页面!');</script>";
		    echo "<script>window.location.href='$url';</script>";
	    }
	    else
	    {
	    	echo "<script>alert('您的账号或者密码有误,登陆失败!');</script>";
	    	echo "<script>window.location.href='$url';</script>";
	    }
	}
	catch(PDOException $e)
	{
	    echo $e->getMessage();
	}
}
else
{
	echo "<script>alert('由于某未知错误或表单为空,登陆失败!');</script>";
	echo "<script>window.location.href='$url';</script>";
}

/*username = trim($_POST['username']);  
$password = md5(trim($_POST['password']));  
$validatecode = $_POST['validateCode'];  
$ref_url = $_GET['req_url'];  
$remember = $_POST['remember'];  
  
$err_msg = '';  
if($validatecode!=$_SESSION['checksum']){  
$err_msg = "验证码不正确";  
}
else if($username=='' || $password=='')
{  
	$err_msg = "用户名和密码都不能为空";
}
else
{
$row = getUserInfo($username,$password);  
  
if(empty($row)){  
$err_msg = "用户名和密码都不正确";  
}else{  
$_SESSION['user_info'] = $row;  
if(!empty($remember)){     //如果用户选择了，记录登录状态就把用户名和加了密的密码放到cookie里面  
setcookie("username", $username, time()+3600*24*365);  
setcookie("password", $password, time()+3600*24*365);  
}  
if(strpos($ref_url,"login.php") === false){  
header("location:".$ref_url);  
}else{  
header("location:main_user.php");  
}  
}  
}*/
?>
