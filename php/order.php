<?php
$host = 'localhost';
$user = 'root';
$pw = 'daeunroot1';
$dbName = 'pos';
$mysql = mysqli_connect($host, $user, $pw, $dbName);
if (mysqli_connect_errno()) {
    echo "DB 연결 실패 " . mysqli_connect_error();
}
$sql = "select * from orderlist";
$result = mysqli_query($mysql, $sql);
$payment = array('', '현금', '카드');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>주문 목록</title>
    <link href="../css/order.css" rel="stylesheet">
    <script type="text/javascript" src="../js/order.js?version=5"></script>
    <script>
        //주문 취소
        function cancleorder() {
            document.orderform.submit();
            <?php
            $orderid = "";
            if (array_key_exists('ordercheck', $_POST)) {
                $orderid = $_POST['ordercheck'];
                for($i = 0; $i < count($orderid); $i++){
//                    echo $orderid[$i];
                    $sql2 = "SELECT * from orderlist where oid = ".$orderid[$i];
                    $result2 = mysqli_query($mysql, $sql2);
                    $sql2 = "DELETE from orderlist where oid = ".$orderid[$i];
                    mysqli_query($mysql, $sql2);
                    $row = mysqli_fetch_array($result2);
                    // 현금 결제인 경우
                    if($row['payment'] == 1){
                        $sql_u = "UPDATE balance set cash = cash - ".$row['totalprice']; // 현금 잔고 변경
                        mysqli_query($mysql, $sql_u);
                    }
                    $sql_u = "UPDATE balance set total = total - ".$row['totalprice']; // 총매출액 변경
                    mysqli_query($mysql, $sql_u);

                    $sql3 = "DELETE from orderdetail where oid = ".$orderid[$i];
                    mysqli_query($mysql, $sql3);

                    $sql4 = "SELECT * from point where oid = ".$orderid[$i];
                    $result4 = mysqli_query($mysql, $sql4);
                    $arr = mysqli_fetch_array($result4);
                    $sql4 = "DELETE from point where oid = ".$orderid[$i];
                    mysqli_query($mysql, $sql4);
                    // 해당 주문에서 point를 사용했으면
                    if($arr[0] != ""){
                        $sql5 = "UPDATE user set point = point + ".$arr['usepoint']." where id =".$arr['uid'];
//                        echo $sql5;
                        mysqli_query($mysql, $sql5);
                    }
                }
            }
            ?>
        }
    </script>
</head>
<body>
<div class="container">
    <div class="title">
        <h2>주문 목록</h2>
    </div>
    <div class="btn_both">
        <div class="fl">
            <button type="button" id="back" onClick="location.href ='management.php'">뒤로 가기</button>
        </div>
        <div class="fr">
            <button type="button" id="cancle" onclick="cancleorder()">주문 취소</button>
        </div>
    </div>
    <table id="orderbox">
        <tr>
            <th>선택</th>
            <th>주문번호</th>
            <th>주문일자</th>
            <th>결제금액</th>
            <th>결제수단</th>
            <th>주문상세조회</th>
        </tr>
        <form name="orderform" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $pay = $row['payment'];
                echo "
            <tr class='$row[oid]'>
              <td><input type='checkbox' name='ordercheck[]' value='$row[oid]'></td>
              <td>$row[oid]</td>
              <td>$row[date]</td>
              <td>$row[totalprice]</td>
              <td>$payment[$pay]</td>
              <td><button type='button' id='detail' onclick='opendetail(this)'>조회</button></td>
            </tr>
            ";
            }
            ?>
        </form>
    </table>
</div>
</body>
</html>
