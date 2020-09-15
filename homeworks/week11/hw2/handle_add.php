<?php
  session_start();
  require_once('conn.php');
  require_once('utility.php');
  if(empty($_POST['title']) || empty($_POST['content'])) {
    die("資料不完整");
  }
  if(empty($_SESSION['username']) || !checkMember($_SESSION['username'])){
    header("Location: index.php");
    exit();
  }
  $title = $_POST['title'];
  $content = $_POST['content'];

  $sql = "INSERT INTO `tingkao_blog_contents`(`title`, `content`) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $title, $content);
  $stmt->execute();
  if($conn->error || $stmt->error) {
    die('錯誤訊息： ' . $conn->error . $stmt->error);
  }
  $result = $stmt->get_result();
  if($stmt->affected_rows === 1) {
    // echo "新增成功";
    if(!empty($_POST['backend'])) {
      header("Location: manage.php");
    } else {
      header("Location: index.php");
    }
  }
?>