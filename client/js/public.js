/**
 * Created by Nguyen on 06-Jan-17.
 */
//nhap dang nhap
function btnLogin() {
    $('.nav li a[href="#formlogin"]').tab('show');
}

//nhap dang ki
function btnRegister() {
    $('.nav li a[href="#formregister"]').tab('show');
}
function setCookie(c_name, value) {
    var today = new Date();
    today.setTime(today.getTime());
    var expires_date = new Date(today.getTime() + (2592000000));

    var c_value = escape(value) + "; expires=" + expires_date.toGMTString() + "; path=/";
    //var c_value = value + "; expires=" + expires_date.toGMTString() + "; path=/";
    document.cookie = c_name + "=" + c_value;
}

function getCookie(c_name) {
    //if (c_name == 'Level1ID') alert(c_name);

    var i, x, y, ARRcookies = document.cookie.split(";");
     for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {

            if (y == 'undefined') y = '';
            //            if (c_name == 'Level1ID') alert(y);
            //alert('name: ' + c_name + '; value: ' + y);
            return unescape(y);
        }
    }
    //alert(ARRcookies);
    return null;
}

// this deletes the cookie when called
function deleteCookie(name) {
    //alert('te');
    if (getCookie(name) != null) document.cookie = name + "=;path=/;expires=Thu, 01-Jan-1970 00:00:01 GMT";
}



function login() {
    var username = $('#txtemail').val();
    var password = $('#txtpassword').val();
    if(username == '' || password == ''){
        sweetAlert('Bạn phải nhập đầy đủ thông tin','','error');
        return;
    }

    $.ajax({
        type: "POST",
        url: '../service/login',
        dataType: 'json',
        data: {
            username:username,
            password:password
        },
        success: function (response) {
            //
            // console.log('123456');
            if(response == 'Success'){
                setCookie('isLogin','1');
                $("#myModal").modal('hide');
            }
            else{
                sweetAlert('Tài khoản hoặc mật khẩu sai.','','error');
            }
        }
    });
}
function register() {
    var name = '';
    var username = 'tamle';
    var password = '123456';
    var confirmpassword = '';
    var ngaysinh = '';
    $.ajax({
        type: "POST",
        url: '../service/register',
        dataType: 'json',
        data: {
            username:username,
            password:password,

        },
        success: function (respones) {


        }
    });
}
function logout() {
    
}

function Carts() {
    var isLogin = getCookie('isLogin');
    if(isLogin){
        window.location.href="cart.html";
    }
    else{
        sweetAlert('Bạn Phải đăng nhập mới xem được giỏ hàng');
    }
}