
<?php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  function sum() {
    global $conn;
    $sql_sum = "SELECT COUNT(*) as sum FROM `tingkao_comments` WHERE `is_deleted` = 0 AND `is_hidded` = 0 ORDER BY `created_at` DESC";
    $stmt_sum = $conn->prepare($sql_sum);
    $stmt_sum->execute();
    if($conn->error || $stmt_sum->error){
      die("錯誤訊息： " . $conn->error . $stmt_sum->error);
    }
    $result = $stmt_sum->get_result();
    return  $result->fetch_assoc()['sum'];
  };

  $sum = sum();
  $state = 1;
  $all_state = ceil($sum / 5);
  $has_state = true;
  
  if(!empty($_GET['state'])){
    $state = intval($_GET['state']);
    if($state > 0 && $state <= $all_state){
      $offset = ($state - 1) * 5;
      $sql = "SELECT * FROM `tingkao_comments` WHERE `is_deleted` = 0 AND `is_hidded` = 0 ORDER BY `created_at` DESC LIMIT 5 OFFSET ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $offset);
    } 
    if($state == $all_state){
      $has_state = false;
    }
  }else {
    $sql = "SELECT * FROM `tingkao_comments` WHERE `is_deleted` = 0 AND `is_hidded` = 0 ORDER BY `created_at` DESC LIMIT 5 ";
    $stmt = $conn->prepare($sql);
  }
  $stmt->execute();
  if($conn->error || $stmt->error){
    die("錯誤訊息： " . $conn->error . $stmt->error);
  }
  $result = $stmt->get_result();
  $comments = array();
  while($row = $result->fetch_assoc()) {
    array_push($comments, array(
      "username" => $row['username'],
      "content" => $row['content'],
      "created_at" => $row['created_at'],
    ));
  }
  $json = array(
    "comments" => $comments,
    "state" => $has_state,
  );

  $response = json_encode($json);
  echo $response;
?>

