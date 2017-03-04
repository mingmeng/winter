<?php
$usernames=$_POST['reg-username'];
$passwords=md5($_POST['reg-upw']);
$url="../zhihu-login.php";
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
	    $dy=$data-> fetch(PDO::FETCH_BOTH);
	    if(!empty($dy))
	    {
	    	echo "<script>alert('由于用户名已注册或某未知错误,注册失败!');</script>";
	    	echo "<script>window.location.href='$url';</script>";
	    }
	    else
	    {
	    	$numbersa=$conn->query("SELECT * FROM user ORDER BY id desc")->fetch(PDO::FETCH_ASSOC);
	    	$numbers=$numbersa['id']+1;
	    	$news=$conn->query("INSERT INTO user (id,user_name,user_pw)
			VALUES({$numbers},'{$usernames}','{$passwords}')");
		    if($news)
		    {
		    	$row=$conn->query("SELECT * FROM user WHERE user_name='{$usernames}'")->fetch(PDO::FETCH_BOTH);
		    	echo "<script>alert('注册成功!".$row['user_name']."按下确认键跳转返回登录页面!');</script>";
		    	echo "<script>window.location.href='$url';</script>";
		    }
		    else
		    {
		    	echo "<script>alert('由于某未知错误,注册失败!');</script>";
	    		echo "<script>window.location.href='$url';</script>";
		    }
	    }
	}
	catch(PDOException $e)
	{
	    echo $e->getMessage();
	}
}
else
{
	echo "<script>alert('由于某未知错误或表单为空,注册失败!');</script>";
	echo "<script>window.location.href='$url';</script>";
}
?>