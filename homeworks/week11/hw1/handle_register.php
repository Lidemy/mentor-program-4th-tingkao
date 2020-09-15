<?php
  session_start();
  require_once('conn.php');
  require_once('utility.php');
  if(empty($_POST['username']) || empty($_POST['nickname']) || empty($_POST['password'])) {
    die('請填妥資料');
  }
  $username = $_POST['username'];
  $nickname = $_POST['nickname'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $sql = "INSERT INTO `tingkao_members`(`username`, `nickname`, `password`) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $username, $nickname, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if(!empty($stmt->error)) {
    if($stmt->errno === 1062){
      // die('帳號已被註冊');
      header("Location: home.php?register=re");
    }
    // 其他錯誤，$conn->error：preare() failed
    die('錯誤訊息：' . $conn->error . $stmt->error);
  } else {
    $_SESSION['username'] = $username;
    $_SESSION['member_status'] = "user";
    header("Location: home.php");
  }
  
?>