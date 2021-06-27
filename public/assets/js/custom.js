(function ($) {
    "use strict";


    function ajaxReq(url, method='GET', callback,  data=null, errorElementID= 'null') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        });
        $.ajax({
            url: url,
            data: data,
            type: method,
            contentType: false,
            cache: false,
            processData: false,
            //dataType: 'json',
            success: function( data ) {
                callback(data);
            },
            error: function( data ) {
                console.log(data);
                if (errorElementID === 'null') {

                        console.log(data);
                }
                else if (errorElementID === 'window.alert') {
                    let a;
                    $.each(data.responseJSON.errors, function (key, value) {
                        a += value[0];
                    });
                    //alert(a);
                }
                else {
                        $('#' + errorElementID).removeClass('d-none');
                        $.each(data.responseJSON.errors, function (key, value) {
                            $('#' + errorElementID).append(value[0]+'<br>');
                        });
                    }

            }
        });
    }

    function req(url, method='GET', callback,  data=null, errorElementID= 'null') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        });
        $.ajax({
            url: url,
            data: data,
            type: method,
            contentType: false,
            cache: false,
            processData: false,
            //dataType: 'json',
            success: function( data ) {
                callback(data);
            },
            error: function( data ) {
                //console.log(data);
                if (errorElementID === 'null') {
                    console.log(data);
                } else {
                    $('#' + errorElementID).removeClass('d-none');
                    $.each(data.responseJSON.errors, function (key, value) {
                        $('#' + errorElementID).append(value[0]+'<br>');
                    });
                }
            }
        });
    }

    function translit(str) {
        var space = '-';
        var link = '';
        var transl = {
            'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh',
            'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
            'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
            'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': '',
            'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu', 'я': 'ya'
        }
        if (str != '')
            str = str.toLowerCase();

        for (var i = 0; i < str.length; i++){
            if (/[а-яё]/.test(str.charAt(i))){ // заменяем символы на русском
                link += transl[str.charAt(i)];
            } else if (/[a-z0-9]/.test(str.charAt(i))){ // символы на анг. оставляем как есть
                link += str.charAt(i);
            } else {
                if (link.slice(-1) !== space) link += space; // прочие символы заменяем на space
            }
        }
        return link;
    };





    $(document).on('click', '#login_admin_btn', function (e) {

e.preventDefault();
let phone = $('#phone').val();
let password = $('#password').val();
let r=0;
if($('#remember'). prop("checked") == true){ r=1;}


    var form_data = new FormData();
    form_data.append('phone', phone);
    form_data.append('password', password);
    form_data.append('r', r);

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        }
    });
    $.ajax({
        url: '/admin/login',
        data: form_data,
        type: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'json',
        success: function( data ) {
            console.log(data);
            if (data.err == 0){
                location.href = '/admin'
            }
            else{
                $('#error').html(data.msg).removeClass('d-none');
            }

        },
        error: function( data ) {
            console.log(data);
        }
    });
});



$(document).on('click', '#ad_cat_btn', function () {
    let id = $(this).attr('data-id');
    ajaxReq('/admin/get-latest-element-cat/'+id, 'GET', (data)=>{
       // console.log(data);
        $('#sort_new').val(data);
    });
$('#add_category_modal').modal('show');
});

$(document).on('click', '#save_category', function (e) {
e.preventDefault();
let id = $(this).attr('data-id');
let title = $('#title_new').val();
let slug = $('#slug_new').val();
let sort = $('#sort_new').val();
let img = $('#image_new').prop('files')[0];
let descr = $('#descr_new').summernote("code");
    let form_data = new FormData();
    form_data.append('id', id);
    form_data.append('title', title);
    form_data.append('slug', slug);
    form_data.append('sort', sort);
    form_data.append('img', img);
    form_data.append('descr', descr);
    ajaxReq('/admin/create/category', 'POST', (data)=>{
        if (data.err != 0){
            $('#title_new').val('');
            $('#slug_new').val('');
            $('#image_new').val('');
            $('#descr_new').summernote("code", '');
            $('#error').removeClass('d-none').html(data.msg);
        }else{
            $('#title_new').val('');
            $('#slug_new').val('');
            $('#sort_new').val('');
            $('#image_new').val('');
            $('#descr_new').summernote("code", '');
            $('#table-adm').append(data.res);
            $('#add_category_modal').modal('hide');
        }
    }, form_data, 'error_pole' );
});





