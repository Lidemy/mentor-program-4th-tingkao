<?php
  session_start();
  require_once('conn.php');
  require_once('utility.php');
  if(empty($_GET['id'])) {
    die("資料不完整");
  }
  if(empty($_SESSION['username']) || !checkMember($_SESSION['username'])){
    header("Location: index.php");
    exit();
  }
  $id = $_GET['id'];
  $is_deleted = 1;
  // die($id);
  $sql = "UPDATE `tingkao_blog_contents` SET `is_deleted` = ? WHERE `id` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $is_deleted, $id);
  $stmt->execute();
  if($conn->error || $stmt->error) {
    die('錯誤訊息： ' . $conn->error . $stmt->error);
  }
  $result = $stmt->get_result();
  if($stmt->affected_rows === 1) {
    // echo "新增成功";
    if(!empty($_GET['backend'])) {
      header("Location: manage.php");
    } else {
      header("Location: index.php");
    }
  }
?>