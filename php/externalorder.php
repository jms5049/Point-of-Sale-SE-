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

    $sql = "select * from goods";
    $result = mysqli_query($mysql, $sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>외부 주문</title>
    <link href="../css/order.css?version=3" rel="stylesheet">
    <script type="text/javascript" src="../js/order.js?version=3"></script>
  </head>
  <body>
    <div class="container">
      <div class="title">
        <h2>재고 조회 및 외부 주문</h2>
      </div>
      <div class="btn_both">
      	<div class="fl">
      		<button type="button" id="back" onClick="history.back()">뒤로 가기</button>
      	</div>
        <div class="fr">
      		<button type="button" id="cancle">주문 취소</button>
      	</div>
        <div class="fr">
          <button type="button" id="adduserButton" onClick="opengoods()">상품 추가</button>
        </div>
        <div class="fr">
          <button type="button" id="adduserButton" onClick="openstock()">재고 추가</button>
        </div>
      </div>
      <table id="orderbox">
        <tbody>
        <tr>
          <th>선택</th>
          <th>번호</th>
          <th>상품명</th>
          <th>가격</th>
          <th>현재 수량</th>
          <th>수량 선택</th>
          <th>주문 여부</th>
        </tr>
        <?php
          while($row = mysqli_fetch_array($result))
          {
            echo "
            <tr>
              <td><input type='checkbox' name='$row[gid]' onclick='javascript:setNum($row[gid])'></td>
              <td>$row[gid]</td>
              <td>$row[name]</td>
              <td>$row[price]</td>
              <td>$row[stock]</td>
              <td><input class='quantity' type='number' name='$row[gid]_q' min='1' disabled='true'></td>
              <td>N</td>
            </tr>
            ";
          }
        ?>
        <tbody>
      </table>
      <div class="btn_both">
      	<div class="fr">
      		<button type="button" id="order">주문 하기</button>
          <button type="button" id="cancle">주문 취소</button>
      	</div>
      </div>
    </div>
  </body>
</html>
