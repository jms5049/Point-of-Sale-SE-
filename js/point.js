var pointTable = document.getElementsByClassName('pointTable');

function closePopUp(target){
    window.close(target);
}

function calculate(){
    var x = parseInt(pointTable[1].innerHTML);
    var y = parseInt(document.getElementById('pointUse').value);
    if(parseInt(x-y)<0){
        alert("포인트 잔액이 부족합니다");
        document.getElementById('pointUse').value = 0;
    }
    else{
        pointTable[3].innerHTML = parseInt(x-y);
    }
}
