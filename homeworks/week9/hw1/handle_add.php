<?php
  require_once('conn.php');
  if (empty($_POST['nickname']) || empty($_POST['content'])) {
    // die('請填妥資料！');
    header("Location: home.php?error=1");
    exit();
  }
  $username = $_POST['username'];
  $niackname = $_POST['nickname'];
  $content = $_POST['content'];
  $conn->query("INSERT INTO `tingkao_comments`(`username`, `nickname`, `content`) VALUES ('$username', '$niackname', '$content')");
  if($conn->error){
    echo "錯誤" . $conn->error;
  } else {
    header("Location: home.php");
  }
?>