/**
 * Created by Nguyen on 03-Jan-17.
 */

function btnThemVaoGioHang(){
    window.location.href = "cart.html";
}
function getCommentById(id) {
    console.log(id);
    $.ajax({
        type: "GET",
        url: '../service/comments/get/' + id,
        dataType: 'json',
        data:'',
        success: function (respones) {


        }
    });
}
function addcomment() {
    //du lieu test
    var product_detail_id = 1;
    var content = 'Đẹp';
    $.ajax({
        type: "POST",
        url: '../service/comments/add',
        dataType: 'json',
        data: {
            product_detail_id: product_detail_id,
            content : content,
            user_id : 1

        },
        success: function (respones) {


        }
    });
}

function getProductById($product_id) {
    $.ajax({
        type: "GET",
        url: '../service/products/get/'+ $product_id,
        dataType: 'json',
        data: '',
        success: function (respones) {


        }
    });

}