$(document).ready(function(){
    
    fetchCartItems();

    $(form_edit_dish).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_edit_dish).attr('method'),
            url: $(form_edit_dish).attr('action'),
            data: new FormData(form_edit_dish),
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function(){
                $('#toast').find('div.toast-message').text('');
            },
            success: function(response){
                if(response.status == 404){
                    $.each(response.errors, function(name, error){
                        $('#form_edit_dish').find('span.'+name+'-error').text(error);
                    });
                }
                else{
                    fetchCartItems();
                    $('#form_edit_dish').find('span.error').text('');
                    $('#btn-close-edit-modal').click();
                    $('#toast').find('div.toast-message').text(response.message);
                    $('#toast').show().delay(7000).fadeOut();
                    
                }
            }
        })
    })

    $(form_edit_drink).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_edit_drink).attr('method'),
            url: $(form_edit_drink).attr('action'),
            data: new FormData(form_edit_drink),
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function(){
                $('#toast').find('div.toast-message').text('');
            },
            success: function(response){
                if(response.status == 404){
                    $.each(response.errors, function(name, error){
                        $('#form_edit_drink').find('span.'+name+'-error').text(error);
                    });
                }
                else{
                    fetchCartItems();
                    $('#form_edit_drink').find('span.error').text('');
                    $('#btn-close-edit-drink-modal').click();
                    $('#toast').find('div.toast-message').text(response.message);
                    $('#toast').show().delay(7000).fadeOut();
                    
                }
            }
        })
    })
})

function fetchCartItems(){
    var date = $('#cartDate').val();
    var d = new Date(date);
    var strdate = d.toDateString();
    $('#totalPrice').text(date);
    //$('h6.cartDate').text(date);
    $('h6.cartDate').text(strdate);
    $.ajax({
        type: 'get',
        url: '/fetchCartItems/'+date,
        beforeSend: function(){
            $('#cartItems').html('');
        },
        success: function(response){            

            var totalPrice = 0;
            $.each(response.carts, function(key, cart){

                if(cart.date != response.currentDate)
                {
                    $('#form-order').hide();
                    $('#dateMessage').show();
                }
                totalPrice = totalPrice + parseInt(cart.price);

                $('#cartItems').append('\
                    <div  class="dish mb-5">\
                        <div class="bg-gray-200 h-40 relative overflow-hidden">\
                            <img src="/images/dishes/'+ cart.image +'" alt="" class="w-full h-full">\
                            <div class="absolute bottom-0 left-0 w-full button-container">\
                                <div class="grid grid-cols-2 py-1 bg-white">\
                                    <div class="flex justify-center gap-3 items-center">\
                                        <button type="button" class="text-lime-600 hover:text-lime-800" onclick="showEditModal('+ cart.id +');">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />\
                                            </svg>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        <button type="button" class=" text-red-600 hover:text-red-800" onclick="showDeleteModal('+ cart.id +');">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />\
                                            </svg>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="leading-5 py-1">\
                            <h6 class="text-black font-medium text-center">'+ cart.dish +'</h6>\
                            <h6 class="text-gray-600 text-sm font-medium text-center size-'+ cart.id +'"></h6>\
                            <h6 class="text-gray-600 text-sm font-medium text-center">Qty: '+ cart.quantity +'</h6>\
                            <h6 class="text-gray-600 text-sm font-medium text-center">Price: <span class="text-lime-600">₱'+ cart.price +'</span></h6>\
                        </div>\
                    </div>\
                ');
                if(cart.size_id != null)
                {
                    $('h6.size-'+ cart.id).text('Size: '+ cart.size);
                }
            })
            $('h6.totalPrice').text("Total Price: ₱" + totalPrice);
        }
    })
}

var cart_id;

function showDeleteModal(cart_id){
    $('#btn-show-delete-modal').click();
    
    $.ajax({
        type: 'get',
        url: '/fetchCartItem/'+ cart_id,
        beforeSend: function(){
            $('h6.modal-delete-message').text('');
            $('#btn-delete-modal').val('');
        },
        success: function(response){
            $.each(response.cart, function(key, item){
                $('h6.modal-delete-message').text("Are your sure you want to delete " + item.dish + " from your cart?");
                $('#btn-delete-modal').val(item.id);
            });
        }
    })
}

function showEditModal(cart_id){

    $.ajax({
        type: 'get',
        url: '/fetchCartItem/'+ cart_id,
        beforeSend: function(){
            $('#dish_name').text('');
            $('#form_edit_dish').find('#dish_id').val('');
            $('#form_edit_dish').find('#quantity').val('');
            $('#form_edit_dish').find('#price').val('');
            $('#drink_name').text('');
            $('#form_edit_drink').find('#size').html('');
            $('#form_edit_drink').find('#quantity').val('');
            $('#form_edit_drink').find('#price').val('');
        },
        success: function(response){
            
            $.each(response.cart, function(key, item){

                if(item.category == "Meal" || item.category == "Bread" || item.category == "Cake")
                {
                    $('#btn-show-edit-modal').click();
                    $('#dish_name').text(item.dish);
                    $('#form_edit_dish').find('#dish_id').val(item.dish_id);
                    $('#form_edit_dish').find('#cart_id').val(item.id);
                }else{
                    $('#btn-show-edit-drink-modal').click();
                    $('#drink_name').text(item.dish);
                    $('#form_edit_drink').find('#size_id').val(item.size_id);
                    $('#form_edit_drink').find('#cart_id').val(item.id);

                    $.each(response.sizes, function(key, size){
                        $('#form_edit_drink').find('#size').append('\
                            <option value="'+ size.id +'">'+size.size+'</option>\
                        ');
                    })
                }
                
            })
        }
    })
}

function dishPrice(){

    var dish_id = $('#form_edit_dish').find('#dish_id').val();
    var quantity = $('#form_edit_dish').find('#quantity').val();

    $.ajax({
        type: 'get',
        url: '/fetchDishPrice/'+dish_id,
        beforeSend: function(){
            $('#form_edit_dish').find('#price').val('');
        },
        success: function(response){
            //console.log(response.dish);

            var price;

            $.each(response.dish, function(key,item){
                price = quantity * item.price;
                if(price > 0){
                    $('#form_edit_dish').find('#price').val(price);
                }else{
                    $('#form_edit_dish').find('#price').val('');
                }
            })
        }
    });
}

function drinkPrice(){

    size_id = $('#form_edit_drink').find('#size').val();
    quantity = $('#form_edit_drink').find('#quantity').val();
    //alert(size_id)
    $.ajax({
        type: 'get',
        url: '/fetchDrinkPrice/'+size_id,
        beforeSend: function(){
            $('#form_edit_drink').find('#dish_name').text('');
            $('#form_edit_drink').find('#price').val('');
        },
        success: function(response){
            //console.log(size_id);

            var price;

            $.each(response.dish, function(key,item){
                price = quantity * item.price;
                if(price > 0){
                    $('#form_edit_drink').find('#price').val(price);
                }else{
                    $('#form_edit_drink').find('#price').val('');
                }
                
            })
        }
    });
}

function deleteCartItem(){
    var cart_id = $('#btn-delete-modal').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'delete',
        url: '/deleteCartItem/'+cart_id,
        success: function(response){

            $('#btn-close-delete-modal').click();
            $('#toast').find('div.toast-message').text(response.message);
            $('#toast').show().delay(7000).fadeOut();
            fetchCartItems();
        }
    });
}