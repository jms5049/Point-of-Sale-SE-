var count = 4;
var i=0;
var goodscount = 0; // 추가된 상품의 갯수
var totalprice = 0; // 총 금액

function selectAll(target){
  var item = document.getElementsByName("item");
  if(target.checked == true){
    uncheckAll(item);
  }
  else{
    checkAll(item);
  }

}

function uncheckAll(item){
  for(i=0;i<count;i++){
    item[i].checked = true;
  }
}

function checkAll(item){
  for(i=0;i<count;i++){
    item[i].checked = false;
  }
}

function deleteGood() {
    var item = document.getElementsByName("item");
    for (i = 0; i < count; i++) {
        if (count > 0 && item[i].checked) {
            var row = document.getElementsByClassName("row");
            row = row[i];
            if (count == 1) {
                alert("hi");
            }
            else {
                var parent = document.getElementById("orderTable");
                var child = row.childNodes;
                // 총금액 변경
                totalprice -= Number(child[7].innerHTML);
                //document.getElementById('totalprice').innerHTML = totalprice;
                document.getElementsByClassName('hiddenPrice')[0].value = totalprice;
                parent.removeChild(row);
                count -= 1;
                goodscount--;
            }
        }
    }
    document.getElementsByClassName('hiddenPrice')[0].onchange();
    //상품 총금액 (최종금액아님!)이 바뀌었다는것을 수동적으로 이벤트 날림
}

// 회원 가입 창 띄우기
function openuser() {
    window.open("adduser.php", "adduser", "width=570, height=300");
}

// 주문 상품 추가 함수
function addgood() {
    var select = document.addgoods.goods;
    var selectoption = select.options[select.selectedIndex];
    var name = selectoption.text;
    var price = select.value;
    var quantity = document.addgoods.quantity.value;
    // row 늘려야하는 경우
    if (goodscount == count) {
        var tbody = document.getElementById('orderTable');
        //console.log(tbody.rows.length);
        var row = tbody.insertRow(tbody.rows.length - 3);
        var cell1 = row.insertCell(0);
        cell1.innerHTML = '<input type="checkbox" name="item">';
        cell1.setAttribute("style", "width: 5%;");
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell3 = row.insertCell(3);
        row.setAttribute("class", "row");
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "item_id_" + goodscount);
        row.appendChild(input);
        var input2 = document.createElement("input");
        input2.setAttribute("type", "hidden");
        input2.setAttribute("name", "item_quantity_" + goodscount);
        row.appendChild(input2);
        count++;
    }

    var row = $('.row');
    // 삽입할 위치 확인
    var i;
    var addindex = goodscount;
    for (i = 0; i < goodscount; i++) {
        if (row.eq(i).children().eq(1).text() == name)
            addindex = i;
    }
    // 재고 확인
    var stock = Number(selectoption.attributes[0].value);

    // 상품 추가
    if (addindex == goodscount) {
        if (Number(quantity) > stock) {
            alert("재고가 부족합니다!");
            return;
        }
        var children = row.eq(addindex).children();
        //console.log(children);
        //console.log(goodscount);
        children.eq(1).text(children.eq(1).text() + name);
        children.eq(2).text(quantity);
        children.eq(3).text(price * quantity);
        children.eq(4).val(selectoption.attributes[2].value);
        children.eq(5).val(Number(quantity));
        totalprice += Number(children.eq(3).text());
        goodscount++;
        document.goodslist.goodsquantity.value = goodscount;
        document.goodslist.goodstotalprice.value = totalprice;
        //console.log(children.eq(4).val() + " " + children.eq(5).val());
    } else {
        var children = row.eq(addindex).children();
        var newquantity = Number(children.eq(2).text()) + Number(quantity);
        if (newquantity > stock) {
            alert("재고가 부족합니다!");
            return;
        }
        children.eq(2).text(Number(children.eq(2).text()) + Number(quantity));
        children.eq(3).text(price * children.eq(2).text());
        children.eq(5).val(Number(children.eq(2).text()));
        totalprice += price * quantity;
        document.goodslist.goodstotalprice.value = totalprice;
        //console.log(children.eq(4).val() + " " + children.eq(5).val());
    }
    // 총 가격 변경
    document.getElementsByClassName('price')[0].innerHTML = totalprice;
    //document.getElementById('totalprice').innerHTML = totalprice;
    // 신분증 확인 품목 메시지 출력
    var category = selectoption.attributes[1].value;
    //console.log(category);
    if (category == 1)
        alert("미성년자 구매 제한 품목입니다.\n신분증을 확인해주세요.");

    document.getElementsByClassName('hiddenPrice')[0].onchange();
    //상품 총금액 (최종금액아님!)이 바뀌었다는것을 수동적으로 이벤트 날림
}

// 결제 버튼
function submitorder(num) {
    var list = document.goodslist;
    console.log("goodsquantity: " + list.goodsquantity.value);
    console.log("goodsprice: " + list.goodstotalprice.value);
    var i;
    for (i = 0; i < goodscount; i++) {
        var id = "item_id_" + i;
        var quantity = "item_quantity_" + i;
        console.log("gid: " + document.getElementsByName(id)[0].value);
        console.log("quantity: " + document.getElementsByName(quantity)[0].value);
    }
    console.log(list.action);
    if(num == 2){
        list.setAttribute('action', 'cardSettlement.php'); // 카드 결제로 변경
    }
    list.submit();
}


function openPopUp() {
  window.open("search.php", "회원검색", "width=570, height=570");
}

function calculate(){
  var totalPrice = document.getElementsByName("goodstotalprice");
  console.log(totalPrice);
  var finalPrice = document.getElementsByName("finalPrice");
  console.log(totalPrice);
  var pointUse = document.getElementsByName("pointUse");
  console.log(pointUse);
  var price = document.getElementsByClassName("price");
  finalPrice[0].value = totalPrice[0].value - pointUse[0].value;
  console.log(finalPrice[0].value);

  price[0].innerHTML = totalPrice[0].value;
  price[1].innerHTML = pointUse[0].value;
  price[2].innerHTML = finalPrice[0].value;
}