$(document).on('change', '#title_new', function () {
    $('#slug_new').val(translit($(this).val()));
});



$(document).on('click', '#delete_category', function () {
let id = $(this).attr('data-id');
ajaxReq('/admin/category/remove/'+id, 'GET', (data)=>{
    $('#cat_side_bar_'+id).remove();
    $('#table_item_adm_'+id).remove();

});
});

$(document).on('click', '#edit_category', function () {
let id = $(this).attr('data-id');
ajaxReq('/admin/category/edit/'+id, 'GET', (data)=>{
    $('#edit_category_modal_body').html(data);
    $('#edit_category_modal').modal('show');
});
});

    $(document).on('change', '#title_edit', function () {
        $('#slug_edit').val(translit($(this).val()));
    });

    $(document).on('click', '#save_edit_category', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let title = $('#title_edit').val();
        let slug = translit(title);
        let sort = $('#sort_edit').val();
        let img = $('#image_edit').prop('files')[0];
        let descr = $('#descr_edit').summernote("code");
        console.log(id);
        console.log(title);
        console.log(slug);
        console.log(sort);
        console.log(img);
        console.log(descr);
        let form_data = new FormData();
        form_data.append('id', id);
        form_data.append('title', title);
        form_data.append('slug', slug);
        form_data.append('sort', sort);
        form_data.append('img', img);
        form_data.append('descr', descr);

        ajaxReq('/admin/edit/category', 'POST', (data)=>{
            if (data.err != 0){
                $('#title_edit').val('');
                $('#slug_edit').val('');
                $('#image_edit').val('');
                $('#descr_edit').summernote("code", '');
                $('#error_edit').removeClass('d-none').html(data.msg);
            }else{
                $('#title_edit').val('');
                $('#slug_edit').val('');
                $('#sort_edit').val('');
                $('#image_edit').val('');
                $('#descr_edit').summernote("code", '');
                $('#table_item_adm_'+id).html(data.res);
                $('#edit_category_modal').modal('hide');
            }
        }, form_data, 'error_edit' );
    });


    $(document).on('click', '#show_category', function () {
let id = $(this).attr('data-id');
ajaxReq('/admin/category/'+id, 'GET', (data)=>{
    $('.content-body').html(data);
});
    });


    $(document).on('click', '#show_p_category', function () {
let id = $(this).attr('data-id');
ajaxReq('/admin/pod-category/'+id, 'GET', (data)=>{
    $('.content-body').html(data);
});
    });


$(document).on('click', '#show_product_category', function () {
let id = $(this).attr('data-id');
ajaxReq('/admin/category/'+id+'/products', 'GET', (data)=>{
    $('.content-body').html(data);
});
    });






$(document).on('click', '#ad_product_btn', function () {
$('#add_product_modal').modal('show');
});

var imageProduct = [];
$(document).on('click', '#upload_temp_btn', function (e) {
e.preventDefault();
    let file = $('#image_to_temp').prop('files')[0];
    let f = new FormData();
    f.append('file', file);
    ajaxReq('/admin/product/image-to-temp', 'POST',(data)=>{
        $('#images_product').append('<div class="col-3 mb-15">\n' +
            '                                                <img src="/public/temp/'+data+'" alt="">\n' +
            '                                            </div>');
        imageProduct.push(data);
    }, f)
});
$(document).on('click', '#upload_edit_temp_btn', function (e) {
e.preventDefault();
    let file = $('#image_to_edit_temp').prop('files')[0];
    let f = new FormData();
    f.append('file', file);
    ajaxReq('/admin/product/image-to-temp', 'POST',(data)=>{
        $('#images_product_edit').append('<div class="col-3 mb-15">\n' +
            '                                                <img src="/public/temp/'+data+'" alt="">\n' +
            '                                            </div>');
        imageProduct.push(data);
    }, f)
});

