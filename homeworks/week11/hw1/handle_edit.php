<?php
  require_once('conn.php');
  if (empty($_POST['content']) || empty($_POST['id'])) {
    die('請填資料！');
  }
  // 可以透過 id 改別人的留言，用 session['username'] 來比對該留言的 username 是否同一人
  $content = $_POST['content'];
  $id = $_POST['id'];
  $edited = 1;
  $sql = "UPDATE `tingkao_comments` SET `content`= ?, `edited`= ? WHERE `id` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sis", $content, $edited, $id);
  $stmt->execute();
  if($conn->error || $stmt->error){
    echo "錯誤訊息：" . $conn->error . $stmt->error;
  } else {
    header("Location: home.php");
  }
?>