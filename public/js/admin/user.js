$(document).ready(function(){

    fetchUser();
/*
    $(form_block_user).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_block_user).attr('method'),
            url: $(form_block_user).attr('action'),
            data: new FormData(form_block_user),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    console.log(response.errors);
                }
                else{
                    fetchUser();
                    $('#btn-close-modal-block-user').click();
                    $('div.toast-message').text(response.message);
                    $('#toast-order').show().delay(7000).fadeOut();
                }
                
            }
        })
    })
    */
});

function fetchUser(){

    var user_id = $('input.user_id').val();

    $.ajax({
        type: 'get',
        url: '/fetchUser/' + user_id,
        beforeSend: function(){
            $('button.btn-block-account').hide();
            $('button.btn-set-active').hide();
        },
        success: function(response){
            
            $.each(response.user, function(key, data){
                $('img.profile-photo').attr('src', '/images/profile/'+data.photo);
                $('h6.name').text(data.first_name + " " + data.last_name);
                $('h6.email').text(data.email);
                $('h6.mobile-number').text(data.mobile_number);
                $('h6.street-barangay').text(data.street + " " + data.barangay);
                $('h6.city-province').text(data.city + ", " + data.province);
                $('h6.account-status').text(data.account_status);

                if(data.account_status == "Active")
                {
                    $('button.btn-block-account').show();
                }
                if(data.account_status == "Blocked")
                {
                    $('button.btn-set-active').show();
                }
            });

            var totalOrder = 0;
            var totalOrderItem = 0;
            var totalPrice = 0;
            $.each(response.order, function(key, order){
                if(order.totalOrder != null)
                {
                    totalOrder = order.totalOrder;
                }
                if(order.totalOrderItem != null)
                {
                    totalOrderItem = order.totalOrderItem;
                }
                if(order.totalPrice != null)
                {
                    totalPrice = order.totalPrice;
                }
                $('h6.total-order').text(totalOrder);
                $('h6.total-order-item').text(totalOrderItem);
                $('h6.spent').text("₱"+totalPrice);
            })
        }
    })
}

function blockUser(){
    var user_id = $('input.user_id').val();

    $.ajax({
        type: 'get',
        url: '/blockUser/'+user_id,
        //processData: false,
        //contentType: false,
        success: function(response){
            fetchUser();
            $('#btn-close-modal-block-user').click();
            $('div.toast-message').text(response.message);
            $('#toast-order').show().delay(7000).fadeOut();
            $('button.btn-block-account').hide();
        }
    })
}

function setUserActive(){
    var user_id = $('input.user_id').val();

    $.ajax({
        type: 'get',
        url: '/setUserActive/'+user_id,
        //processData: false,
        //contentType: false,
        success: function(response){
            fetchUser();
            $('div.toast-message').text(response.message);
            $('#toast-order').show().delay(7000).fadeOut();
        }
    })
}
