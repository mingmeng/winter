<?php
session_start();
echo $_COOKIE['username'];
echo "<br>";
echo $_COOKIE['password'];
echo "<br>";
echo $_SESSION['id'];
echo "<br>";
echo $_SESSION['username'];