<?php
    $host = 'localhost';
    $user = 'root';
    $pw = 'daeunroot1';
    $dbName = 'pos';
    $mysql = mysqli_connect($host, $user, $pw, $dbName);
    if(mysqli_connect_errno()){
      echo "DB 연결 실패 ". mysqli_connect_error();
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>POS 초기화면</title>
    <link href="../css/initial.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <h1>편의점 POS 시스템</h1>
      <button type="button" name="button" onclick="location.href='management.php' ">관리</button>
      <button type="button" name="button"  onclick="location.href='pay.php' ">결제</button>
    </div>
  </body>
</html>
