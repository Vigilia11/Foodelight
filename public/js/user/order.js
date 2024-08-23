$(document).ready(function(){
    
    fetchOrders();
    
    
});

const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

function fetchOrders(){

    $.ajax({
        type: 'get',
        url: '/fetchOrders',
        beforeSend: function(){
            $('#orders').html('');
        },
        success: function(response){

            var date;
            var strmonth;
            var day;
            var year;
            $.each(response.orders, function(key, order){
                
                date = new Date(order.date);
                strmonth = month[date.getMonth()];
                strdate = date.toDateString();
                
                //date = order.date;
                $('#orders').append('\
                    <div class="bg-gray-100 p-5 relative overflow-hidden order">\
                        <h6 class="text-gray-600 font-medium">'+strdate+'</h6>\
                        <h6 class="text-gray-600 text-sm font-medium">Total Quantity: '+order.totalQuantity+'</h6>\
                        <h6 class="text-lime-600 text-sm font-medium ">Total Price: ₱'+order.totalPrice+'</h6>\
                        <h6 class="text-gray-600 text-sm font-medium">Status: '+order.status+'</h6>\
                        <div class="absolute order-button-container top-0 left-0 w-full h-full" >\
                            <div class="h-full w-full flex items-center justify-center">\
                                <div>\
                                    <a href="/orderItems/'+order.id+'" class="bg-lime-600 hover:bg-lime-700 text-white rounded px-4 py-1 text-sm">View</a>\
                                    <button type="button" id="btn-delete-'+order.id+'" class="bg-red-600 hover:bg-red-700 text-white rounded px-4 py-1 text-sm" onclick="showDeleteOrderModal('+order.id+')">Delete</button>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                ');

                if(order.status == "Canceled" || order.status == "Ready" || order.status == "Shipping" || order.status == "Noticed")
                {
                    $('#btn-delete-'+order.id).addClass("hidden");
                }
                
            })
            
        }
    })
}

var order_id;
function showDeleteOrderModal(order_id){

    $('#btn-yes-modal-delete-order').val(order_id);
    $('#btn-show-delete-order-modal').click();
    
}

function deleteOrder(){
    
    var id = $('#btn-yes-modal-delete-order').val();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'delete',
        url: '/deleteOrder/' + id,
        success: function(response){
            $('#btn-show-delete-order-modal').click();
            
            $('#toast').find('div.toast-message').text(response.message);
            $('#toast').show().delay(7000).fadeOut();

            fetchOrders();
        }
    })
}

