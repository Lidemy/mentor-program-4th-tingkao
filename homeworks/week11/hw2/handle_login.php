<?php
  session_start();
  require_once('conn.php');
  if(empty($_POST['username']) || empty($_POST['password'])) {
    die("資料不完整");
  }
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM `tingkao_blog_manager` WHERE `username` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  if($conn->error || $stmt->error) {
    die('錯誤訊息： ' . $conn->error . $stmt->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if($row['password'] === $password) {
    // echo "登入成功";
    $_SESSION['username'] = $row['username'];
    header("Location: index.php");
  } else {
    header("Location: index.php?err=1");
  }
?>