$(document).on('click', '#save_product', function () {
    let id = $(this).attr('data-id');
let title = $('#title_new').val();
let slug = $('#slug_new').val();
let articul = $('#articul_new').val();
let price = $('#price_new').val();
let phote = $('#photo_new').prop('files')[0];
let price_discount = $('#price_discount_new').val();
let quantity = $('#quantity_new').val();
let descr = $('#descr_new').summernote('code');
let instruction = $('#instruction_new').summernote('code');

let is_sale = ($('#is_sale_new').prop('checked')== true)? '1':'0';
let is_new = ($('#is_new_new').prop('checked')== true)? '1':'0';
let is_hot = ($('#is_hot_new').prop('checked')== true)? '1':'0';
price_discount = (is_sale == 0)? 0.00: price_discount;

let data = new FormData();
data.append('id', id);
data.append('title', title);
data.append('slug', slug);
data.append('articul', articul);
data.append('price', price);
data.append('phote', phote);
data.append('price_discount', price_discount);
data.append('quantity', quantity);
data.append('descr', descr);
data.append('instruction', instruction);
data.append('imageProduct', imageProduct.toString());
data.append('is_sale', is_sale);
data.append('is_new', is_new);
data.append('is_hot', is_hot);
data.append('recomendProducts', recomendProducts.toString());

ajaxReq('/admin/product/create', 'POST', (data)=>{
    //console.log(data);
    $('#table-adm').append(data.res);
    $('#add_product_modal').modal('hide');
    $('#title_new').val('');
    $('#slug_new').val('');
    $('#articul_new').val('');
    $('#price_new').val('');
    $('#photo_new').val('');
    $('#price_discount_new').val('');
    $('#quantity_new').val('');
    $('#descr_new').val('');
    $('#instruction_new').val('');
    imageProduct = [];

}, data)
});


$(document).on('click', '#delete_product', function (e) {
e.preventDefault();
let id = $(this).attr('data-id');
ajaxReq('/admin/product/remove/'+id, 'GET', (data)=>{
    $('#table_item_adm_'+id).remove();
});
});

$(document).on('click', '#edit_product', function (e) {
e.preventDefault();
let id = $(this).attr('data-id');
ajaxReq('/admin/product/edit/'+id, 'GET', (data)=>{
    $('#edit_product_modal_body').html(data);
    $('#edit_product_modal').modal('show');
});
});


    $(document).on('click', '#save_edit_product', function () {
        let id = $(this).attr('data-id');
        let title = $('#title_edit').val();
        let slug = $('#slug_edit').val();
        let articul = $('#articul_edit').val();
        let price = $('#price_edit').val();
        let phote = $('#photo_edit').prop('files')[0];
        let price_discount = $('#price_discount_edit').val();
        let quantity = $('#quantity_edit').val();
        let descr = $('#descr_edit').summernote('code');
        let instruction = $('#instruction_edit').summernote('code');

        let is_sale = ($('#is_sale_edit').prop('checked')== true)? '1':'0';
        let is_new = ($('#is_new_edit').prop('checked')== true)? '1':'0';
        let is_hot = ($('#is_hot_edit').prop('checked')== true)? '1':'0';
        price_discount = (is_sale == 0)? 0.00: price_discount;

        let data = new FormData();
        data.append('id', id);
        data.append('title', title);
        data.append('slug', slug);
        data.append('articul', articul);
        data.append('price', price);
        data.append('phote', phote);
        data.append('price_discount', price_discount);
        data.append('quantity', quantity);
        data.append('descr', descr);
        data.append('instruction', instruction);
        data.append('imageProduct', imageProduct.toString());
        data.append('is_sale', is_sale);
        data.append('is_new', is_new);
        data.append('is_hot', is_hot);
        data.append('recomendProducts', recomendProductsEdit.toString());

        ajaxReq('/admin/product/update', 'POST', (data)=>{
            //console.log(data);
            $('#table_item_adm_'+id).html(data.res);
            $('#edit_product_modal').modal('hide');
            $('#title_edit').val('');
            $('#slug_edit').val('');
            $('#articul_edit').val('');
            $('#price_edit').val('');
            $('#photo_edit').val('');
            $('#price_discount_edit').val('');
            $('#quantity_edit').val('');
            $('#descr_edit').val('');
            $('#instruction_edit').val('');
            imageProduct = [];

        }, data)
    });

