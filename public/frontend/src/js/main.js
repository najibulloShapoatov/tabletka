
'use strict'


function req(url, method='GET', callback,  data=null, errorElementID= 'null', datatype='null') {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        }
    });
    if(datatype === 'null') {
        $.ajax({
            url: url,
            data: data,
            type: method,
            contentType: false,
            cache: false,
            processData: false,
            //dataType: 'json',
            success: function (data) {
                callback(data);
            },
            error: function (data) {
                //console.log(data);
                if (errorElementID === 'null') {
                    console.log(data);
                } else {
                    $('#' + errorElementID).empty().removeClass('d-none');
                    $.each(data.responseJSON.errors, function (key, value) {
                        $('#' + errorElementID).append(value[0] + '<br/>');
                    });
                }
            }
        });
    }

    else {
        $.ajax({
            url: url,
            data: data,
            type: method,
            contentType: false,
            cache: false,
            processData: false,
            dataType: datatype,
            success: function (data) {
                callback(data);
            },
            error: function (data) {
                //console.log(data);
                if (errorElementID === 'null') {
                    console.log(data);
                } else {
                    $('#' + errorElementID).empty().removeClass('d-none');
                    $.each(data.responseJSON.errors, function (key, value) {
                        $('#' + errorElementID).append(value[0] + '<br>');
                    });
                }
            }
        });

    }
}


$(document).on('click', '#termsCheckbox', function () {
    $(this).val(($(this).prop('checked'))? 1: 0);
});

$(document).on('click', '#logIn', function () {
   let phone = $('#signinPhone').val();
   let password = $('#signinPassword').val();
   let remember = $('#termsCheckbox').val();
   let fd = new FormData();
   fd.append('phone', phone);
   fd.append('password', password);
   fd.append('remember', remember);

   req('/login', 'POST', (data)=>{
       //console.log(data);
       if(data.err ==1){
           $('#signinPhone').val('');
           $('#signinPassword').val('');
           $('#error_login').removeClass('d-none').html(data.msg);
       }
       else{
       location.reload();
       }
   }, fd);

});



// add to wishlist
$(document).on("click", "#addtowish", function(e){
    e.preventDefault();

    var id = $(this).attr('data-id');
    var sts = $(this).attr('data-sts');

    if(sts != '1') {
        req('/add-to-wishlist/' + id, ...[,], (data) => {
            //console.log(data);
            setTimeout(function () {
                $('.wishlist_' + id).attr('data-sts', 1)
                $.growl.notice({title: "", message: "Успешно добавлен"});

                // change qnt of wishlist
                getWishlistQnt();

            }, 1500);
        });
    }


});
// change qnt of wishlist
getWishlistQnt();

// get count of wishlist
function getWishlistQnt()
{
    req('/get-wishlist-count', ...[,], (data)=>{
        $('#wishlist_count').html(data);
    });
    req('/get-wishlists', ...[,], (data)=>{
        $('#wishlist_items').html(data);
    });
}

$(document).on('click', '.p-img-thumb', function (e) {
e.preventDefault();
location.href = '/product/'+$(this).attr('data-id');
});


$(document).on('click', '#removeWishlist', function (e) {
e.preventDefault();

let id = $(this).attr('data-id');

req('/remove-wishlist/'+id, ...[,], (data)=>{
    $('.wishlist_item_'+id).fadeOut("normal", function() {
        getWishlistQnt();
        $(this).remove();
    });
})
});

$(document).on('click', '.js-plus', ()=>{
    let val = parseInt($('.js-result').val());
    if( val >= 100){
        $('.js-result').val(1);
    }
    else {
        $('.js-result').val(val + 1);
    }
});
$(document).on('click', '.js-minus', ()=>{
    let val = parseInt($('.js-result').val());
    if( val <= 1){
        $('.js-result').val(1);
    }
    else {
        $('.js-result').val(val - 1);
    }
});






// add to cart with changing qnt
$(document).on("click", ".addToCart", function(e){
    e.preventDefault();

    var _id = $(this).attr('data-id');
    var _qnt = $('#qnt-product').val();
    //console.log(_qnt);

    $(this).addClass('btn-loading');
    $(this).html('<div style="width: 20px; height: 20px" class="spinner-border text-primary" role="status">\n' +
        '<span class="sr-only">Loading...</span>\n' +
        '</div>');


    var form_data = new FormData();
    form_data.append('id', _id);
    form_data.append('qnt', _qnt);

    req('/add-to-cart', "POST", (data)=>{
        setTimeout( function () {
            $('.addToCart').html('Добавить в корзину');
            $.growl.notice({ title: "", message: "Успешно добавлен" });
            getCartItems();
        }, 2500);
    }, form_data);


});





