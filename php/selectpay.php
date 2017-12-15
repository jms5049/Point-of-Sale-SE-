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
    <title>결제 수단</title>
    <link href="../css/initial.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <h1>결제수단 선택</h1>
      <button type="button" name="button" onclick="location.href='cashSettlement.php'">현금</button>
      <button type="button" name="button" onclick="location.href='cardSettlement.php'">카드</button>
    </div>
  </body>
</html>
