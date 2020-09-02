<?php
  session_start();
  require_once('conn.php');
  require_once('utility.php');
  if(empty($_POST['username']) || empty($_POST['nickname']) || empty($_POST['password'])) {
    die('請填妥資料');
  }
  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  $password = $_POST['password'];
  $result = $conn->query("INSERT INTO `tingkao_members`(`username`, `nickname`, `password`) VALUES ('$username', '$nickname', '$password')");
  if(!empty($conn->error)) {
    if($conn->errno === 1062){
      // die('帳號已被註冊');
      header("Location: home.php?register=re");
    }
    die('錯誤' . $conn->error);
  } else {
    $_SESSION['username'] = $username;
    header("Location: home.php");
  }
  
?>