// add to cart with changing qnt
$(document).on("click", ".addOneToCart", function(e){
    e.preventDefault();
    $( this ).children( ".product__add-to-cart" ).html('процессе');

    var _id = $(this).attr('data-id');
    var _qnt = 1;
    var form_data = new FormData();
    form_data.append('id', _id);
    form_data.append('qnt', _qnt);

    req('/add-to-cart', "POST", (data)=>{
        setTimeout( function () {
            $.growl.notice({ title: "", message: "Успешно добавлен" });
            $('.addOneToCart span.product__add-to-cart').html('В корзину');
            getCartItems();
        }, 2500);
    }, form_data);


});
getCartItems();
// get cart items
function getCartItems() {

    req('/get-cart-items',...[,], (data)=>{
        $('#basket_data').html(data.html);
        $('#cart_count_indicator').html(data.basket.qnt);
    });

}

// remove from cart
$(document).on("click", ".removeCartItem", function(e){
    e.preventDefault();

    var id = $(this).attr('data-id');
    var totalItemPrice = parseFloat($('.price_total_item_'+id).html());

    req('/remove-from-cart/'+id, ...[,], (data)=>{
        $('.cart_item_'+id).fadeOut("normal", function() {
            getCartItems();
            $(this).remove();
        });
        let st = parseFloat($('#subtotal').html());
        let t = parseFloat($('#total').html());
        $('#subtotal').html(((st-totalItemPrice).toFixed(2)));
        $('#total').html((t-totalItemPrice).toFixed(2));
    });



});





// set total price block
function setTotalPriceBlock(totalPrice) {
    let _vsego = parseFloat(totalPrice);
    $('#subtotal').html(_vsego.toFixed(2));
    //_vsego+=parseFloat($('#shipping_cost').val());
    $('#total').html(_vsego.toFixed(2));
}

// cart page: cart item change qnt
$(document).on("change", ".cart_chg_qnt", function(e){
    e.preventDefault();

    var _id = $(this).attr('data-id');
    var _val = $(this).val();
    changeQntCart(_id, _val);


});
function changeQntCart(_id, _val){
    var form_data = new FormData();
    form_data.append('id', _id);
    form_data.append('qnt', _val);

    req('/cart-change-qnt', "POST", (data)=>{
        $('.price_total_item_' + _id).html(data.itogo);

        // total price block
        setTotalPriceBlock(data.cart.sum);

        // update top cart
        getCartItems();
    }, form_data);
}

$(document).on('click', '.js-plus-cart', function(){
    let id = $(this).attr('data-id');
    let val = parseInt($('.js-result-cart-'+id).val());
    if( val >= 100){
        $('.js-result-cart-'+id).val(1);
    }
    else {
        $('.js-result-cart-'+id).val(val + 1);
    }
    changeQntCart(id,$('.js-result-cart-'+id).val());
});
$(document).on('click', '.js-minus-cart', function(){
    let id = $(this).attr('data-id');
    let val = parseInt($('.js-result-cart-'+id).val());
    if( val <= 1){
        $('.js-result-cart-'+id).val(1);
    }
    else {
        $('.js-result-cart-'+id).val(val - 1);
    }
    changeQntCart(id,$('.js-result-cart-'+id).val());
});


/*$(document).on('change', '.shipping_method', function () {
let v = parseFloat($(this).attr('data-id'));

let total = parseFloat($('#total').html());
   let shCost = parseFloat($('#shipping_cost').val());

    $('#total').html(((total-shCost)+v).toFixed(2));

$('#shipping_cost').val(v);
$('.shipping_text').html($(this).val());
});*/
$(document).on('change', '.shipping_method', function () {
let v = parseFloat($(this).val());

let total = parseFloat($('#total_order').html());
let shCost = parseFloat($('#shipping_cost').val());

$('#total_order').html(((total-shCost)+v).toFixed(2));
$('#shipping_cost').val(v);
$('#shipping_cost').attr('data-id', $(this).attr('data-id'));
});


// get total price of cart
function getTotalPrice(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        }
    });
    $.ajax({
        url: '/get-cart-total-price',
        data: '',
        type: 'GET',
        contentType: false,
        cache: false,
        processData: false,
        dataType : 'json',
        success: function( data ) {
            ////console.log(data);

            if(data.qnt != 0){
                setTotalPriceBlock(data.sum);
            }
            else{
                $('._cartPageBlock').html('<p>Ваша корзина пуста</p>');
            }

        },
        error: function( data ) {
            console.log(data);
        }
    });
}


$(document).on('change', '#sort_products', function () {

    let sort = $(this).val();
    req('/change-sort/'+sort, ...[,], (data)=>{
        //console.log(data);
        location.reload();
    });
});


$(document).on('change', '.payment-method', function () {
$('#payment_method').val($(this).val());
});



