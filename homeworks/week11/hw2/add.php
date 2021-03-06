<?php
  session_start();
  require_once('conn.php');
  require_once('utility.php');
  if(empty($_SESSION['username']) || !checkMember($_SESSION['username'])){
    header("Location: index.php");
    exit();
  }
?>
<?php
  if(!empty($_GET['backend'])){
    $backend = 1;
  }else {
    $backend = 0;
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
        <li><a href="manage.php">管理後台</a></li>
        <li><a href="#">登出</a></li>
      </ul>
    </div>
  </nav>
  <header>
    <h2>存放技術之地</h2>
    <div>Welcome to my blog</div>
  </header>

  <section class="section__form">
    <form method="POST" action="handle_add.php" class="form">
      <div class="form__wrap">
          <input type="hidden" name="backend" value="<?php echo $backend?>">
          <label class="title" for="title">
            <span>標題： </span>
            <input type="text" name="title">
          </label>
        <label for="content">
          <textarea name="content" cols="70" rows="20"></textarea>
        </label>
        <input type="submit" class="submit-btn" value="送出文章">
      </div>
    </form>
  </section>
  <footer>
    <p>Copyright © 2020 Who's Blog All Rights Reserved.</p>
  </footer>
</body>
<script>
    document.querySelector('.form').addEventListener('submit', function(e){
    let isValued = true;
    document.querySelectorAll('.form input').forEach(function(el){
      if(!el.value){
        isValued = false;
        e.preventDefault();
      }
    })
    if(!document.querySelector('.form textarea').value){
      isValued = false;
      e.preventDefault();
    }
    if(!isValued){
      alert('內容不可空白');
    }
  })
</script>
</html>