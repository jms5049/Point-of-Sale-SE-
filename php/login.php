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
$parameter = $_POST['searchID'];
$sql = "select * from user where id =".$parameter;
$result = mysqli_query($mysql, $sql);

$name = '';
$point = '';
$id = '';

$result = mysqli_fetch_array($result);
if($result == NULL){

    $prevPage = $_SERVER['HTTP_REFERER'];
    header('location:'.$prevPage);
}
$name = $result['name'];
$point = $result['point'];
$id = $result['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/pay.css?version=2">
    <script src="../js/point.js?version=1" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body  onload="refresh()">
<div class="">
    <table>
        <tr>
            <th>고객 이름</th>
            <td class="pointTable"></td>
        </tr>
        <tr>
            <th>보유 포인트</th>
            <td class="pointTable"></td>
        </tr>
    </table>
</div>
<div>
    <button type="button" id="canclePointUseButton" onclick="closePopUp(event)">취소</button>
    <button type="button" id="confirmPointUseButton" onclick="confirm()">확인</button>
</div>

</body>
<script type="text/javascript">
    function refresh(){

        var pointTable = document.getElementsByClassName('pointTable');
        pointTable[0].innerHTML = '<?=$name?>';
        pointTable[1].innerHTML = '<?=$point?>';
    }

    function confirm(){
        //사용한 포인트에 대한 정보를 데이터베이스에 업데이트 하는 것은
        //추후에 결제 페이지로 이동할 때 실행된다.
        window.opener.parent.document.getElementsByName("currentUser")[0].value = '<?=$id?>';
        closePopUp(this);
    }
</script>
</html>
