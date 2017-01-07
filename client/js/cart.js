/**
 * Created by Nguyen on 03-Jan-17.
 */
function getCartProduct() {
    $.ajax({
        type: "GET",
        url: '../service/carts/get',
        dataType: 'json',
        data: '',
        success: function (respones) {


        }
    });
}

function addProductToCart(product_detail_id) {
    $.ajax({
        type: "POST",
        url: '../service/carts/add',
        dataType: 'json',
        data: {
            product_detail_id: product_detail_id
        },
        success: function (respones) {


        }
    });
}