function autoHypen(){
    var card = document.getElementById('card');
    var rHypen = card.value.replace(/-/g, "");
    var rlength = rHypen.length;

    if(card.value.length % 5 == 0) return;

    if(rlength >= 16 || rlength == 0) return;

    if (rlength % 4 == 0) {
        card.value += '-';
    }
}

function calculation() {
    var given = document.getElementById("givenPrice").value;
    var total = document.getElementById("totalPrice").innerHTML;

    var givenprice = parseInt(given)
    var totalprice = parseInt(total);

    var text = givenprice - totalprice;

    var result = document.getElementById("change");
    result.innerHTML = text;

}


function PurchaseFailure(){
    alert("결제가 취소되었습니다.");
    location.href = "pay.php";
}
