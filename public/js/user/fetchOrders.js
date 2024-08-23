$(document).ready(function(){
    fetchOrders();
    
    function fetchOrders(){
        $.ajax({
            type: 'get',
            url: '/fetchOrders',
            success: function(response){
                console.log(response.orders);
            }
        })
    }
})