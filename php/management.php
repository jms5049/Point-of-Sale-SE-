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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../css/management.css?version=2">
    <script src="../js/management.js"></script>
</head>
<body>
    <div class="container">
        <div class="title">
          <h2>관리 페이지</h2>
        </div>
        <div id="backBtn"><button class="btn-1" onClick="history.back()">뒤로 가기 </button></div>
        <div class="content">
            <table>
                <tr>
                    <td>
                        <button class="order" onclick="location.href='order.php'">주문 목록</button>
                    </td>
                    <td>
                        <button class="order" onclick="location.href='externalorder.php'">외부 주문</button>
                    </td>
                </tr>
                <tr>
                   <?php
                   $sql = "select * from balance";
                   $balances = mysqli_query($mysql, $sql);
                             while($balancedata = mysqli_fetch_array($balances))
                             {
                               echo "
                               <td><b>현금 잔고:<p id='cash' onchange='showCashBalance()'>$balancedata[cash]</p></b></td>
                               <td><b>매출:<p id='sales' onchange='showSalesBalance()'>$balancedata[total]</p></b></td>
                               ";
                              }?>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