$(document).on('click', '#delete_galery_item', function (e) {
e.preventDefault();
let id = $(this).attr('data-id');
ajaxReq('/admin/product-galery/delete/'+id, "GET", (data)=>{
    $('#galery_item_'+id).remove();
});
});




    //change active
    $(document).on("click", "#change_user_active", function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        ajaxReq('/admin/user/change-active/'+id, ...[,],(data)=>{
            //console.log(data);
            if(data == 0){
                $('#sts_'+id). prop("checked", false);
                $('#sts_text_'+id).html('Нет')
            }else{
                $('#sts_'+id). prop("checked", true);
                $('#sts_text_'+id).html('Да')
            }
        });
    });



    //change active
    $(document).on("click", "#change_slide_active", function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        ajaxReq('/admin/slide/change-active/'+id, ...[,],(data)=>{
            //console.log(data);
            if(data == 0){
                $('#sts_'+id). prop("checked", false);
                $('#sts_text_'+id).html('Нет')
            }else{
                $('#sts_'+id). prop("checked", true);
                $('#sts_text_'+id).html('Да')
            }
        });
    });





    $(document).on('click', '#ad_usr_btn', function (e) {
        e.preventDefault();
        $('#add_user_modal').modal('show');
    });



$(document).on('click', '#save_user', function (e) {
e.preventDefault();
let name = $('#name_new').val();
let role = $('#role_new').val();
let surname = $('#surname_new').val();
let phone = $('#phone_new').val();
let email = $('#email_new').val();
let password = $('#password_new').val();
let city = $('#city_new').val();
let address = $('#address_new').val();
let image = $('#image_new').prop('files')[0];
let fD = new FormData();
fD.append('role', role);
fD.append('name', name);
fD.append('surname', surname);
fD.append('phone', phone);
fD.append('email', email);
fD.append('password', password);
fD.append('city', city);
fD.append('address', address);
fD.append('image', image);
ajaxReq('/admin/users/create', 'POST', (data)=>{
    console.log(data);
    if(data.err == 1){
        $('#error_pole').removeClass('d-none').html(data.msg);
    }
    else if (data.err == 0){
        $('#table-adm').append(data.res);
        $('#name_new').val('');
        $('#role_new').val('');
        $('#surname_new').val('');
        $('#phone_new').val('');
        $('#email_new').val('');
        $('#password_new').val('');
        $('#city_new').val('');
        $('#address_new').val('');
        $('#image_new').val('');
        $('#add_user_modal').modal('hide');
    }
},fD, 'error_pole');
});


    $(document).on('click', '#delete_user', function (e) {
        e.preventDefault();
        let id= $(this).attr('data-id');
        ajaxReq('/admin/users/delete/'+id, ...[,], (data)=>{
            $('#table_item_adm_'+id).remove();
        });
    });


$(document).on('click', '#edit_user', function (e) {
    e.preventDefault();
    let id = $(this).attr('data-id');
    ajaxReq('/admin/user/edit/'+id, ...[,], (data)=>{
        $('#edit_user_modal_body').html(data);
        $('#edit_user_modal').modal('show');
    });
});



    $(document).on('click', '#save_edit_user', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        let name = $('#name_edit').val();
        let role = $('#role_edit').val();
        let surname = $('#surname_edit').val();
        let phone = $('#phone_edit').val();
        let email = $('#email_edit').val();
        let password = $('#password_edit').val();
        let city = $('#city_edit').val();
        let address = $('#address_edit').val();
        let image = $('#image_edit').prop('files')[0];
        let fD = new FormData();
        fD.append('id', id);
        fD.append('role', role);
        fD.append('name', name);
        fD.append('surname', surname);
        fD.append('phone', phone);
        fD.append('email', email);
        fD.append('password', password);
        fD.append('city', city);
        fD.append('address', address);
        fD.append('image', image);
        ajaxReq('/admin/users/update', 'POST', (data)=>{
            console.log(data);
            if(data.err == 1){
                $('#error-edit_pole').removeClass('d-none').html(data.msg);
            }
            else if (data.err == 0){
                $('#table_item_adm_'+id).html(data.res);
                $('#name_edit').val('');
                $('#role_edit').val('');
                $('#surname_edit').val('');
                $('#phone_edit').val('');
                $('#email_edit').val('');
                $('#password_edit').val('');
                $('#city_edit').val('');
                $('#address_edit').val('');
                $('#image_edit').val('');
                $('#edit_user_modal').modal('hide');
            }
        },fD, 'error-edit_pole');
    });

