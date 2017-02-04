<?php
$usernames=$_POST['reg-username'];
$passwords=$_POST['reg-upw'];
if($usernames&&$passwords){
	try
	{
	    $conn = new PDO("mysql:host=localhost;dbname=zhihu","root","");
	    echo "连接成功!";
	    $conn -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	    $data=$conn->query("SELECT * from users where user_name='{$usernames}'");
	    $dy=$data-> fetch(PDO::FETCH_ASSOC);
	    if(!empty($dy))
	    	echo "用户名已存在";
	    else
	    {
	    	$news=$conn->query("INSERT into users(user_name,user_pw)
			values('{$usernames}','{$passwords}')");
		    if($news)
		    {
		    	foreach ($conn->query("SELECT * from users where user_name='{$usernames}'") as $row) 
		    	{
		    		die("注册成功！".$row['user_name']);
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