<?php
$db_linkname="mysql:host=localhost;dbname=zhihu";
$db_username="root";
$db_password="";
$usernames=$_POST['log-username'];
$passwords=$_POST['log-upw'];
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
	    $user=$data-> fetch(PDO::FETCH_BOTH);
	    print_r($user);
	    /*if($user['user_pw']==$passwords)
	    {
	    	echo "<script>alert('登陆成功!".$user['user_pw']."按下确认键跳转返回登录页面!');</script>";
		    echo "<script>window.location.href='$url';</script>";
	    }
	    else
	    {
	    	echo "string";
	    }
*/	}
	catch(PDOException $e)
	{
	    echo $e->getMessage();
	}
}
else
	echo "表单没有填完整！";
?>