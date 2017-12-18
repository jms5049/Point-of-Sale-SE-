<?php
$host = 'localhost';
$user = 'root';
$pw = 'daeunroot1';
$dbName = 'pos';
$mysql = mysqli_connect($host, $user, $pw, $dbName);
mysqli_query($mysql, "set session character_set_connection=utf8;");
mysqli_query($mysql, "set session character_set_results=utf8;");
mysqli_query($mysql, "set session character_set_client=utf8;");
if(mysqli_connect_errno()){
    echo "DB 연결 실패 ". mysqli_connect_error();
}
$sql = "select * from goods";
$result = mysqli_query($mysql, $sql);
?>
<!DOCTYPE html>
<html>
<head> <base target="_self"/>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/pay.css?version=2">
    <script src="../js/pay.js?version=2" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="title">
    <h2>주문하기</h2>
</div>
<div class="btn_both">
    <div class="fl">
        <button type="button" id="goBackButton" onClick="location.href ='initial.php'">뒤로 가기</button>
    </div>
    <form name="addgoods" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <select name="goods">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "
                <option goods-stock='$row[stock]' goods-category= '$row[category]' goods-id= '$row[gid]' value='$row[price]'>$row[name]</option>
                ";
            }
            ?>
        </select>
        <input type="number" name="quantity" min="1" value="1">
        <div class="fl">
            <button type="button" id="submitbutton" onClick="addgood()">상품추가</button>
        </div>
    </form>
    <div class="fr">
        <button type="button" id="cancleOrderButton" onClick="window.location.reload()">주문 취소</button>
    </div>
    <div class="fr">
        <button type="button" id="adduserButton" onClick="openuser()">회원 추가</button>
    </div>
    <div class="fr">
        <button type="button" id="adduserButton" onClick="openPopUp()">회원 로그인</button>
    </div>
</div>
<form name="goodslist" action="cashSettlement.php" method="post">
    <input type="hidden" name="goodsquantity">
    <input class="hiddenPrice" type="hidden" name="goodstotalprice" onchange="calculate()" value="0">
    <input class="hiddenPrice" type="hidden" name="pointUse" onchange="calculate()" value="0">
    <input class="hiddenPrice" type="hidden" name="finalPrice" value="0">
    <input type="hidden" name="currentUser">

    <!-- pointUse는 사용자가 사용한 포인트 수를 저장하고
    finalPrice는 최종 금액을 저장하고
    goodstotalprice는 총 금액을 저장한다 -->
    <table id="otable">
        <tbody id="orderTable">
        <tr>
            <td style="width: 5%;"><input type="checkbox" onclick="selectAll(event.target)"></td>
            <th>상품명</th>
            <th>수량</th>
            <th>가격</th>
        </tr>
        <tr class = "row">
            <td style="width: 5%;"><input type="checkbox" name="item" value="1"></td>
            <td></td>
            <td></td>
            <td></td>
            <input type="hidden" name="item_id_0">
            <input type="hidden" name="item_quantity_0">
        </tr>
        <tr class = "row">
            <td style="width: 5%;"><input type="checkbox" name="item" value="2"></td>
            <td></td>
            <td></td>
            <td></td>
            <input type="hidden" name="item_id_1">
            <input type="hidden" name="item_quantity_1">
        </tr>
        <tr class = "row">
            <td style="width: 5%;"><input type="checkbox" name="item" value="3"></td>
            <td></td>
            <td></td>
            <td></td>
            <input type="hidden" name="item_id_2">
            <input type="hidden" name="item_quantity_2">
        </tr>
        <tr class = "row">
            <td style="width: 5%;"><input type="checkbox" name="item" value="4"></td>
            <td></td>
            <td></td>
            <td></td>
            <input type="hidden" name="item_id_3">
            <input type="hidden" name="item_quantity_3">
        </tr>
        <tr>
            <th colspan="2">총 금액</th>
            <th class="price" colspan="2"></th>
        </tr>
        <tr>
            <th colspan="2">할인 금액
                <button type="button" id="pointUseButton" onclick="openPopUp()">포인트 사용</button></th>
            <th colspan="2" class="price" id="discount"></th>
        </tr>
        <tr>
            <th colspan="2">최종 금액</th>
            <th colspan="2" class = "price" onload="calculate()"></th>
        </tr>
        </tbody>
    </table>
</form>

<div class="btn_both">
    <div class="fl">
        <button type="button" id="deleteGoodButton" onclick="deleteGood()">물품 삭제</button>
    </div>
    <div class="fr">
        <button type="button" id="cashpay" onclick="submitorder(1)">현금 결제</button>
    </div>
    <div class="fr">
        <button type="button" id="cardpay" onclick="submitorder(2)">카드 결제</button>
    </div>
</div>

</body>
</html>
