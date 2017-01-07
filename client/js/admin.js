/**
 * Created by Nguyen on 04-Jan-17.
 */

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


function addProduct() {
    var name = $('#tensp').val();
    var price = $('#giasp').val();
    var description = $('#motasp').val();
    var type = $('#loaisp').val();
    var image_name = $('#uploader').val();
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
    // console.log(product_detail);
    $.ajax({
        type: "POST",
        url: '../service/products/add',
        dataType: 'json',
        data: {
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