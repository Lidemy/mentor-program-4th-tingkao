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
        echo '<li><a href="add.php">新增文章</a></li>';
        echo '<li><a href="manage.php">管理後台</a></li>';
        echo '<li><a href="handle_logout.php">登出</a></li>';
      } else {
        echo '<li><a href="#" class="to_login-btn">登入</a></li>';
      }
?>
      </ul>
    </div>
  </nav>
  <header>
    <h2>存放技術之地</h2>
    <div>Welcome to my blog</div>
  </header>

  <section class="section__articles">

<?php
  $sum = sumArticle();
  $article_per_page = 5;
  $total_pages = ceil( $sum / $article_per_page );
  $state_page = (!empty($_GET['page']))? $_GET['page'] : "1";
  if($state_page < 1) {
    $state_page = 1;
  } else if ($state_page > $total_pages) {
    $state_page = $total_pages;
  }
  $first_article_index = 5 * ($state_page - 1);
  $sql = "SELECT * FROM `tingkao_blog_contents` WHERE `is_deleted` = 0 AND `is_hidded` = 0 ORDER BY `created_at` DESC LIMIT ? OFFSET ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $article_per_page, $first_article_index);
  $stmt->execute();
  if($conn->error || $stmt->error){
    die("錯誤訊息： " . $conn->error . $stmt->error);
  }
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()) {
?>    
    <article class="article">
      <div class="article__wrap">
        <h3 class="article__title"><?php echo htmlspecialchars($row['title'], ENT_QUOTES)?></h3>
<?php
  
  if($is_login){
    echo '<a href="handle_delete.php?id='. $row['id'] .'" class="article__delete-btn">刪除</a>';
    echo '<a href="edit.php?id=' . $row['id'] . '" class="article__edit-btn">編輯</a>';
  }
?>
        <div class="article__info">
          <div class="timestamp"><?php echo htmlspecialchars($row['created_at'], ENT_QUOTES)?></div>
          <div class="tag">歷史公告</div>
        </div>
        <p class="article__content"><?php echo htmlspecialchars($row['content'], ENT_QUOTES)?></p>
        <span>...</span>
        <a href="blog_page.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES)?>" class="article__more-btn">Read More</a>
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


  <div class="section__pages">
    <ul>
      <li>
<?php
        $former_page = (($state_page - 1) >= 1) ? ($state_page - 1) : $state_page;
        $next_page = (($state_page + 1) <= $total_pages) ? ($state_page + 1) : $state_page;
        echo '<a href="index.php?page='.$former_page.'" class="former-page-bt"><<</a>';
        for($i = 1; $i <= $total_pages; $i += 1){
          echo '<a href="index.php?page='.$i.'" class="page-btn" data-page="'.$i.'">'.$i.'</a>';
        }

        echo '<a href="index.php?page='.$next_page.'" class="former-page-bt">>></a>';
?>
      </li>
    </ul>
  </div>
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
  document.querySelectorAll('.page-btn').forEach(function(el){
    el.classList.remove('active');
  })
  document.querySelector('.page-btn[data-page="<?php print_r($state_page)?>"]').classList.add('active');
  function visitMode() {
    document.querySelector('.section__login').classList.add('hidden');
    document.querySelector('.dark_bgc').classList.add('hidden');
    window.location.href = 'index.php';
  }
  document.querySelector('.cancel').addEventListener('click', visitMode);
  document.querySelector('.visiter_login-btn').addEventListener('click', visitMode);
  if(document.querySelector('.to_login-btn')){
    document.querySelector('.to_login-btn').addEventListener('click', function(){
      document.querySelector('.section__login').classList.remove('hidden');
      document.querySelector('.dark_bgc').classList.remove('hidden');
    })
  }

  document.querySelector('.section__login-form').addEventListener('submit', function(e){
    let isValued = true;
    document.querySelectorAll('.section__login-form input').forEach(function(el){
      if(!el.value){
        isValued = false;
        e.preventDefault();
      }
    })
    if(!isValued){
      alert('請填妥資料');
    }
  })
  
</script>

<?php
  if(!empty($_GET['err']) && ($_GET['err'] === "1")) {
    echo "<script>document.querySelector('.section__login-form span').classList.remove('hidden');</script>";
    echo "<script>document.querySelector('.to_login-btn').click();</script>";
  }
?>
</html>