$(document).on('click', '#make_order', function (e) {
    e.preventDefault();
    let formData = new FormData();
    formData.append( 'name' , $('#billing_first_name').val());
    formData.append( 'lastname' , $('#billing_last_name').val());
    formData.append( 'address' , $('#billing_address').val());
    formData.append( 'city' , $('#billing_city').val());
    formData.append( 'phone' , $('#billing_phone').val());
    formData.append( 'email' , $('#billing_email').val());
    formData.append( 'delivery_type' , $('#shipping_cost').attr('data-id'));
    formData.append( 'delivery_cost' , $('#shipping_cost').val());
    formData.append( 'payment_type' , $('#payment_method').val());



    req('/checkout/order','POST',  async function(data){
        if(!(data.input)){$.growl.error({title: "Ошибка", message: 'Ваша корзина пуста'});}
        if(data.input.error_code != 0){
            $.growl.error({title: "Ошибка", message: data.input.msg});
        }else{
            //console.log(data);
            $('.content-body').html(data.html);
            $('body').removeClass();
            $('#msg').html(data.input.msg);


        }

    },formData);
});


$(document).on('click', '#create_account_client', function () {

    let name = $('#name_new').val();
    let phone = $('#phone_new').val();
    let password = $('#pass_new').val();
    let confirmPassword = $('#confirmPass_new').val();
    var formData = new FormData();
    formData.append('name', name);
    formData.append('phone', phone);
    formData.append('password', password);
    formData.append('confirmPassword', confirmPassword);

    req('/user-create', 'POST', (data)=>{
        console.log(data);
        if(data.err != 0){
            $('#error_signup').removeClass('d-none').html(data.msg);
        }
        if(data.err == 0){
            $('#confirmCode').attr('data-id', data.res);
            $('#sms_comfirm_btn').click();
        }
    }, formData, 'error_signup', 'json');

});
$(document).on('click', '#confirmCode', function (e) {
e.preventDefault();
let smsCode = $('#smsCode').val();
let id = $(this).attr('data-id');

let formData = new FormData();
formData.append('id', id);
formData.append('smsCode', smsCode);

req('/check-sms-code', 'POST', (data)=>{
    if(data.sts == 1){
        $('#error_smsCode').removeClass('d-none').html(data.msg);
        return
    }
    location.reload();

},formData, 'error_smsCode');
});

$(document).on('click', '#view_order_details_user', function () {

    let id = $(this).attr('data-id');

    req('/order-detail/'+id, 'GET', (data)=>{
        //console.log(data);
        $('#order_data').html(data);
    });
});



$(document).on('click', '#back_to_orders', function () {
    req('/order-back', 'GET', (data)=>{
        //console.log(data);
        $('#order_data').html(data);
    });
});

$(document).on('click', '#save_user_info', function (e) {

    e.preventDefault();
    let name = $('#name_user').val();
    let surname = $('#surname_user').val();
    let city = $('#city_user').val();
    let email = $('#email_user').val();
    let address = $('#address_user').val();

    let formData = new FormData();
    formData.append('name', name);
    formData.append('surname', surname);
    formData.append('city', city);
    formData.append('email', email);
    formData.append('address', address);

    req('/update-user-info', 'POST', (data)=>{
        if (data.err == 1) {
            $('#error_change_userInfo').removeClass('d-none').html(data.msg);
            $.growl.error({title: "Ошибка", message: data.msg});

            setTimeout(function () {
                $('#error_change_userInfo').fadeOut(500).toggleClass('d-none');
            }, 3500);
        }
        else {
            $('#succes_change_userInfo').removeClass('d-none').html(data.msg);
            $.growl.notice({title: "", message: data.msg});

            setTimeout(function () {
                $('#succes_change_userInfo').fadeOut(500).toggleClass('d-none');
            }, 3500);

        }

    }, formData, 'error_change_userInfo');
});
$(document).on('click', '#save_change_password', function (e) {

    e.preventDefault();
    let oldpass = $('#old_password').val();
    let newpass = $('#new_password').val();
    let confirmpass = $('#confirmpassword_new').val();


    let formData = new FormData();
    formData.append('oldpass', oldpass);
    formData.append('newpass', newpass);
    formData.append('confirmpass', confirmpass);

    req('/update-user-pass', 'POST', (data)=>{
        if (data.err == 1) {
            $('#error_change_userPass').removeClass('d-none').html(data.msg);
            $.growl.error({title: "Ошибка", message: data.msg});
            setTimeout(function () {

                $('#error_change_userPass').fadeOut(500).toggleClass('d-none');
            }, 3500);
        }
        else {
            $('#succes_change_userPass').removeClass('d-none').html(data.msg);
            $.growl.notice({title: "", message: data.msg});
            setTimeout(function () {
                $('#succes_change_userPass').fadeOut(500).toggleClass('d-none');
            }, 3500);

        }

    }, formData, 'error_change_userInfo');
});
