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
<?php
//  변수 선언
$item_id_index = "0";     //  item index
$total_goods_count ="";   //  item 총 개수
$total_price=0;          //  상품 총 금액
$userId = "";           //  사용자 id
$userPoint =0;          //  사용자 포인트

$pointUse = 0;          //  포인트 금액
$finalPrice = 0;        //  최종 금액
$finalPoint =0;
$point =0;
$zero =0;

// 물품 수량 받아오기
if(array_key_exists('goodsquantity', $_POST )){
    $total_goods_count  = $_POST['goodsquantity'];
    //echo "totalgoodscount: $total_goods_count";
}
//  상품 총 금액 받아오기
if(array_key_exists('goodstotalprice', $_POST) ){
    $total_price = $_POST['goodstotalprice'];
    //echo "totalprice: $total_price";
}
// 유저 아이디 받아오기
if(array_key_exists('currentUser', $_POST) ){
    $userId = $_POST['currentUser'];
    //echo "userId: $userId zero: $zero";
}
//  유저 포인트 받아오기
if(array_key_exists('userPoint', $_POST) ){
    $userPoint = $_POST['userPoint'];
    //echo "userPoint: $total_price";
}
//  포인트 금액
if(array_key_exists('pointUse', $_POST) ){
    $pointUse = $_POST['pointUse'];
    //echo "pointUse: $pointUse";
}
//  최종 금액
if(array_key_exists('finalPrice', $_POST) ){
    $finalPrice = $_POST['finalPrice'];
    //echo "finalPrice: $finalPrice";
}

$item_array = array(); //  item index 배열
$quantity_array = array();

