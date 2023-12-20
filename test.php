<?php
include_once("DB/db_connection.php");
include_once("login/password.php"); // 패스워드 암호화


$sql = "UPDATE FROM member ";

$mb_no_pw = trim($_POST["mb_no_pw"]);
$mb_pwd = trim($_POST["mb_pwd"]);

$hash_user_pwd = password_hash($mb_pwd, PASSWORD_BCRYPT);

?>