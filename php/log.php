<?php
session_start();
$usernames=$_POST['log-username'];
$passwords=md5($_POST['log-upw']);
$url="../zhihu.php";
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
	    	$_SESSION['id']=$user['id'];
	    	$_SESSION['username']=$usernames;
	    	setcookie("username", $usernames, time()+3600*24*365);
			setcookie("password", $passwords, time()+3600*24*365);
	    	echo "<script>alert('登陆成功!".$user['user_name']."按下确认键进入主页!');</script>";
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


?>
