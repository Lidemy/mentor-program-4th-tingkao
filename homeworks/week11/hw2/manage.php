<?php
  session_start();
  require_once('conn.php');
  require_once('utility.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Who's Blog</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar">
    <div class="navbar-wrap">
      <h1><a href="index.php">Who's Blog</a></h1>
      <ul class="navbar__categories">
        <li><a href="index.php">文章列表</a></li>
        <li><a href="#">分類專區</a></li>
        <li><a href="#">關於我</a></li>
      </ul>
      <ul class="navbar__functions">
<?php
      $is_login = false;
      if(!empty($_SESSION['username']) && checkMember($_SESSION['username'])){
        $is_login = true;
        echo '<li><a href="add.php?backend=1">新增文章</a></li>';
        echo '<li><a href="handle_logout.php">登出</a></li>';
      } else {
        header("Location: index.php");
      }
?>
      </ul>
    </div>
  </nav>
  <header>
    <h2>存放技術之後台管理系統</h2>
  </header>

  <section class="section__articles-manage">

<?php
  $sql = "SELECT * FROM `tingkao_blog_contents` WHERE `is_deleted` = 0 AND `is_hidded` = 0 ORDER BY `created_at` DESC ";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  if($conn->error || $stmt->error){
    die("錯誤訊息： " . $conn->error . $stmt->error);
  }
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()) {
?>    
    <article class="article-manage">
        <h3 class="article__title-manage"><?php echo htmlspecialchars($row['title'], ENT_QUOTES)?></h3>

        <div class="article__info-manage">
          <div class="timestamp-manage"><?php echo htmlspecialchars($row['created_at'], ENT_QUOTES)?></div>
          <div class="tag-manage">歷史公告</div>
<?php
          if($is_login){
            echo '<a href="handle_hide.php?backend=1&id='. $row['id'] .'" class="article__hide-btn manage">隱藏</a>';
            echo '<a href="handle_delete.php?backend=1&id='. $row['id'] .'" class="article__delete-btn manage">刪除</a>';
            echo '<a href="edit.php?backend=1&id=' . $row['id'] . '" class="article__edit-btn manage">編輯</a>';
          }
?>
        </div>
    </article>
<?php 
  }
?>
    <div class="hidden_article">被隱藏的文章</div>
<?php
  $sql_hide = "SELECT * FROM `tingkao_blog_contents` WHERE `is_deleted` = 0 AND `is_hidded` = 1 ORDER BY `created_at` DESC ";
  $stmt_hide = $conn->prepare($sql_hide);
  $stmt_hide->execute();
  if($conn->error || $stmt_hide->error){
    die("錯誤訊息： " . $conn->error . $stmt_hide->error);
  }
  $result_hide = $stmt_hide->get_result();
  while($row_hide = $result_hide->fetch_assoc()) {
?>   

    

    <article class="article-manage hide">
        <h3 class="article__title-manage"><?php echo $row_hide['title']?></h3>

        <div class="article__info-manage">
          <div class="timestamp-manage"><?php echo $row_hide['created_at']?></div>
          <div class="tag-manage">隱藏公告</div>
<?php
          if($is_login){
            echo '<a href="handle_unhide.php?backend=1&id='. $row_hide['id'] .'" class="article__hide-btn manage">顯示</a>';
            echo '<a href="handle_delete.php?backend=1&id='. $row_hide['id'] .'" class="article__delete-btn manage">刪除</a>';
            echo '<a href="edit.php?backend=1&id=' . $row_hide['id'] . '" class="article__edit-btn manage">編輯</a>';
          }
?>
        </div>
    </article>

<?php 
  }
?>
  </section>
  <div class="dark_bgc hidden"></div>
  <section class="section__login hidden">
    <h2>會員登入</h2>
    
    <form method="POST" action="handle_login.php" class="section__login-form">
      <label for="username">帳號：
        <input type="text" name="username">
      </label>
      <span class="hidden">帳號密碼錯誤</span>
      <label for="password">密碼：
        <input type="password" name="password">
      </label>
      <input class="handle_login-btn" type="submit" value="登入">
    </form>
    <div class="cancel">X</div>
    <div class="visiter_login-btn">我只是個訪客</div>
  </section>
  <footer>
    <p>Copyright © 2020 Who's Blog All Rights Reserved.</p>
  </footer>
</body>

<script>

  let isLogin = Number(<?php print_r($is_login) ?>)
  if(isLogin){
    document.querySelector('.section__login').classList.add('hidden');
    document.querySelector('.dark_bgc').classList.add('hidden');
  }
  function visitMode() {
    document.querySelector('.section__login').classList.add('hidden');
    document.querySelector('.dark_bgc').classList.add('hidden');
    window.location.href = 'index.php';
  }
</script>

<?php
  if(!empty($_GET['err']) && ($_GET['err'] === "1")) {
    echo "<script>document.querySelector('.section__login-form span').classList.remove('hidden');</script>";
    echo "<script>document.querySelector('.to_login-btn').click();</script>";
  }
?>
</html>