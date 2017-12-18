<?php
$host = 'localhost';
$user = 'root';
$pw = 'daeunroot1';
$dbName = 'pos';
$mysql = mysqli_connect($host, $user, $pw, $dbName);
if (mysqli_connect_errno()) {
    echo "DB 연결 실패 " . mysqli_connect_error();
}
mysqli_query($mysql, "set session character_set_connection=utf8;");
mysqli_query($mysql, "set session character_set_results=utf8;");
mysqli_query($mysql, "set session character_set_client=utf8;");

$sql = "select * from goods";
$result = mysqli_query($mysql, $sql);
$exorder = array('N', 'Y');

$orderid = "";
$orderquantity = "";
if (array_key_exists('exordercheck', $_POST)) {
    $ordertype = $_POST['ordertype'];

    if($ordertype == 1){
        $orderid = $_POST['exordercheck'];
        $orderquantity = $_POST['exorderquantity'];
        for ($i = 0; $i < count($orderid); $i++) {
            $sql_s = "SELECT * from externalorder WHERE gid = $orderid[$i] AND quantity = $orderquantity[$i]";
            $result_s = mysqli_query($mysql, $sql_s);
            $arr = mysqli_fetch_array($result_s);

            if ($arr[0] == "") {
                $sql2 = "INSERT INTO externalorder (gid, quantity) VALUES ($orderid[$i], $orderquantity[$i])";
                mysqli_query($mysql, $sql2);
                $sql_u = "UPDATE goods set externalorder = '1' where gid = " . $orderid[$i];
                mysqli_query($mysql, $sql_u);
            }
        }
    } else if($ordertype == 0){
        $orderid = $_POST['exordercheck'];

        for ($i = 0; $i < count($orderid); $i++) {
            $sql_d = "DELETE from externalorder where gid = " . $orderid[$i];
            mysqli_query($mysql, $sql_d);

            $sql_u = "UPDATE goods set externalorder = '0' where gid = " . $orderid[$i];
            mysqli_query($mysql, $sql_u);
        }
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>외부 주문</title>
    <link href="../css/order.css?version=3" rel="stylesheet">
    <script type="text/javascript" src="../js/order.js?version=8"></script>
    <script>
        function goodsorder() {
            document.externalorderform.ordertype.value = 1;
            document.externalorderform.submit();
            // console.log(document.externalorderform.ordertype.value);
        }
        function cancleorder() {
            document.externalorderform.ordertype.value = 0;
            document.externalorderform.submit();
            // console.log(document.externalorderform.ordertype.value);
        }
        function loadexpage() {
            location.href = "externalorder.php";
        }
    </script>
</head>
<body onload="setTimeout(loadexpage,1000)">
<div class="container">
    <div class="title">
        <h2>재고 조회 및 외부 주문</h2>
    </div>
    <div class="btn_both">
        <div class="fl">
            <button type="button" id="back" onClick="location.href = 'management.php'">뒤로 가기</button>
        </div>
        <div class="fr">
            <button type="button" id="adduserButton" onClick="opengoods()">상품 추가</button>
        </div>
        <div class="fr">
            <button type="button" id="adduserButton" onClick="openstock()">재고 추가</button>
        </div>
    </div>
    <form name="externalorderform" action="afterexternalorder.php" method="post">
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
            while ($row = mysqli_fetch_array($result)) {
                $ex = $row['externalorder'];
                echo "
            <tr>
              <td><input class='check' type='checkbox' id='$row[gid]_c' name='exordercheck[]' value='$row[gid]' onclick='javascript:setNum($row[gid])'></td>
              <td>$row[gid]</td>
              <td>$row[name]</td>
              <td>$row[price]</td>
              <td>$row[stock]</td>
              <td><input class='quantity' type='number' id='$row[gid]_q' name='exorderquantity[]' min='1' disabled='true'></td>
              <td>$exorder[$ex]</td>
            </tr>
            ";
            }
            ?>
            <tbody>
        </table>
        <input type="hidden" name="ordertype" value="1">
    </form>
    <div class="btn_both">
        <div class="fr">
            <button type="button" id="order" onclick="goodsorder()">주문 하기</button>
            <button type="button" id="cancle" onclick="cancleorder()">주문 취소</button>
        </div>
    </div>
</div>
</body>
</html>
