<?php
  session_start();
  require_once('conn.php');
  require_once('utility.php');
  if(!empty($_GET['id'])){
    $id = $_GET['id'];
  }else {
    header("Location: index.php");
  }
  $sql = "SELECT * FROM `tingkao_blog_contents` WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $id);
  $stmt->execute();
  if($conn->error || $stmt->error) {
    die("錯誤訊息： " . $conn->error . $stmt->error);
  }
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  if(empty($_SESSION['username']) || !checkMember($_SESSION['username'])){
    header("Location: index.php");
    exit();
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
<?php
  if(!empty($_GET['backend'])){
    $backend = 1;
  }else {
    $backend = 0;
  }
?>
  <section class="section__form">
    <form method="POST" action="handle_edit.php" class="form">
      <div class="form__wrap">
        <label class="title" for="title"><span>標題： </span>
          <input type="text" name="title" value="<?php echo $row['title'];?>">
        </label>
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <input type="hidden" name="backend" value="<?echo $backend?>">
        <label for="content">
          <textarea name="content" cols="70" rows="20"><?php echo $row['content'];?></textarea>
        </label>
        <input type="submit" class="submit-btn" value="儲存變更">
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