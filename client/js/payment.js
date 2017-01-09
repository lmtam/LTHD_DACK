/**
 * Created by Nguyen on 04-Jan-17.
 */
var order_detail = new Array();
$(document).ready(function () {
   getCartProductByUserId();
    $( "#m-header" ).load("menu-bar.html");
    $( "#myModal" ).load("modal.html");
});

function btnDatHangThanhCong() {
    // sweetAlert("Đặt hàng thành công", "", "success");
    addOrder();
}



function getCartProductByUserId() {

    var totalPrice = 0;
    $.ajax({
        type: "GET",
        url: '../service/carts/get',
        dataType: 'json',
        data: '',
        success: function (respones) {
            // var arraylist = new Array();
            for(var i=0; i< respones.length; i++){
                order_detail.push(respones[i].product_detail_id);
                totalPrice += parseInt(respones[i].count) * parseInt(respones[i].price);

            }
            $('#tongtien').text(totalPrice);
            $("table[id$=tblPayment]").bootstrapTable('load', respones);
        }
    });
}
function addOrder() {
    var name = $('#name').val();
    var address = $('#address').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var totalPrice = $('#tongtien').val();


    if(name =='' || address=='' || email=='' || phone ==''){
        sweetAlert('Vui lòng nhập đầy đủ thông tin','','error');
        return;
    }
    $.ajax({
        type: "POST",
        url: '../service/orders/add',
        dataType: 'json',
        data: {
            name:name,
            address:address,
            email:email,
            phone:phone,
            total_money:totalPrice,
            order_detail:order_detail
        },
        success: function (respones) {
            sweetAlert("Đặt hàng thành công",'','success');
        }
    });

}