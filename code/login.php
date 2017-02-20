<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location:./admin.php');
}
if (!empty($_POST)) {
    if (isset($_POST['username']) && $_POST['username'] != '' &&
        isset($_POST['password']) && $_POST['password'] != '') {
        //限制用户名中不可以输单引号 和 --，它们会影响sql语句执行
        //1.正则表达式替换 2.addslashes
        $username = addslashes($_POST['username']);
        $salt = "tianwanggaidihu";
        $password = md5(md5($_POST['password']).$salt);
        try {
            $config = require_once './config.php';
            $pdo = new PDO($config['dsn'], $config['user'], $config['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $res = $pdo->query("select * from user where username='{$username}'");
            $data = $res->fetch(PDO::FETCH_ASSOC);
            if ($password == $data['password']) {
                $_SESSION['username'] = $username;
                header('location:./admin.php');
            }else {
                echo "<script>alert('登录失败')</script>";
            }
        } catch (PDOException $e) {
            echo "数据库连接失败";
        }
    }else {
        echo "<script>alert('表单未填完整')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>

<style>
    .s_center {
        margin-left: auto;
        margin-right: auto;
    }
</style>
<div class="s_center container">

    <form class="form-signin" method="post" action="./login.php">
        <h2 class="form-signin-heading">请登录</h2>
        <label class="sr-only">用户名</label>
        <input type="text"  class="form-control" name="username" placeholder="请填写用户名" required autofocus>
        <br />
        <label  class="sr-only">密码</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码" required>
        <br />
        <input class="btn btn-lg btn-primary btn-block" id="login-button" type="submit" name="submit" value="登录">
    </form>

</div>
</body>
</html>