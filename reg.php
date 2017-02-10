<?php
$db_linkname="mysql:host=localhost;dbname=zhihu";
$db_username="root";
$db_password="";
$usernames=$_POST['reg-username'];
$passwords=$_POST['reg-upw'];
$user_inf=$_POST['reg-username']."_inf";
$url="zhihu-login.html";
if($usernames&&$passwords){
	try
	{
	    $conn = new PDO($db_linkname,$db_username,$db_password);
	    if(!$conn)
	    {
	    	die("<script>alert('连接失败!');</script>");
	    }
	    $conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	    $data=$conn->query("SELECT * from user where user_name='{$usernames}'");
	    $dy=$data-> fetch(PDO::FETCH_BOTH);
	    if(!empty($dy))
	    	echo "由于用户名已存在或某些不可预知的错误,注册失败！";
	    else
	    {
	    	$news=$conn->query("INSERT INTO user (user_name,user_pw,user_information)
			values('{$usernames}','{$passwords}','{$user_inf}')");
		    if($news)
		    {
		    	foreach ($conn->query("SELECT * from user where user_name='{$usernames}'") as $row) 
		    	{
		    		echo "<script>alert('注册成功!".$row['user_name']."按下确认键跳转返回登录页面!');</script>";
		    		echo "<script>window.location.href='$url';</script>";
		    	}
		    }
		    else
		    	echo "注册失败！";
	    }
	}
	catch(PDOException $e)
	{
	    echo $e->getMessage();
	}
}
else
	echo "表单没有填完整！";
?>