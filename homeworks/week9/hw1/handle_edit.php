<?php
  require_once('conn.php');
  if (empty($_POST['nickname']) || empty($_POST['content']) || empty($_POST['id'])) {
    die('請填資料！');
  }
  $niackname = $_POST['nickname'];
  $content = $_POST['content'];
  $id = $_POST['id'];
  $conn->query("UPDATE `tingkao_comments` SET `nickname`='$niackname',`content`='$content' WHERE `id` = '$id'");
  if($conn->error){
    echo "錯誤" . $conn->error;
  } else {
    header("Location: home.php");
  }
?>