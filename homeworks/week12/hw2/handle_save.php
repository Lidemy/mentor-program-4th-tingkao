
<?php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  function createId(){
    global $conn;
    $createId_sql = "INSERT INTO `tingkao_todo_lists` (`id`, `created_at`) VALUES (NULL, CURRENT_TIMESTAMP)";
    $createId_stmt = $conn->prepare($createId_sql);
    $createId_stmt->execute();
    if($conn->error || $createId_stmt->error){
      die("錯誤訊息： " . $conn->error . $createId_stmt->error);
    }
    // 取得新增的 id
    $last_id = $conn->insert_id;
    return $last_id;
  }
  // print_r(createId().':this is last id');
  if(!empty($_POST['todoList'])){
    $todoArr = $_POST['todoList'];
    $listId = createId();
    for($i = 0; $i < count($todoArr); $i += 1 ){
      $content = $todoArr[$i][0];
      $status = $todoArr[$i][1];
      $sql = "INSERT INTO `tingkao_todo_contents` (`content`, `list_id`, `status`) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('sss', $content, $listId, $status);
      $stmt->execute();
    }
    if($conn->error || $stmt->error){
      die("錯誤訊息： " . $conn->error . $stmt->error);
    }
    $result = $stmt->get_result();
    if($stmt->affected_rows){
      $json = array(
        "status" => 200,
        "listId" => $listId,
      );
    }else{
      $json = array(
        "status" => 400,
      );
    }
    $response = json_encode($json);
    echo $response;
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
?>

