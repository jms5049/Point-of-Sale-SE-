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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>상품 추가</title>
    <link href="../css/orderdetail.css?version=2" rel="stylesheet">
    <script type="text/javascript">
        function addgoods() {
            var gname = document.goodsform.goodname.value;
            var gstock = document.goodsform.goodstock.value;
            if (gname == "")
                alert("이름을 입력해주세요.");
            else if (gstock == "")
                alert("재고를 입력해주세요.");
            else {
                document.goodsform.submit();
                <?php
                $goodname = "";
                $goodprice = "";
                $goodstock = "";
                $goodcategory = "";
                if (array_key_exists('goodname', $_POST)) {
                    $goodname = $_POST['goodname'];
                    $goodprice = $_POST['goodprice'];
                    $goodstock = $_POST['goodstock'];
                    $goodcategory = $_POST['goodcategory'];
                    $sql = "INSERT INTO goods (gid, name, stock, price, category) VALUES (NULL, '$goodname', '$goodstock','$goodprice', '$goodcategory')";
                    mysqli_query($mysql, $sql);
                }
                ?>
//          alert("상품 등록완료!");
            opener.location.reload(true); // 새로고침이 안됨...
                //self.close();
            }
        }
    </script>
</head>
<body>
<input type="hidden" id="orderid">
<div class="container">
    <div class="title">
        <h2>상품 추가</h2>
    </div>
    <form name="goodsform" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <table>
            <tr>
                <th>상품 이름</th>
                <td><input type="text" name="goodname"></td>
            </tr>
            <tr style="background-color: #e6ffe6;">
                <th>상품 가격</th>
                <td><input type="text" name="goodprice"></td>
            </tr>
            <tr style="background-color: #e6ffe6;">
                <th>상품 재고</th>
                <td><input type="number" name="goodstock" min="1"></td>
            </tr>
            <tr style="background-color: #e6ffe6;">
                <th>카테고리</th>
                <td><select name="goodcategory">
                        <option value="0">일반 상품</option>
                        <option value="1">신분증 확인 상품</option>
                        <option value="2">약품</option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="submitbutton">
            <button type="button" name="addbutton" onclick="javascript:addgoods()">등록하기</button>
        </div>
    </form>
</div>
</body>
</html>
