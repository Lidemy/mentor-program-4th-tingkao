<?php
  session_start();
  require_once('conn.php');
  // require_once('utility.php');
  $username = $_POST['username'];
  $password = $_POST['password'];
  if(empty($username) || empty($username)) {
    die('資料錯誤');
  }
  $sql = "SELECT `password`, `member_status` FROM `tingkao_members` WHERE `username` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  if($conn->error || $stmt->error){
    echo "錯誤訊息：" . $conn->error . $stmt->error;
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  // print_r('有幾行:' . $stmt->affected_rows);
  // print_r('有幾行:' . $result->num_rows);
  // print_r('if 判斷:' . ($result->num_rows));

  if($result->num_rows === 1) {
    $pwd_hashed = $row ['password'];
    $member_status = $row ['member_status'];
    $isVarified = password_verify($password, $pwd_hashed);
    if($isVarified){
      // echo "登入成功";
      $_SESSION['username'] = $username;
      $_SESSION['member_status'] = $member_status;
      header("Location: home.php");
    }else {
      // echo "帳號密碼錯誤";
      header("Location: home.php?login=err");
    }
  } else {
    // echo "查無此帳號";
    header("Location: home.php?login=err");
  }
?>