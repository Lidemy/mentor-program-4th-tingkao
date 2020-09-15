<?php
  require_once('conn.php');

  function checkMember($who_log_in) {
    global $conn;
    $sql = "SELECT COUNT(username) AS sum FROM `tingkao_blog_manager` WHERE `username` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $who_log_in);
    $stmt->execute();
    if($conn->error || $stmt->error) {
      die("錯誤訊息： " . $conn->error . $stmt->error);
    }
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if($row['sum'] === 1){
      return 1;
    }
    return 0;
  }

  function sumArticle() {
    global $conn;
    $sql = "SELECT COUNT(id) AS sumArticle FROM `tingkao_blog_contents` WHERE `is_deleted` = 0 AND `is_hidded` = 0";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if($conn->error || $stmt->error) {
      die("錯誤訊息： " . $conn->error . $stmt->error);
    }
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['sumArticle'];
  }
?>