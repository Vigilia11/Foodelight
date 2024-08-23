$(document).ready(function(){
    
    fetchCarts();
    
});

function fetchCarts(){

    $.ajax({
        type: 'get',
        url: '/fetchCarts',
        beforeSend: function(){
            $('#carts').html('');
        },
        success: function(response){

            var date;
            var strmonth;
            var strdate;
            $.each(response.carts, function(key, cart){
                
                date = new Date(cart.date);
                strdate = date.toDateString();
                //date = order.date;
                $('#carts').append('\
                    <div class="bg-gray-100 p-5 relative overflow-hidden cart">\
                        <h6 class="text-gray-600 font-medium">\
                        '+strdate+'\
                        </h6>\
                        <h6 class="text-gray-600 text-sm font-medium">Total Quantity: '+cart.totalQuantity+'</h6>\
                        <h6 class="text-lime-600 text-sm font-medium ">Total Price: ₱'+cart.totalPrice+'</h6>\
                        <div class="absolute cart-button-container top-0 left-0 w-full h-full" >\
                            <div class="h-full w-full flex items-center justify-center">\
                                <div>\
                                    <a href="/cart/items/'+cart.date+'" class="bg-lime-600 hover:bg-lime-700 text-white rounded px-4 py-1 text-sm">View</a>\
                                    <button type="button" value="'+cart.date+'" class="bg-red-600 hover:bg-red-700 text-white rounded px-4 py-1 text-sm" onclick="showDeleteCartModal()">Delete</button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                ');    
                
            })
            
        }
    })
}

var date;
function showDeleteCartModal(date){
    alert(date)
    $('#btn-yes-modal-delete-cart').val(date);
    $('#btn-show-delete-cart-modal').click();
    
}

function deleteCart(){
    
    var id = $('#btn-yes-modal-delete-cart').val();

    alert(id)
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'delete',
        url: '/deleteCart/' + id,
        success: function(response){
            $('#btn-show-delete-order-modal').click();
            
            $('#toast').find('div.toast-message').text(response.message);
            $('#toast').show().delay(7000).fadeOut();

            fetchCarts();
        }
    })
}

