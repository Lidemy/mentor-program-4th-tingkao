<?php
  session_start();
  require_once('conn.php');
  require_once('utility.php');
  if(empty($_POST['title']) || empty($_POST['content']) || empty($_POST['id']))  {
    die("資料不完整");
  }
  if(empty($_SESSION['username']) || !checkMember($_SESSION['username'])){
    header("Location: index.php");
    exit();
  }
  $title = $_POST['title'];
  $content = $_POST['content'];
  $id = $_POST['id'];
  $sql = "UPDATE `tingkao_blog_contents` SET `title`=?,`content`=? WHERE `id` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ssi', $title, $content, $id);
  $stmt->execute();
  if($conn->error || $stmt->error) {
    die('錯誤訊息： ' . $conn->error . $stmt->error);
  }
  if(!empty($_POST['backend'])) {
    header("Location: manage.php");
  } else {
    header("Location: index.php");
  }
?>