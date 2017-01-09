/**
 * Created by Nguyen on 04-Jan-17.
 */

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: '../service/products/get',
        dataType: 'json',
        data: '',
        success: function (respones) {
            $("table[id$=tblListProduct]").bootstrapTable('load', respones);

        }
    });
})

function loginAdmin() {
    var username = $('#txtemail').val();
    var password = $('#txtpassword').val();
    if(username == '' || password == ''){
        sweetAlert('Bạn phải nhập đầy đủ thông tin','','error');
        return;
    }
    $.ajax({
        type: "POST",
        url: '../service/login/admin',
        dataType: 'json',
        data: {
            username:username,
            password:password
        },
        success: function (respones) {
            console.log(respones);
            if(respones === 'Error'){
                sweetAlert('Đăng nhập không thành công','','error');
            }
            else{
                console.log(respones);
                setCookie('token',respones);
                $("#formLoginAdmin").addClass("hidden");
                $("#formMainAdmin").removeClass("hidden");

            }
        },
        error: function (error) {
            console.log(error);
        }

    });



}

//xem chi tiet sp
function btnThemChiTietSanPham() {
    var num = parseInt($('#num').val())+1 ;


    console.log(num);
    document.getElementById("num").value = num;
    var strTemp = '<div class="row cus-padding-top">' +
        '<div class="col-sm-1" ><label>Size</label></div>' +
        '<div class="col-sm-2"><input type="text" id="size-'+ num +'" class="form-control"/></div>' +
        '<div class="col-sm-1"><label>Màu</label></div>' +
        '<div class="col-sm-2"><input type="text" id="color-'+ num +'" class="form-control"/></div>' +
        '<div class="col-sm-2"><label>Số lượng</label></div>' +
        '<div class="col-sm-2"><input type="text" id="count-'+ num +'" class="form-control"/></div>' +
    '</div>'
    $("#divProductDetail").append(strTemp);
}

//hàm them sp
function addProduct() {
    var name = $('#tensp').val();
    var price = $('#giasp').val();
    var description = $('#motasp').val();
    var type = $('#loaisp').val();
    var image_name = $('#image_name').val();
    var num = parseInt($('#num').val());
    var product_detail = new Array();
    var total = 0;
    for(var i = 1; i<= num; i++){
        var size = $('#size-'+ i).val();
        var color = $('#color-'+ i).val();
        var count = $('#count-'+ i).val();
        var temp =new Array();
        temp.push(size);
        temp.push(color);
        temp.push(count);
        product_detail.push(temp);
        total += count;
        // [size]:41
    }
    var token = getCookie('token');
    // console.log(product_detail);
    $.ajax({
        type: "POST",
        url: '../service/products/add',
        dataType: 'json',
        data: {
            auth:token,
            name: name,
            description: description,
            type: type,
            price: price,
            image_name:image_name,
            count: total,
            product_detail:product_detail
        },
        success: function (respones) {


        }
    });
}

function BrowseServer(name) {
//            console.log(name);
    var config = {};
    config.startupPath = 'Images:/upload/images/';
    var finder = new CKFinder(config);
//    finder.basePath = '../';
    finder.selectActionFunction = SetFileField;
    finder.selectActionData = name;
    finder.callback = function (api) {
        api.disableFolderContextMenuOption('Batch', true);
    };
    finder.popup();
}
function SetFileField(fileUrl, data) {
    var file = fileUrl.replace(/\/\//g, '/');
    $('#image_name').val(file);
    var name =$('#image_name').val();
    console.log(name);
    var filename = 'http://localhost/DACK/client'+ file;
    $('#imgDaidien').attr('src',filename);
        //            console.log(file);
//     $('#' + data["selectActionData"]).val(file);
//     $('#' + data["selectActionData"]).parent().find('.preview-file-upload').attr('src', file);
}
var browseImage = function () {
    $('.browse-image').click(function () {
        var name = $(this).attr('data-target');
        //openKCFinder();
        BrowseServer(name);
    });
};
browseImage();

//-------//
$("table[id$=tblListProduct]").bootstrapTable({
    classes: 'table table-hover',
    //data: data
});

$('table[id$=tblListProduct]').on('click-row.bs.table', function (row, $element, field) {
    $('[href="#formProduct"]').tab('show');
});