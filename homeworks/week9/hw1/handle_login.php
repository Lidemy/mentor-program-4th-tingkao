<?php
  session_start();
  require_once('conn.php');
  // require_once('utility.php');
  $username = $_POST['username'];
  $password = $_POST['password'];
  if(empty($username) || empty($username)) {
    die('資料錯誤');
  }
  $result = $conn->query("SELECT * FROM `tingkao_members` WHERE `username` = '$username' AND `password` = '$password'");
  if($conn->error){
    echo $conn->error;
  }
  if($conn->affected_rows === 1) {
    // echo "嗨！ ". $result->fetch_assoc()['nickname'] ." ，登入成功";
    // 產生 token 並寫入 database（自己實作 session 機制）
    $_SESSION['username'] = $username;
    header("Location: home.php");
  } else {
    // echo "帳號密碼錯誤";
    header("Location: home.php?login=err");
  }
?>