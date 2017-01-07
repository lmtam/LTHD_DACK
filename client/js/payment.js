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
    var adress = $('#address').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var order_detail = new Array();

    $.ajax({
        type: "GET",
        url: '../service/carts/get',
        dataType: 'json',
        data: '',
        success: function (respones) {
            console.log(respones);

        }
    });

    //console.log(order_detail);
    // $.ajax({
    //     type: "POST",
    //     url: '../service/orders/add',
    //     dataType: 'json',
    //     data: {
    //         name:name,
    //         address:address,
    //         email:email,
    //         phone:phone,
    //         order_detail:order_detail
    //     },
    //     success: function (respones) {
    //
    //
    //     }
    // });

}