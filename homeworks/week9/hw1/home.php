<?php
  session_start();
  $whoLogin = null;
  if(!empty($_GET['error']) && $_GET['error']==='1'){
    echo "<script>alert('資料不齊全')</script>";
    // 這個空格檢查方法，重新整理後還是會在(因為網址還是帶了 ?error=1 的資料)，所以比較好的方法是用 Js 做表單驗證
  }
  require_once('conn.php');
  $sql = "SELECT * FROM `tingkao_comments` ORDER BY `created_at` DESC";
  $result = $conn->query($sql);
  if($conn->error){
    die('錯誤' . $conn->error);
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
    <h1>Comments</h1>

    
<?php if (!empty($_SESSION['username'])) { 
        // 找出該 token 所對應到的 nickname
        $data_sql = sprintf("SELECT nickname FROM `tingkao_members` WHERE username = '%s'", $_SESSION['username']);
        $data = $conn->query($data_sql);
        if($conn->error) {
          die($conn->error);
        }
        if(!$conn->affected_rows){
          /*cookie 比對不到相對應的資料，cookie 被 clien 端隨意填入假資料*/
          session_destroy();
          header("Location: home.php");
        }
        $login_nickname = $data->fetch_assoc()['nickname'];
        $whoLogin = $_SESSION['username'];
?>
    <div class="member-register-btn">
      <a href="handle_logout.php" class="logout-btn">會員登出</a>
    </div>
    <form class="comment__add" method="POST" action="handle_add.php" >
      <label for="">想說點什麼呢？ <?php echo $login_nickname ?> 
        <input class="nickname" type="hidden" name="nickname" value="<?php echo $login_nickname ?>">
        <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>">
      </label>
      <textarea name="content" id="" cols="30" rows="10"></textarea>
      <input class="submit-btn" type="submit" value="提交">
    </form>
<?php } else {?> 
    <div class="member-register-btn">
      <a href="#" class="register-btn">會員註冊</a>
    </div>
<?php } ?>

    <div class="comment__hr"></div>
    <div class="comment__cards-group">
<?php
  while ($row = $result->fetch_assoc()) {
    $username = $row['username'];
    $nickname = $row['nickname'];
    $content = $row['content'];
    $created_at = $row['created_at'];
    $id = $row['id'];
    echo '<div class="card">';
    echo    '<div class="card-avatar"></div>';
    echo    '<div class="card-info">';
    echo        '<div class="card-user">' . $nickname . '</div>';
    echo        '<div class="card-dot"></div>';
    echo        '<div class="card-time">' . $created_at . '</div>';
    echo    '</div>';
    echo    '<div class="content">'. $content .'</div>';
    echo    '<div class="card-btn">';
    if ($whoLogin === $username) { 
      echo        '<a href="handle_delete.php?id=' . $id . '" class="delete-btn">刪除 </a>';
      echo        '<a href="edit.php?id=' . $id . '" class="edit-btn">編輯</a>';
    };
    echo    '</div>';
    echo '</div>';
  }
?>
    <div class="comment__hr"></div>
  </div>

  <section class="comment__register hidden">
    <h2>會員註冊</h2>
    <form method="POST" action="handle_register.php" class="comment__register-form">
      <label for="username">帳號：
        <input type="text" name="username">
      </label>
      <label for="nickname">暱稱：
        <input type="text" name="nickname">
      </label>
      <label for="password">密碼：
        <input type="password" name="password">
      </label>
      <input class="handle-register-btn" type="submit" value="註冊">
    </form>
    <div class="to-login">我要登入會員</div>
    <div class="cancel">X</div>
  </section>

  <section class="comment__login hidden">
    <h2>會員登入</h2>
    <form method="POST" action="handle_login.php" class="comment__login-form">
      <label for="username">帳號：
        <input type="text" name="username">
      </label>
      <label for="password">密碼：
        <input type="password" name="password">
      </label>
      <input class="handle-login-btn" type="submit" value="登入">
    </form>
    <div class="to-register">沒有會員？我要註冊</div>
    <div class="cancel">X</div>
  </section>
</body>
<script src="register.js"></script>
<?php
  //帳號重複問題，因為要觸發 click() 事件，所以要放在 js 檔案後面
  if(!empty($_GET['register']) && $_GET['register']==='re'){
    echo "<script>
            alert('帳號已被註冊！');
            document.querySelector('.register-btn').click();
          </script>";
  }
  //帳號密碼錯誤
  if(!empty($_GET['login']) && $_GET['login']==='err'){
    echo "<script>
            alert('帳號密碼錯誤');
            document.querySelector('.to-login').click();
          </script>";
  }
?>
</html>