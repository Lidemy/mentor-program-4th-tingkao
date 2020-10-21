
<?php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  
  if(!empty($_POST['InputNickname']) && !empty($_POST['InputContent']) ){
    $nickname = $_POST['InputNickname'];
    $content = $_POST['InputContent'];
    $sql = "INSERT INTO `tingkao_comments` (`username`, `content`) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nickname, $content);
    $stmt->execute();
    if($conn->error || $stmt->error){
      die("錯誤訊息： " . $conn->error . $stmt->error);
    }
    $result = $stmt->get_result();
    if($stmt->affected_rows === 1){
      $json = array(
        "status" => 200,
      );
    }else{
      $json = array(
        "status" => 400,
      );
    }
  }
  // $comments = array();
  // array_push($comments, array(
  //   "id" => "1",
  //   "username" => "小明",
  //   "nickname" => "還是小明",
  // ));
  // array_push($comments, array(
  //   "id" => "2",
  //   "username" => "小滑",
  //   "nickname" => "滑一下",
  // ));

  $response = json_encode($json);
  echo $response;
?>

