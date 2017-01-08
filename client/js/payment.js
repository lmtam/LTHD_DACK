/**
 * Created by Nguyen on 04-Jan-17.
 */
function btnDatHangThanhCong() {
    // sweetAlert("Đặt hàng thành công", "", "success");
    addOrder();
}

$("table[id$=tblPayment]").bootstrapTable({
    classes: 'table table-hover',
    //data: data
});
function getCartProductByUserId() {
    $.ajax({
        type: "GET",
        url: '../service/carts/get',
        dataType: 'json',
        data: '',
        success: function (respones) {


        }
    });
}
function addOrder() {
    var name = $('#name').val();
    var address = $('#address').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var order_detail = new Array();
    var totalPrice = 0;

    // $.ajax({
    //     type: "GET",
    //     url: '../service/carts/get',
    //     dataType: 'json',
    //     data: '',
    //     success: function (respones) {
    //         // console.log(respones);
    //         for(var i=0; i< respones.length; i++){
    //             order_detail.push(respones[i].product_detail_id);
    //             totalPrice += parseInt(respones[i].count) * parseInt(respones[i].price);
    //
    //
    //         }
    //     }
    // });
    //
    // console.log(totalPrice);

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
            // order_detail:order_detail
        },
        success: function (respones) {

        }
    });
}