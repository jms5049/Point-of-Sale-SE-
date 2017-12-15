// ---------------- 주문목록 페이지 ----------------
// 주문상세 팝업창
function opendetail(thisbutton) {
    var classvalue = thisbutton.parentNode.parentNode.className;
    window.open("orderdetail.php?orderid=" + classvalue, "detail", "width=570, height=570");
}

// ---------------- 외부주문 페이지 ----------------
// 수량 선택 활성화
function setNum(name) {
    var q = name + "_q";
    var numBox = document.getElementsByName(q);
    var chkBox = document.getElementsByName(name);

    if (chkBox[0].checked) {
        console.log("checked");
        numBox[0].disabled = false;
        numBox[0].value = 1;
    }
    else {
        console.log("unchecked");
        numBox[0].disabled = true;
        numBox[0].value = 0;
    }
}

// 상품추가 팝업창
function opengoods() {
    window.open("addgood.php", "addgood", "width=570, height=300");
}

// 재고추가 팝업창
function openstock() {
    window.open("addstock.php", "addstock", "width=570, height=300");
}
