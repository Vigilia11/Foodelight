$(document).ready(function(){

    fetchOrderItems();

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
    
    var order_id = $('#btn_deliver').val();    
    
    $.ajax({
        type: 'get',
        url: '/fetchOrderItems/'+order_id,
        beforeSend: function(){
            $('#orderItems').html('');
        },
        success: function(response){            
            
            $.each(response.order, function(key, order){
                if(order.method == "Pickup")
                {
                    $('#form_status_ready').show();
                }
                if(order.method == "Shipping")
                {
                    $('#form_status_deliver').show();
                }
                if(order.status == "Recieved")
                {
                    $('#order_status').hide();
                }
                if(order.status == "Ready" || order.status == "Shipping")
                {
                    $('#form_status_ready').hide();
                    $('#form_status_deliver').hide();
                    $('#form_status_recieved').show();
                }
            })
            var totalPrice = 0;
            var d;
            var strdate;
            var order_status;
            $.each(response.orders, function(key,order){

                d = new Date(order.date);
                strdate = d.toDateString();
                order_status = order.status;
                
                totalPrice = totalPrice + parseInt(order.price);

                $('#orderItems').append('\
                    <div  class="dish mb-5">\
                        <div class="bg-gray-200 h-40 relative overflow-hidden">\
                            <img src="/images/dishes/'+ order.image +'" alt="" class="w-full h-full">\
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


        }
    })


}

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}
//$('#form_send_message').hide();
function fetchMessages(){
    var order_id = $('#form_send_message').find('#order_id').val();
    
    $.ajax({
        type: 'get',
        url: '/fetchMessages/' + order_id,
        //beforeSend: function(){ $('div.messages').html(''); },
        success: function(response){
            //console.log(response.orderStatus)
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
                console.log(message.order_date);
            
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