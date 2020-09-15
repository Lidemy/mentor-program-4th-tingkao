<?php
  require_once('conn.php');
  session_start();
  $username = $_SESSION['username'];
  $sql = "SELECT `nickname` FROM `tingkao_members` WHERE `username` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Setting</title>
  <style>
    body {
      background: rgba(0,0,0,0.1);
      padding: 80px;
    }
    .setting {
      position: relative;
      width: 520px;
      margin: 30px auto;
      background-color: #fff;
      border: solid 2px rgba(0,0,0,0.3);
      box-shadow: 0,0,20px,rgba(0,0,0,0.7);
      border-radius: 10px;
      padding: 20px 30px;
      text-align: center;
      z-index: 3;
    }
    .setting h2, 
    .comment__login h2 {
      margin: 0;
      padding: 0;
      display: block;
      margin-bottom: 30px;
    }

    .setting-form label {
      display: block;
      font-size: 20px;
      margin-bottom: 30px;
      margin-left: 80px;
      text-align: left;
    }
    .setting-form input {
      padding: 8px;
      border: solid 1px #bddfff;
      border-radius: 5px;
    }

    .setting-form .handle-setting-btn {
      display: block;
      padding: 8px 20px;
      border-radius: 5px;
      border: solid 1px #bddfff;
      background-color: #fff;
      text-decoration: none;
      color: #000;
      position: absolute;
      right: 70px;
      bottom: 47px;
    }
    .toBoard-btn-wrap {
      width: 520px;
      margin: auto;
      /* padding: -30px; */
      text-align: right;
    }
    .toBoard-btn {
      display: inline-block;
      text-align: center;
      padding: 8px 20px;
      margin-right: -30px;
      border-radius: 5px;
      border: solid 1px rgba(0,0,0,0.7);
      background-color: #fff;
      text-decoration: none;
      color: #000;
      font-size: 14px;
    }
    .setting-form .handle-setting-btn:hover,
    .toBoard-btn:hover {
      background-color: #bddfff;
      color: white;
      cursor: pointer;
    }
    .toBoard-btn:hover {
      background-color: rgba(0,0,0,0.7);
    }

  </style>
</head>
<body>
  <section class="setting">
    <h2>編輯暱稱</h2>
    <form method="POST" action="handle_setting.php" class="setting-form">
      <label for="nickname">暱稱：
        <input type="text" name="nickname" value="<?php echo $row['nickname']?>">
      </label>
      <label for="password">密碼：
        <input type="password" name="password">
      </label>
      <input class="handle-setting-btn" type="submit" value="儲存變更">
    </form>
  </section>

  <section class="setting">
    <h2>更改密碼</h2>
    <form method="POST" action="handle_setting.php" class="setting-form">
      <label for="old_password">舊密碼：
        <input type="password" name="old_password">
      </label>
      <label for="new_password">新密碼：
        <input type="password" name="new_password">
      </label>
      <input class="handle-setting-btn" type="submit" value="儲存變更">
    </form>
  </section>
  <div class="toBoard-btn-wrap">
    <a class="toBoard-btn" href="home.php">回到留言板</a>
  </div>
</body>
<script>
  document.querySelectorAll('.handle-setting-btn').forEach(function(el){
    el.addEventListener('click', function(e){
      // e.preventDefault();
      let isBlank = false
      el.parentNode.querySelectorAll("input").forEach(function(element){
        if(!element.value){
          isBlank = true;
        }
      })
      if(isBlank){
        e.preventDefault();
        alert("請填妥資料");
      }
    })
  })
</script>

<?php
  if (!empty($_GET['state']) && ($_GET['state'] === "1")) {
?>
    <script>alert('更改成功');</script>
<?php
  }
?>
<?php
  if (!empty($_GET['state']) && ($_GET['state'] === "err")) {
?>
    <script>alert('密碼錯誤');</script>
<?php
  }
?>
</html>