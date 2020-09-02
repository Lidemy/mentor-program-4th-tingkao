<?php
  //16 碼 token
  function createToken($num) {
    $token = '';
    for ($i = 0; $i < $num; $i += 1) {
      $token = $token . chr(rand(65,90));
    }
    return $token;
  }
?>