$(document).on('click', '#edit_site_property', function (e) {
e.preventDefault();
$('#site_name').prop('readonly', false);
$('#telegram_link').prop('readonly', false);
$('#youtube_link').prop('readonly', false);
$('#instagram_link').prop('readonly', false);
$('#fb_link').prop('readonly', false);
$('#email').prop('readonly', false);
$('#phone_two').prop('readonly', false);
$('#phone_one').prop('readonly', false);
$('#address').prop('readonly', false);
$('#edit_site_property').toggleClass('d-none');
$('#save_site_property').toggleClass('d-none');

});

$(document).on('click', '#save_site_property', function (e) {
e.preventDefault();
let fd = new FormData();
    fd.append('site_name', $('#site_name').val());
    fd.append('telegram_link', $('#telegram_link').val());
    fd.append('youtube_link', $('#youtube_link').val());
    fd.append('instagram_link', $('#instagram_link').val());
    fd.append('fb_link', $('#fb_link').val());
    fd.append('email', $('#email').val());
    fd.append('phone_two', $('#phone_two').val());
    fd.append('phone_one', $('#phone_one').val());
    fd.append('address', $('#address').val());

    ajaxReq('/admin/site-property/update', 'POST', (data)=>{
        showToast('Сохранено');
        $('#site_name').prop('readonly', true);
        $('#telegram_link').prop('readonly', true);
        $('#youtube_link').prop('readonly', true);
        $('#instagram_link').prop('readonly', true);
        $('#fb_link').prop('readonly', true);
        $('#email').prop('readonly', true);
        $('#phone_two').prop('readonly', true);
        $('#phone_one').prop('readonly', true);
        $('#address').prop('readonly', true);
        $('#edit_site_property').toggleClass('d-none');
        $('#save_site_property').toggleClass('d-none');

    }, fd);


});

var recomendProducts = [];
var recomendProductsEdit = [];
$(document).on('click', '#r_prod_btn', function (e) {
e.preventDefault();
    let id = $('#rec_prod_select').val();
    $('#rec_prod_select').val('');
    req('/add-recomend-product/'+id, ...[,], (data)=>{
        //console.log(data);
        $('#recomendes_product').append(data);
        recomendProducts.push(id);
    });
});

$(document).on('click', '#r_prod_btn-edit', function (e) {
e.preventDefault();
    let id = $('#rec_prod_select-edit').val();
    $('#rec_prod_select-edit').val('');
    req('/add-recomend-product-save/'+id +'/'+ $(this).attr('data-id') , ...[,], (data)=>{
        //console.log(data);
        $('#recomendes_product-edit').append(data);
        recomendProductsEdit.push(id);
    });
});

$(document).on('click', '#delete_item_prod_rec_new', function (e) {
e.preventDefault();
let id = $(this).attr('data-id');

$('#item_r_prod_'+id).remove();
    const i = recomendProducts.indexOf(id);
    if (i > -1) {
        recomendProducts.splice(i, 1);
    }
   // console.log(recomendProducts);


});
$(document).on('click', '#delete_item_prod_rec_edit', function (e) {
e.preventDefault();
let rID = $(this).attr('data-id');
let pID = $('#recomendes_product-edit').attr('data-id');

    const i = recomendProductsEdit.indexOf(rID);
    if (i > -1) {
        recomendProductsEdit.splice(i, 1);
    }
   // console.log(recomendProducts);
    req('/delete-recomend-prod/'+rID+'/'+pID,...[,], (data)=>{
        $('#item_r_prod_'+rID).remove();
    });


});

$(document).on('click', '#save_delivery_property', function (e) {
e.preventDefault();
let form_data = new FormData();
form_data.append('city', $('#city').val());
form_data.append('nocity', $('#nocity').val());

req('/admin/delivery-change', "POST", (data)=>{

    //console.log(data);
    $('#succes').toggleClass('d-none').html('Успешно сохранен !!!');
    setTimeout(function () {
        $('#succes').fadeOut(500).toggleClass('d-none');
    }, 2500);
},form_data);
});


