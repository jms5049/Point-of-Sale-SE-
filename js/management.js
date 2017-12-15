/**
 * Created by eunjeong on 2017-11-23.
 */

var currentCash = 100000;
var salesCash = 5000;
//  현금 잔고 보여주는 함수
function showCashBalance() {
    var text = document.getElementById("cash");
    text.innerHTML = currentCash+"원";
}
//  매출 보여주는 함수
function showSalesBalance() {
    var text = document.getElementById("sales");
    text.innerHTML = salesCash+"원";
}