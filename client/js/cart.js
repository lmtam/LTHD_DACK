
$(document).ready(function () {
    getCartProduct();
    $( "#m-header" ).load("menu-bar.html");
    $( "#myModal" ).load("modal.html");
    getUserById();
});
var tonghang =0;
function getCartProduct() {
    $.ajax({
        type: "GET",
        url: '../service/carts/get',
        dataType: 'json',
        data: '',
        success: function (respones) {
            var tongtien =0;
            tonghang = respones.length;
            for(var i=0; i<respones.length; i++){
                var strInfor = '<div class="row  product-cart " id="product_detail_'+ respones[i].product_detail_id+'" style="margin-top: 20px;">'+
                                '<div class="col-sm-2">'+
                                '<img src="'+ respones[i].image_name +'" class="img-responsive">'+
                                '</div>'+
                                '<div class="col-sm-5">'+
                                '<div class="cus-bold">'+respones[i].product_name +'</div>'+
                                '<div>'+
                                'Size:'+
                                '<span >'+ respones[i].size+'</span>'+
                                '</div>'+
                                '<div>'+
                                'Màu sắc:'+
                                '<span >'+ respones[i].color+'</span>'+
                                '</div>'+
                                '</div>'+
                                '<div class="col-sm-2">'+
                                '<div class="style-money" >'+respones[i].price+'<span> VND</span></div>'+
                                '</div>'+
                                '<div class="col-sm-2">'+
                                '<div>'+respones[i].count+'</div>'+
                                '</div>'+
                                '<div class="col-sm-1">'+
                                '<button id="deleteproduct" onclick="deleteOneProduct('+respones[i].product_detail_id +')">'+
                                '<i class="fa fa-remove"></i>'+
                                '</button>'+
                                '</div>'+
                                '</div>';
                $('#product_row').append(strInfor);
                tongtien += (parseInt(respones[i].price)*parseInt(respones[i].count));
                

            }
            $('#tongtien').text(tongtien);
        }
    });
}

function Payment() {
    if(tonghang > 0){
        window.location.href='payment.html';
    }
    else{
        sweetAlert('Giỏ hàng trống', "", "error");
    }
}

function deleteOneProduct(product_detail_id) {
    // console.log(product_detail_id);
    $.ajax({
        type: "GET",
        url: '../service/carts/delete/'+ product_detail_id,
        dataType: 'json',
        data: '',
        success: function () {
            var strTemp = '#' + 'product_detail_' +product_detail_id;
            $(strTemp).addClass('hidden');


        }
    });
}