$(document).on('click', '#load_more_products', function (e) {
e.preventDefault();
let cid = $(this).attr('data-id');
let page = $(this).attr('data-page');

$(this).prop('disabled', true).html('<span class="spinner-border spinner-sm d-inline-block mr-5"></span>Загружаеться ...');

let formData = new FormData();
formData.append('cid', cid);
formData.append('page', page);
req('/admin/products/load-more', 'POST', (data)=>{
    //console.log(data);
    if(data.info.qnt == 0){
      $('.load-more-products').remove();
    }
    else{
        $('#table-adm').append(data.html);
        page++;
        $('#load_more_products').prop('disabled', false).html('Загрузить ещё').attr('data-page', page);

    }
},formData);

});

$(document).on('click', '#save_catHome', function (e) {
e.preventDefault();
let one = $('#one').val();
let two = $('#two').val();

let formData = new FormData();
formData.append('one', one);
formData.append('two', two);
req('/admin/home-cats-update', 'POST', (data)=>{
    //console.log(data);
    $('#succes').toggleClass('d-none').html('Успешно сохранен !!!');
    setTimeout(function () {
        $('#succes').fadeOut(500).toggleClass('d-none');
    }, 2500);
}, formData, 'error');
});


var orderStatuses = {
    '1':'<span class="badge badge-round badge-danger">Новый заказ</span>',
    '2':'<span class="badge badge-round badge-primary">Обработан</span>',
    '3':'<span class="badge badge-round badge-warning">Отказ</span>',
    '4':'<span class="badge badge-round badge-success">Доставлен</span>',
}

$(document).on('click', '#change_status_order', function () {
    let sts = $(this).attr('data-sts');
    $('#save_sts_order').attr('data-id', $(this).attr('data-id')).attr('data-sts', sts);
    $('#current_sts').html(orderStatuses[sts]);
    jQuery("#new_sts_order option:selected").removeAttr("selected");
    jQuery("#new_sts_order option[value='"+sts +"']").attr('selected', 'selected');

    $('#change_sts_order_modal').modal('show');
});

$(document).on('click', '#save_sts_order', function (e) {
e.preventDefault();
let id = $(this).attr('data-id');
let sts = $('#new_sts_order').val();
    console.log(id);
    console.log(sts);

if(sts=>1 && sts<=4){
    let formData = new FormData();
    formData.append('id', id);
    formData.append('sts', sts);
    req('/admin/order-change-status', "POST", (data)=>{
        //console.log(data);
        $('.order-status-'+id).html(orderStatuses[data]);
        $('#change_sts_order_modal').modal('hide');

    }, formData);
}
})

































































































































































































































































































            var i = -1;
            var toastCount = 0;
            var $toastlast;

            var getMessage = function () {
                var msgs = [
                    'Have fun storming the castle!'
                ];
                i++;
                if (i === msgs.length) {
                    i = 0;
                }

                return msgs[i];
            };


            $('#closeButton').click(function() {
                if($(this).is(':checked')) {
                    $('#addBehaviorOnToastCloseClick').prop('disabled', false);
                } else {
                    $('#addBehaviorOnToastCloseClick').prop('disabled', true);
                    $('#addBehaviorOnToastCloseClick').prop('checked', false);
                }
            });

function showToast(msg) {

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "rtl": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": 300,
                    "hideDuration": 1000,
                    "timeOut": 5000,
                    "extendedTimeOut": 100,
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                if ($('#addBehaviorOnToastClick').prop('checked')) {
                    toastr.options.onclick = function () {
                        alert('You can perform some custom action after a toast goes away');
                    };
                }

                if ($('#addBehaviorOnToastCloseClick').prop('checked')) {
                    toastr.options.onCloseClick = function () {
                        alert('You can perform some custom action when the close button is clicked');
                    };
                }

                //var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                var $toast = toastr["success"](msg); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;

                if(typeof $toast === 'undefined'){
                    return;
                }

                if ($toast.find('#okBtn').length) {
                    $toast.delegate('#okBtn', 'click', function () {
                        alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
                        $toast.remove();
                    });
                }
                if ($toast.find('#surpriseBtn').length) {
                    $toast.delegate('#surpriseBtn', 'click', function () {
                        alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
                    });
                }
                if ($toast.find('.clear').length) {
                    $toast.delegate('.clear', 'click', function () {
                        toastr.clear($toast, { force: true });
                    });
                }
            }

            function getLastToast(){
                return $toastlast;
            }
            $('#clearlasttoast').click(function () {
                toastr.clear(getLastToast());
            });
            $('#cleartoasts').click(function () {
                toastr.clear();
            });











})(jQuery);
