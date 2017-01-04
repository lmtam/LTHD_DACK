/**
 * Created by Nguyen on 04-Jan-17.
 */

function btnThemChiTietSanPham() {
    var strTemp = '<div class="row cus-padding-top">' +
        '<div class="col-sm-1"><label>Size</label></div>' +
        '<div class="col-sm-2"><input type="text" class="form-control"/></div>' +
        '<div class="col-sm-1"><label>Màu</label></div>' +
        '<div class="col-sm-2"><input type="text" class="form-control"/></div>' +
        '<div class="col-sm-2"><label>Số lượng</label></div>' +
        '<div class="col-sm-2"><input type="text" class="form-control"/></div>' +
    '</div>'
    $("#divProductDetail").append(strTemp);
}
