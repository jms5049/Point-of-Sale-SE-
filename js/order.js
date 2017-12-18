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
    var c = name + "_c";
    var numBox = document.getElementById(q);
    var chkBox = document.getElementById(c);

    if (chkBox.checked) {
        console.log("checked");
        numBox.disabled = false;
        numBox.value = 1;
        if(chkBox.parentNode.parentNode.children[6].innerHTML == "Y"){
            alert("이미 주문된 상품입니다.");
            // chkBox.checked = false;
            numBox.disabled = true;
            numBox.value = 0;
        }
    }
    else {
        console.log("unchecked");
        numBox.disabled = true;
        numBox.value = 0;
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
