$(document).ready(function () {
    $("#title-menu").addClass("hidden");
    var strShoe = '' +
        '<div class="col-sm-4 text-center view-shoe animated slideInUp" onclick="BuyShoe()">' +
        '<img src="images/giaytayden2.jpg" class="img-responsive center-block img-shoe"/>' +
        '<div>Giày Tây Nam Da Cột Dây Thời Trang Zapas GT026 (Đen ) + Tặng Ví Nam Thời Trang</div>' +
        '<div class="price-shoe"><span>400.000</span><span>&nbsp;VND</span></div>' +
        '</div>'
    for(var i=0; i<10; i++){
        $("#main-right").append(strShoe);
    }
});


function GoLogin() {

};

function GoRegister() {

};

function GoContact() {

};

function GoShoeMale() {
    addActive("#shoemale");
    $("#main-right-top").removeClass("hidden");
    $("#main-right").empty();
    var strShoe = '' +
        '<div class="col-sm-4 text-center view-shoe animated slideInUp" onclick="BuyShoe()">' +
        '<img src="images/giaytayden2.jpg" class="img-responsive center-block img-shoe"/>' +
        '<div>Giày Tây Nam Da Cột Dây Thời Trang Zapas GT026 (Đen ) + Tặng Ví Nam Thời Trang</div>' +
        '<div class="price-shoe"><span>400.000</span><span>&nbsp;VND</span></div>' +
        '</div>'
    for(var i=0; i<10; i++){
        $("#main-right").append(strShoe);
    }
}

function GoShoeFemale() {
    addActive("#shoefemale");
    $("#main-right-top").removeClass("hidden");
    $("#main-right").empty();
    var strShoe = '' +
        '<div class="col-sm-4 text-center view-shoe animated slideInUp" onclick="BuyShoe()">' +
        '<img src="images/giaytayden1.jpg" class="img-responsive center-block img-shoe"/>' +
        '<div>Giày Tây Nam Da Cột Dây Thời Trang Zapas GT026 (Đen ) + Tặng Ví Nam Thời Trang</div>' +
        '<div class="price-shoe"><span>400.000</span><span>&nbsp;VND</span></div>' +
        '</div>'
    for(var i=0; i<10; i++){
        $("#main-right").append(strShoe);
    }
}

function GoPromotionProduct() {
    addActive("#promotionproduct");
    $("#main-right-top").removeClass("hidden");
    $("#main-right").empty();
    $("#main-right").append("hang giam gia");
}

function GoNewProduct() {
    addActive("#newproduct");
    $("#main-right-top").removeClass("hidden");
    $("#main-right").empty();
    $("#main-right").append("hang moi ve");
}

function GoNews() {
}

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
    });// $(function () {

});

//set time out
// alert("You will be redirected to main page in 10 sec.");
// setTimeout('Redirect()', 10000);
//
// function Redirect() {
//     window.location="http://www.vietjack.com";
// }

// $(".view-shoe")
//     .mouseenter(function() {
//         $(this).find(".hide-btn").css("display", "block");
//     })
//     .mouseleave(function() {
//         $(this).find(".hide-btn").css("display", "none");
//     });


