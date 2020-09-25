<?php
  require_once('conn.php');
  session_start();
  if (empty($_POST['nickname']) || empty($_POST['content'])) {
    // die('請填妥資料！');
    header("Location: home.php?error=1");
    exit();
  }
  $username = $_POST['username'];
  $member_status = $_SESSION['member_status'];
  if($member_status === "banned"){
   echo "您的帳號已被管制，暫時無法新增留言。";
  ?>
    <br>
    <a href="home.php">回到留言區</a>
  <?php
    exit();
  }
  // $niackname = $_POST['nickname'];
  $content = $_POST['content'];
  $sql = "INSERT INTO `tingkao_comments`(`username`, `content`) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $content);
  $result = $stmt->execute();
  if($stmt->error){
    echo "錯誤：" . $stmt->error;
  } else {
    header("Location: home.php");
  }
?>