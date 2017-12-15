<?php
    $host = 'localhost';
    $user = 'root';
    $pw = 'daeunroot1';
    $dbName = 'pos';
    $mysql = mysqli_connect($host, $user, $pw, $dbName);
    if(mysqli_connect_errno()){
      echo "DB 연결 실패 ". mysqli_connect_error();
    }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="../css/pay.css?version=2">
     <script src="../js/point.js?version=1" charset="utf-8"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <div>
      <form method="post" name="searchForm" onsubmit="return onSubmitForm()">
        <div style="height: 30px;">
        </div>
        <!-- 이 div 그냥 빈칸용임 -->
        <input type="text" style="margin-left: 30%;" name="searchID" id="searchID">
        <div style="height: 30px;">
        </div>
        <!-- 이 div 그냥 빈칸용임 -->
        <button type="submit" onclick="document.pressed=this.value" value="point">포인트 사용 검색</button>
        <button type="submit" onclick="document.pressed=this.value" value="login">포인트 적립 검색</button>
        <button type="button" id="canclePointUseButton" onclick="closePopUp(event)">취소</button>
      </form>
    </div>
    <script type="text/javascript">
    function onSubmitForm()
    {
      if(document.pressed == 'point')
      {
        document.searchForm.action ="point.php";
      }
      else if(document.pressed == 'login')
      {
        document.searchForm.action ="login.php";
      }
      return true;
    }
    </script>

  </body>
</html>
