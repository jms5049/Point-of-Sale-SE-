<?php
    $host = 'localhost';
    $user = 'root';
    $pw = 'daeunroot1';
    $dbName = 'pos';
    $mysql = mysqli_connect($host, $user, $pw, $dbName);
    if(mysqli_connect_errno()){
      echo "DB 연결 실패 ". mysqli_connect_error();
    }
    mysqli_query($mysql, "set session character_set_connection=utf8;");
    mysqli_query($mysql, "set session character_set_results=utf8;");
    mysqli_query($mysql, "set session character_set_client=utf8;");
    $sql = "select * from orderdetail where oid = ".$_GET['orderid'];
    $result = mysqli_query($mysql, $sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>주문상세</title>
    <link href="../css/orderdetail.css" rel="stylesheet">
  </head>
  <body>
    <input type="hidden" id="orderid">
    <div class="container">
      <div class="title">
        <h2>주문 상세조회</h2>
      </div>
      <table>
        <tbody>
        <tr>
          <th>상품</th>
          <th>수량</th>
          <th>개당 가격</th>
          <th>총 가격</th>
        </tr>
        <?php
          while($row = mysqli_fetch_array($result))
          {
            $sql = "select * from goods where gid =". $row['gid'];
            $goods = mysqli_query($mysql, $sql);
            $goodsdetail = mysqli_fetch_array($goods);
            $total = $goodsdetail['price'] * $row['quantity'];
            echo "
            <tr>
              <td>$goodsdetail[name]</td>
              <td>$row[quantity]</td>
              <td>$goodsdetail[price]</td>
              <td>$total</td>
            ";
          }
        ?>
        <tbody>
      </table>
    </div>
  </body>
</html>
