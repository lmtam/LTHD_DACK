/**
 * Created by Nguyen on 03-Jan-17.
 */

$(document).ready(function () {
    //auto load file
    $( "#m-header" ).load("menu-bar.html");
    $( "#myModal" ).load("modal.html");

    var product_id = getCookie("product_id");
    getProductById(product_id);
    getCommentByProductId(product_id)

});
function btnThemVaoGioHang(){
    var product_detail_id = $('#product_size :selected').val();
    // console.log(product_detail_id);
    // window.location.href = "cart.html";
    addProductToCart(product_detail_id);
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
            sweetAlert('Bạn đã thêm sản phẩm vào giỏ hàng','','success');

        }
    });
}

function getCommentByProductId(product_id) {
    $.ajax({
        type: "GET",
        url: '../service/comments/get/'+product_id,
        dataType: 'json',
        data:'',
        success: function (respones) {
            for(var i=0; i<respones.length; i++){
                var strTemp = '<div id="" class="row" style="background-color: #ddd; margin-top: 10px">'+
                    '<div class="col-sm-2">'+
                    '<img src="images/user.jpg" height="50" width="50">'+
                    '</div>'+
                    '<div class="col-sm-10 ">'+
                    '<div class="cus-name-comment">'+ respones[i].name+'</div>'+
                    '<div>'+ respones[i].content +'</div>'+
                    '</div>'+
                    '</div>';
                $('#cmtBox').append(strTemp);
            }

        }
    });
}
function comment() {

}

function addcomment() {
    //du lieu test
    var product_id = getCookie('product_id');
    var isLogin = getCookie('isLogin');
    if(isLogin){
        var content = $('#txtcomment').val();
        if(content == ''){
            sweetAlert('Bạn phải nhập vào ô comment','','error');
            return;
        }
        $.ajax({
            type: "POST",
            url: '../service/comments/add',
            dataType: 'json',
            data: {
                product_id: product_id,
                content : content,


            },
            success: function (response) {
                // console.log(response);
                var strTemp = '<div id="" class="row" style="background-color: #ddd; margin-top: 10px">'+
                    '<div class="col-sm-2">'+
                    '<img src="images/user.jpg" height="50" width="50">'+
                    '</div>'+
                    '<div class="col-sm-10 ">'+
                    '<div class="cus-name-comment">'+response[0].name+'</div>'+
                    '<div>'+ content +'</div>'+
                    '</div>'+
                    '</div>';
                $('#cmtBox').append(strTemp);
            }
        });0
    }
    else{
        sweetAlert('Bạn Phải đăng nhập để gửi bình luận');
    }

}

function getProductById($product_id) {
    $.ajax({
        type: "GET",
        url: '../service/products/get/'+ $product_id,
        dataType: 'json',
        data: '',
        success: function (respones) {
            $('#product_name').text(respones[0].product_name);
            $('#product_desciption').text(respones[0].description);
            $('#product_price').text(respones[0].price);
            $('#product_image').attr('src',respones[0].image_name);
            for(var i=0; i < respones.length; i++){
                var strSize = '<option value="'+ respones[i].product_detail_id +'" > Size: '+ respones[i].size + ', Màu : ' + respones[i].color + ' </option>';
                $('#product_size').append(strSize);

            }
        }
    });

}