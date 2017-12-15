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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>재고 추가</title>
    <link href="../css/orderdetail.css?version=2" rel="stylesheet">
    <script type="text/javascript">
        function addstock() {
            var select = document.stockform.goods;
            var selectoption = select.options[select.selectedIndex];
            document.stockform.oldstock.value = selectoption.attributes[0].value;
            document.stockform.submit();
            <?php
            $goodname = "";
            $goodstock = "";
            $oldstock = "";
            if (array_key_exists('goods', $_POST)) {
                $goodname = $_POST['goods'];
                $goodstock = $_POST['goodstock'];
                $oldstock = $_POST['oldstock'];

                $newstock = (int)$oldstock + (int)$goodstock;
                $sql = "UPDATE goods SET stock = " . $newstock . " where gid =" . $goodname;

                //$sql = "INSERT INTO goods (gid, name, stock, price, category) VALUES (NULL, '$goodname', '$goodstock','$goodprice', '$goodcategory')";
                mysqli_query($mysql, $sql);
            }
            ?>
            //alert("재고 추가 완료!");
            opener.location.reload(true); // 새로고침이 안됨...
            //self.close();

        }
    </script>
</head>
<body>
<input type="hidden" id="orderid">
<div class="container">
    <div class="title">
        <h2>재고 추가</h2>
    </div>
    <form name="stockform" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <table>
            <tr>
                <th>상품 선택</th>
                <td><select name="goods">
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                  <option gstock='$row[stock]' value='$row[gid]'>$row[name]</option>
                  ";
                        }
                        ?>
                    </select></td>
                <input type="hidden" name="oldstock">
            </tr>
            <tr style="background-color: #e6ffe6;">
                <th>상품 재고</th>
                <td><input type="number" name="goodstock" min="1"></td>
            </tr>
        </table>
        <div class="submitbutton">
            <button type="button" name="addbutton" onclick="javascript:addstock()">등록하기</button>
        </div>
    </form>
</div>
</body>
</html>
