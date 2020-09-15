<?php
  session_start();
  require_once('conn.php');
  require_once('utility.php');
  $isLogin = true;
  if(empty($_SESSION['username']) || !checkMember($_SESSION['username'])){
    $isLogin = false;
  }
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
  if($isLogin){
        echo '<li><a href="add.php">新增文章</a></li>';
        echo '<li><a href="manage.php">管理後台</a></li>';
        echo '<li><a href="#">登出</a></li>';
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
  if(empty($_GET['id'])){
    die("未知文章");
  } else {
    $id = $_GET['id'];
  }
  $sql = "SELECT * FROM `tingkao_blog_contents` WHERE `id` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $id);
  $stmt->execute();
  if($conn->error || $stmt->error){
    die("錯誤訊息： " . $conn->error . $stmt->error );
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>
    <article class="article">
      <div class="article__wrap whole_page">
        <h3 class="article__title"><?php echo $row['title'];?></h3>
<?php
  if($isLogin){
    echo '<a href="edit.php?id='.$row['id'].'" class="article__edit-btn">編輯</a>';
  }
?>
        <div class="article__info">
          <div class="timestamp"><?php echo htmlspecialchars($row['created_at'], ENT_QUOTES);?></div>
          <div class="tag">歷史公告</div>
        </div>
        <p class="article__content whole_page"><?php echo htmlspecialchars($row['content'], ENT_QUOTES);?></p>
        <!-- <a href="#" class="article__more-btn">Read More</a> -->
      </div>
    </article>
    <a href="#" class="former_article-btn"><<</a>
    <a href="#" class="next_article-btn">>></a>
</section>


  <footer>
    <p>Copyright © 2020 Who's Blog All Rights Reserved.</p>
  </footer>
</body>
</html>