
//load du lieu san khi load trang
$(document).ready(function () {

    getAllProduct();
    $( "#myModal" ).load("modal.html");
    getUserById();
});

//bam vao giay nam
function GoShoeMale() {
    addActive("#shoemale");
    $("#main-right-top").removeClass("hidden");
    $("#title-submenu").text("Giày nam");
    $("#main-right").empty();

    $.ajax({
        type: "GET",
        url: '../service/products/getType/nam',
        dataType: 'json',
        data: '',
        success: function (respones) {

            $('#countPro').text(respones.length);
            for(var i=0; i<respones.length; i++){
                var strShoe = '' +
                    '<div class="col-sm-4 text-center view-shoe animated slideInUp" onclick="btnBuyShoe('+ respones[i].product_id +')">' +
                    '<img src="'+ respones[i].image_name+'" class="img-responsive center-block img-shoe"/>' +
                    '<div>'+ respones[i].product_name+'</div>' +
                    '<div class="price-shoe"><span>'+ respones[i].price+'</span><span>&nbsp;VND</span></div>' +
                    '</div>';
                $("#main-right").append(strShoe);
            }


        }
    });
}

//bam vao giay nu
function GoShoeFemale() {
    addActive("#shoefemale");
    $("#main-right-top").removeClass("hidden");
    $("#title-submenu").text("Giày nữ");
    $("#main-right").empty();

    $.ajax({
        type: "GET",
        url: '../service/products/getType/nữ',
        dataType: 'json',
        data: '',
        success: function (respones) {

            $('#countPro').text(respones.length);
            for(var i=0; i<respones.length; i++){
                var strShoe = '' +
                    '<div class="col-sm-4 text-center view-shoe animated slideInUp" onclick="btnBuyShoe('+ respones[i].product_id +')">' +
                    '<img src="'+ respones[i].image_name+'" class="img-responsive center-block img-shoe"/>' +
                    '<div>'+ respones[i].product_name+'</div>' +
                    '<div class="price-shoe"><span>'+ respones[i].price+'</span><span>&nbsp;VND</span></div>' +
                    '</div>';
                $("#main-right").append(strShoe);
            }


        }
    });
}

//bam vao giam gia
function GoPromotionProduct() {
    addActive("#promotionproduct");
    $("#main-right-top").removeClass("hidden");
    $("#title-submenu").text("Hàng giảm giá");
    $("#main-right").empty();
    var strShoe = '' +
        '<div class="col-sm-4 text-center view-shoe animated slideInUp" onclick="btnBuyShoe()">' +
        '<img src="images/1.jpg" class="img-responsive center-block img-shoe"/>' +
        '<div>Giày Tây Nam Da Cột Dây Thời Trang Zapas GT026 (Đen ) + Tặng Ví Nam Thời Trang</div>' +
        '<div class="price-shoe"><span>400.000</span><span>&nbsp;VND</span></div>' +
        '</div>'
    for(var i=0; i<10; i++){
        $("#main-right").append(strShoe);
    }
}

//bam vao san pham moi
function GoNewProduct() {
    addActive("#newproduct");
    $("#main-right-top").removeClass("hidden");
    $("#title-submenu").text("Hàng mới về");
    $("#main-right").empty();
    var strShoe = '' +
        '<div class="col-sm-4 text-center view-shoe animated slideInUp" onclick="btnBuyShoe()">' +
        '<img src="images/2.jpg" class="img-responsive center-block img-shoe"/>' +
        '<div>Giày Tây Nam Da Cột Dây Thời Trang Zapas GT026 (Đen ) + Tặng Ví Nam Thời Trang</div>' +
        '<div class="price-shoe"><span>400.000</span><span>&nbsp;VND</span></div>' +
        '</div>'
    for(var i=0; i<10; i++){
        $("#main-right").append(strShoe);
    }
}

//active tab khi bam
function addActive(Item) {
    $("#shoemale, #shoefemale, #promotionproduct, #newproduct").removeClass("active-item-shoe");
    $(Item).addClass("active-item-shoe");
}

//Chữ chạy(quảng cáo)
$(function () {
    $('.tlt').textillate({
        minDisplayTime: 3000,
        in: {
            effect: 'lightSpeedIn',
            delayScale: 0.5,
            delay: 30,
            reverse: false
        },
        out: {
            effect: 'lightSpeedOut',
            delayScale: 0.5,
            delay: 30,
            reverse: true
        },
        loop: true
    });

});

//nhap dang nhap
function btnLogin() {
    $('.nav li a[href="#formlogin"]').tab('show');
}

//nhap dang ki
function btnRegister() {
    $('.nav li a[href="#formregister"]').tab('show');
}


//mua giay
function btnBuyShoe(product_id) {
    //set product_id vào cookie;
    setCookie('product_id',product_id);
    window.location.href = "detail.html";
}

//hàm tìm kiếm
function Search() {
    var tukhoa = $('#txtSearch').val();
    if(tukhoa == ''){

    }
    else{
        $.ajax({
            type: "GET",
            url: '../service/products/search/'+tukhoa,
            dataType: 'json',
            data: '',
            success: function (respones) {
                $("#main-right-top").removeClass("hidden");
                $("#title-submenu").text("Kết quả tìm kiếm" );
                $('#countPro').text(respones.length);
                $("#main-right").empty();

                for(var i=0; i<respones.length; i++){
                    var strShoe = '' +
                        '<div class="col-sm-4 text-center view-shoe animated slideInUp" onclick="btnBuyShoe('+ respones[i].product_id +')">' +
                        '<img src="'+ respones[i].image_name+'" class="img-responsive center-block img-shoe"/>' +
                        '<div>'+ respones[i].product_name+'</div>' +
                        '<div class="price-shoe"><span>'+ respones[i].price+'</span><span>&nbsp;VND</span></div>' +
                        '</div>';
                    $("#main-right").append(strShoe);
                }


            }
        });
    }
}

function getAllProduct() {
    $.ajax({
        type: "GET",
        url: '../service/products/get',
        dataType: 'json',
        data: '',
        success: function (respones) {

            for(var i=0; i<respones.length; i++){
                var strShoe = '' +
                    '<div class="col-sm-4 text-center view-shoe animated slideInUp" onclick="btnBuyShoe('+ respones[i].product_id +')">' +
                    '<img src="'+ respones[i].image_name+'" class="img-responsive center-block img-shoe"/>' +
                    '<div>'+ respones[i].product_name+'</div>' +
                    '<div class="price-shoe"><span>'+ respones[i].price+'</span><span>&nbsp;VND</span></div>' +
                    '</div>';

                $("#main-right").append(strShoe);
            }

        }
    });
}



