<?php
  require_once('conn.php');
  if (empty($_GET['id'])) {
    die('error');
  }
  $id = $_GET['id'];
  $conn->query("DELETE FROM `tingkao_comments` WHERE `id` = $id");
  if($conn->error){
    echo $conn->error;
  } else {
    header("Location: home.php");
  }
?>