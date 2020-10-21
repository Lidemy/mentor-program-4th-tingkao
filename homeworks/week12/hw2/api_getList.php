<?php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');

  if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM `tingkao_todo_contents` WHERE list_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    if($conn->error || $stmt->error){
      die("錯誤訊息： " . $conn->error . $stmt->error);
    }
    $result = $stmt->get_result();
    $listArr = array();
    while($row = $result->fetch_assoc()){
      array_push($listArr, array(
        $row['content'],
        $row['status'],
      ));
    }
    if($stmt->affected_rows){
      $json = array(
        "status" => 200,
        "listArr" => $listArr,
      );
    }else{
      $json = array(
        "status" => 400,
      );
    }
    $response = json_encode($json);
    echo $response;
  }
?>
