$(document).ready(function(){

    fetchOrderItems();    

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
                    fetchOrderItems();
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
                    fetchOrderItems();
                    $('#form_edit_drink').find('span.error').text('');
                    $('#btn-close-edit-drink-modal').click();
                    $('#toast').find('div.toast-message').text(response.message);
                    $('#toast').show().delay(7000).fadeOut();
                    
                }
            }
        })
    })

    $(form_send_message).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_send_message).attr('method'),
            url: $(form_send_message).attr('action'),
            data: new FormData(form_send_message),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){

                if(response.status == 404){
                    $.each(response.errors, function(name, error){
                        $('#form_send_message').find('span.'+name+'-error').text(error);
                    });
                }
                else{
                    $('#form_send_message').find('#message').val('');
                    $('#form_send_message').find('span.error').text('');
                    fetchMessages();
                    
                }
            }
        })
    })
});

function fetchOrderItems(){
    
    var order_id = $('#order_id').val();    
    
    $.ajax({
        type: 'get',
        url: '/fetchOrderItems/'+order_id,
        beforeSend: function(){
            $('#orderItems').html('');
        },
        success: function(response){            

            var totalPrice = 0;
            var d;
            var strdate;
            var order_status;
            $.each(response.orders, function(key,order){

                d = new Date(order.date);
                strdate = d.toDateString();
                order_status = order.status;
                if(order.date != response.currentDate)
                {
                    //$('#form-order').hide();
                    //$('#dateMessage').show();
                }
                totalPrice = totalPrice + parseInt(order.price);

                $('#orderItems').append('\
                    <div  class="dish mb-5">\
                        <div class="bg-gray-200 h-40 relative overflow-hidden">\
                            <img src="/images/dishes/'+ order.image +'" alt="" class="w-full h-full">\
                            <div class="absolute bottom-0 left-0 w-full button-container">\
                                <div class="grid grid-cols-2 py-1 bg-white">\
                                    <div class="flex justify-center gap-3 items-center">\
                                        <button type="button" class="text-lime-600 hover:text-lime-800" onclick="showEditModal('+ order.id +');">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />\
                                            </svg>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        <button type="button" class=" text-red-600 hover:text-red-800" onclick="showDeleteModal('+ order.id +');">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />\
                                            </svg>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="leading-5 py-1">\
                            <h6 class="text-black font-medium text-center">'+ order.dish +'</h6>\
                            <h6 class="text-gray-600 text-sm font-medium text-center size-'+ order.id +'"></h6>\
                            <h6 class="text-gray-600 text-sm font-medium text-center">Qty: '+ order.quantity +'</h6>\
                            <h6 class="text-gray-600 text-sm font-medium text-center">Price: <span class="text-lime-600">₱'+ order.price +'</span></h6>\
                        </div>\
                    </div>\
                ');
                
                if(order.size_id != null)
                {
                    $('h6.size-'+ order.id).text('Size: '+ order.size);
                }
            })
            $('h6.totalPrice').text("Total Price: ₱" + totalPrice);
            $('h6.order-status').text("Order Status: " + order_status);
            $('h6.orderDate').text(strdate);

            if(order_status != "Unnoticed")
            {
                $('div.button-container').hide();
            }
        }
    })
}

var id;

function showDeleteModal(order_id){
    $('#btn-show-delete-modal').click();
    
    $.ajax({
        type: 'get',
        url: '/fetchCartItem/'+ order_id,
        beforeSend: function(){
            $('h6.modal-delete-message').text('');
            $('#btn-delete-modal').val('');
        },
        success: function(response){
            $.each(response.order, function(key, item){
                $('h6.modal-delete-message').text("Are your sure you want to delete " + item.dish + " from your cart?");
                $('#btn-delete-modal').val(item.id);
            });
        }
    })
}

