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
    <title>회원 추가</title>
    <link href="../css/orderdetail.css?version=2" rel="stylesheet">
    <script type="text/javascript">
        function adduser() {
            var name = document.userform.username.value;
            var tel = document.userform.usertel.value;
            if (name == "")
                alert("이름을 입력해주세요.");
            else if (tel == "")
                alert("전화번호를 입력해주세요.");
            else {
                document.userform.submit();
                <?php
                $username = "";
                $usertel = "";
                if (array_key_exists('username', $_POST) && array_key_exists('usertel', $_POST)) {
                    $username = $_POST['username'];
                    $usertel = $_POST['usertel'];
                    $sql = "INSERT INTO user (id, name, tel, point) VALUES (NULL, '$username', '$usertel', 0)";
                    mysqli_query($mysql, $sql);
                }
                ?>
                alert("회원 등록완료!");
                //self.close();
            }
        }
    </script>
</head>
<body>
<input type="hidden" id="orderid">
<div class="container">
    <div class="title">
        <h2>회원추가</h2>
    </div>
    <form name="userform" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <table>
            <tr>
                <th>이름</th>
                <td><input type="text" name="username"></td>
            </tr>
            <tr style="background-color: #e6ffe6;">
                <th>전화번호</th>
                <td><input type="text" name="usertel"></td>
            </tr>
        </table>
        <div class="submitbutton">
            <button type="button" name="addbutton" onclick="javascript:adduser()">등록하기</button>
        </div>
    </form>
</div>
</body>
</html>
