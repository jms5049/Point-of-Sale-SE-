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

//  변수 선언
$item_id_index = "0";     //  item index
$total_goods_count ="";   //  item 총 개수
$total_price=0;          //  상품 총 금액

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

//$c =10;

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
        //echo "hello + $item_array[$i] ^ $quantity_array[$i]";
        //$item_id_.$index  = $_POST['item_id_'.$index];
        //$item_quantity_.$index  = $_POST['item_quantity_'.$index];
        //   $usertel = $_POST['item_id_'+$total_goods_count];

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
    function cardPurchaseComplete(){
        var cardNum = document.getElementById("card").value;
        if(cardNum == null || cardNum.length <16){
            alert("카드 번호가 올바르지 않습니다.");
        }
        else{
            alert("결제가 완료되었습니다.");
            <?php
            //$sum = 10000;
            //  order에 삽입

            $index = $total_goods_count;

            for($i=0; $i< $index; $i++){
                //$x =(string)$c;
                // orderdetail 테이블에 값 추가
                $sql = "INSERT INTO orderdetail (oid, gid, quantity) VALUES (NULL, $item_array[$i],  $quantity_array[$i])";
                mysqli_query($mysql, $sql);
            }

            //  결제 리스트에 데이터 추가
            $sql2 = "INSERT INTO orderlist (oid, date, totalprice, payment) VALUES (NULL, CURRENT_DATE, $total_price ,2)";
            mysqli_query($mysql, $sql2);
            ?>


            document.getElementById("card").value = "";
            document.getElementById("card").placeholder = "0000-0000-0000-0000";
            document.getElementById("totalPrice2").innerHTML ="0원";

        }
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
            echo " <td id='totalPrice2'>$total_price 원</td> ";?>
        </tr>
    </table>
    <div class="buttonAlign">
        <button onclick="cardPurchaseFailure()">취소</button>
        <button onclick="cardPurchaseComplete()">완료</button>
    </div>
</div>
</body>
</html>