function showEditModal(id){

    $.ajax({
        type: 'get',
        url: '/fetchOrderItem/'+ id,
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
            
            $.each(response.order, function(key, item){

                if(item.category == "Meal" || item.category == "Bread" || item.category == "Cake")
                {
                    $('#btn-show-edit-modal').click();
                    $('#dish_name').text(item.dish);
                    $('#form_edit_dish').find('#dish_id').val(item.dish_id);
                    $('#form_edit_dish').find('#order_item_id').val(item.id);
                }else{
                    $('#btn-show-edit-drink-modal').click();
                    $('#drink_name').text(item.dish);
                    $('#form_edit_drink').find('#size_id').val(item.size_id);
                    $('#form_edit_drink').find('#order_item_id').val(item.id);

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

function showDeleteModal(id){
    $('#btn-show-delete-modal').click();
    
    $.ajax({
        type: 'get',
        url: '/fetchOrderItem/'+ id,
        beforeSend: function(){
            $('h6.modal-delete-message').text('');
            $('#btn-delete-modal').val('');
        },
        success: function(response){
            $.each(response.order, function(key, item){
                $('h6.modal-delete-message').text("Are your sure you want to delete " + item.dish + " from your order?");
                $('#btn-delete-modal').val(item.id);
            });
        }
    })
}

function deleteCartItem(){
    var id = $('#btn-delete-modal').val();    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'delete',
        url: '/deleteOrderItem/'+id,
        success: function(response){

            $('#btn-close-delete-modal').click();
            $('#toast').find('div.toast-message').text(response.message);
            $('#toast').show().delay(7000).fadeOut();
            fetchOrderItems();
        }
    });
}

function cancelOrder()
{
    var id = $('#btn_cancel_order').val();    
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'put',
        url: '/cancelOrder/'+id,
        success: function(response){

            $('#toast').find('div.toast-message').text(response.message);
            $('#toast').show().delay(7000).fadeOut();
            fetchOrderItems();
        }
    });
}

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}

function fetchMessages(){
    var order_id = $('#form_send_message').find('#order_id').val();
    
    $.ajax({
        type: 'get',
        url: '/fetchMessages/' + order_id,
        //beforeSend: function(){ $('div.messages').html(''); },
        success: function(response){
            //console.log(response.messages)
            if(response.orderDate == response.currentDate)
            {
                $('#message-bottom').show()
            }
            if(response.orderDate == response.currentDate && response.orderStatus != "Received")
            {
                $('#message-bottom').show()
            }
            
            $('div.messages').html('');
            
            var justify ="";
            var text ="";
            var imageLeft ="";
            var imageRight ="";
            $.each(response.messages, function(key, message){
                if(message.user_id === response.user)
                {
                    justify = "justify-end";
                    text = "text-end";
                    imageRight = '<img class="w-8 h-8 rounded-full" src="/images/profile/'+ message.photo +'" alt=""></img>'
                }
                else{
                    imageLeft = '<img class="w-8 h-8 rounded-full" src="/images/profile/'+ message.photo +'" alt=""></img>'
                }
                $('div.messages').append('\
                    <div class="flex items-start gap-2.5 '+ justify +'">\
                        '+ imageLeft +'\
                        <div class="flex flex-col w-full max-w-[320px] leading-1.5">\
                            <div class="flex items-center space-x-2 rtl:space-x-reverse '+ justify +'">\
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">'+ message.first_name +' '+ message.last_name +'</span>\
                            </div>\
                            <p class="text-sm font-normal p-2 text-gray-900 dark:text-white bg-gray-100 '+ text +'">'+ message.message +'</p>\
                            <div class="space-x-5 '+ text +'">\
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">'+ message.status +'</span>\
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">'+ message.created_at +'</span>\
                            </div>\
                        </div>\
                        '+ imageRight +'\
                    </div>\
                ');

                justify ="";
                text ="";
                imageLeft ="";
                imageRight ="";

            });
        }
    })
}

function showMessage(){
    fetchMessages();
    $('#btn-show-modal-message').click();
}