$temp=0;
$item = "item_id_";
$quantity = 'item_quantity_';
for($i=0; $i< $total_goods_count; $i++){
    $c = (string)$i;
    //$sql = "INSERT INTO orderdetail (oid, gid, quantity) VALUES (NULL, 2, 3)";
    //mysqli_query($mysql, $sql);
    //  상품 아이디, 수량 가져오기
    if(array_key_exists( $item.$c , $_POST ) && array_key_exists( $quantity.$c , $_POST )){
        //echo "$_POST[$item.$c]";
        array_push($item_array, $_POST[$item.$c]);
        array_push($quantity_array, $_POST[$quantity.$c]);

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="../css/cashSettlement.css?version=3">
    <script src="../js/settlement.js"></script>
</head>
<script>
//    function cardPurchaseComplete(){
//        var cardNum = document.getElementById("card").value;
//        if(cardNum == null || cardNum.length <16){
//            alert("카드 번호가 올바르지 않습니다.");
//        }
//        else{
//            alert("결제가 완료되었습니다.");
//            <?php
//            $index = $total_goods_count;
//
//            //  결제 리스트에 데이터 추가
//            $sql2 = "INSERT INTO orderlist (oid, date, totalprice, payment) VALUES (NULL, CURRENT_DATE, $finalPrice ,2)";
//            mysqli_query($mysql, $sql2);
//
//            //  oid 가져오기
//            $sql3 = "SELECT * FROM orderlist ORDER BY oid DESC";
//            $result2 = mysqli_query($mysql, $sql3);
//            $result2 = mysqli_fetch_array($result2);
//            $OID = $result2['oid'];
//
//            for($i=0; $i< $index; $i++){
//                //$x =(string)$c;
//                // orderdetail 테이블에 값 추가
//                //$sql = "INSERT INTO orderdetail (oid, gid, quantity) VALUES (NULL, $item_array[$i],  $quantity_array[$i])";
//                //  orderdetail에 값 추가
//                /* 잠시만 주석
//                $sql = "INSERT INTO orderdetail (oid, gid, quantity) VALUES (".$OID.", $item_array[$i],  $quantity_array[$i])";
//                mysqli_query($mysql, $sql);
//                //  goods에서 재고 줄이기
//                $sql = "UPDATE goods SET stock = stock- $quantity_array[$i] WHERE gid =  $item_array[$i]";
//                mysqli_query($mysql, $sql);*/
//            }
//            //  포인트 결제를 하는 경우
//            if(array_key_exists('currentUser', $_POST) && $pointUse != $zero){
//                $sql2 = "UPDATE user SET point = point - ".$pointUse." WHERE id =".$userId;
//                mysqli_query($mysql, $sql2);
//
//                //  잔고 변경
//                $sql = "SELECT * FROM balance";
//                mysqli_query($mysql, $sql);
//                $result = mysqli_query($mysql, $sql);
//                $result = mysqli_fetch_array($result);
//                $currentTotalBalance = $result['total'];
//                $sql = "UPDATE balance SET total = total + ".$finalPrice." WHERE total =".$currentTotalBalance;
//                mysqli_query($mysql, $sql);
//
//                //  포인트 사용 디비에 추가하기 oid, uid, usepoint
//                $sql ="INSERT INTO point (oid, uid, usepoint) VALUES (".$OID.", ".$userId.", ".$pointUse.")";
//                mysqli_query($mysql, $sql);
//
//            }else if(array_key_exists('currentUser', $_POST) && $pointUse == $zero){  //  포인트를 적립해야하는 경우
//                $resultP = ($finalPrice) / 10;
//                $sql = "UPDATE user SET point = point + ".$resultP." WHERE id =".$userId;
//                mysqli_query($mysql, $sql);
//
//                //  잔고 변경
//                $sql = "SELECT * FROM balance";
//                mysqli_query($mysql, $sql);
//                $result = mysqli_query($mysql, $sql);
//                $result = mysqli_fetch_array($result);
//                $currentTotalBalance = $result['total'];
//                $sql = "UPDATE balance SET total = total + ".$finalPrice." WHERE total =".$currentTotalBalance;
//                mysqli_query($mysql, $sql);
//            }
//
//            ?>
//
//            document.getElementById("card").value = "";
//            document.getElementById("card").placeholder = "0000-0000-0000-0000";
//            document.getElementById("totalPrice2").innerHTML ="0원";
//
//        }
//
//        location.href ="/pos/php/initial.php";
//    }


    function onSubmitForm()
    {
        if(document.pressed == 'purchase')
        {
            document.purchaseForm.action ="cardSuccess.php";
        }
        else if(document.pressed == 'cancel')
        {
            alert("결제를 취소했습니다. ");
            document.purchaseForm.action ="pay.php";
        }
        return true;
    }
</script>

<body>
<div  id="box">
    <h2>카드 결제</h2>

    <table>
        <tr>
            <td>카드번호</td>
            <td><input id="card" type="text" name="cardNum" placeholder="0000-0000-0000-0000" onkeyup="javascript:autoHypen()"></td>
        </tr>
        <tr>
            <td>최종금액</td>
            <?php
            echo " <td id='totalPrice2'>$finalPrice 원</td> ";?>
        </tr>
    </table>
    <div class="buttonAlign">
        <form method="post" name="purchaseForm" onsubmit="return onSubmitForm()" >
            <?php echo "<input type='hidden' name='goodsquantity' value='$total_goods_count'>"; ?>
            <?php echo "<input class=\"hiddenPrice\" type=\"hidden\" name=\"goodstotalprice\" value='$total_price'>"; ?>
            <?php echo "<input class=\"hiddenPrice\" type=\"hidden\" name='pointUse' value='$pointUse'>"; ?>
            <?php echo "<input class=\"hiddenPrice\" type=\"hidden\" name=\"finalPrice\" value='$finalPrice'>"; ?>
            <?php echo "<input type=\"hidden\" name=\"currentUser\" value='$userId'>"; ?>
            <?php
            for($i =0; $i<$total_goods_count; $i++){
                echo "<input type=\"hidden\" name='item_id_$i' value=$item_array[$i]>";
                echo "<input type=\"hidden\" name='item_quantity_$i' value=$quantity_array[$i]>";

            }

            ?>
            <button type="submit" onclick="document.pressed=this.value" value="purchase">결제</button>
            <button type="submit" onclick="document.pressed=this.value" value="cancel">취소</button>
        </form>
    </div>
</div>
</body>
</html>
