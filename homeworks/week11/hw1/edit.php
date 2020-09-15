<?php
    session_start();
    require_once('conn.php');
    if (empty($_GET['id'])) {
      die('error');
    }
    $username_session = $_SESSION['username'];
    $id = $_GET['id'];
    $sql = "SELECT * FROM `tingkao_comments` WHERE `id` = ? AND `username` = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $username_session);
    $stmt->execute();
    if($conn->error || $stmt->error){
      echo "錯誤訊息：" . $conn->error . $stmt->error;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</header>
  <div class="wrap">
    <h1>Comments - Edit</h1>

<?php
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
      // 留言者 跟 登入者不同人，防止直接從 URL 更改 id 號碼而改動他人留言
      header("Location: home.php");
    }
    $row = $result->fetch_assoc();
    $username = htmlspecialchars($row['username'], ENT_QUOTES);
    $content = htmlspecialchars($row['content'], ENT_QUOTES);
    $created_at = htmlspecialchars($row['created_at'], ENT_QUOTES);
    echo '<form class="comment__add" method="POST" action="handle_edit.php" >';
    echo    '<label for="">USERNAME: ' . $username . '</label>';
    echo    '<textarea name="content" id="" cols="30" rows="10" >' . $content . '</textarea>';
    echo    '<input type="text" name="id" value="' . $id . '" style="display:none;">';
    echo    '<input class="submit-btn" type="submit" value="提交">';
    echo '</form>';
    echo '<div class="comment__hr"></div>';
?>

    <div class="comment__hr"></div>
  </div>
</body>
</html>