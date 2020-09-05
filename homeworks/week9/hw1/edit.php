<?php
    require_once('conn.php');
    if (empty($_GET['id'])) {
      die('error');
    }
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM `tingkao_comments` WHERE `id` = $id");
    if($conn->error){
      echo $conn->error;
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
    $row = $result->fetch_assoc();
    $nickname = $row['nickname'];
    $content = $row['content'];
    $created_at = $row['created_at'];
    echo '<form class="comment__add" method="POST" action="handle_edit.php" >';
    echo    '<label for="">NICKNAME： <input class="nickname" type="text" name="nickname" value="' . $nickname . '"></label>';
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