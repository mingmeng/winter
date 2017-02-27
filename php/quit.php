<?php
session_start();
setcookie("username", "", time()-3600*24*365);  
setcookie("password","", time()-3600*24*365);
session_unset();
session_destroy();
header("location:../zhihu.php");
?>