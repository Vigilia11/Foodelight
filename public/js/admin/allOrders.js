$(document).ready(function(){
    fetchAllUnnoticedOrders();
});

function fetchAllUnnoticedOrders()
{
    $.ajax({
        type: 'get',
        url: '/fetchAllUnnoticedOrders',
        beforeSend: function(){
            $('tbody.orders').html('');
        },
        success: function(response){
            var i = 1;
            $.each(response.orders, function(key, order){
                $('tbody.orders').append('\
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">\
                        <th scope="row" class="px-6 pys-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">\
                        '+i+'\
                        </th>\
                        <td class="px-6 py-4">\
                            '+ order.first_name +' '+ order.last_name +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.date +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.status +'\
                        </td>\
                        <td class="px-6 py-4 text-right">\
                            <a href="/order/'+ order.id +'" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">view</a>\
                        </td>\
                    </tr>\
                ');
                i++;
            })
        }
    })
}

function fetchAllNoticedOrders()
{
    $.ajax({
        type: 'get',
        url: '/fetchAllNoticedOrders',
        beforeSend: function(){
            $('tbody.orders').html('');
        },
        success: function(response){
            var i = 1;
            $.each(response.orders, function(key, order){
                $('tbody.orders').append('\
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">\
                        <th scope="row" class="px-6 pys-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">\
                        '+i+'\
                        </th>\
                        <td class="px-6 py-4">\
                            '+ order.first_name +' '+ order.last_name +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.date +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.status +'\
                        </td>\
                        <td class="px-6 py-4 text-right">\
                            <a href="/order/'+ order.id +'" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">view</a>\
                        </td>\
                    </tr>\
                ');
                i++;
            })
        }
    })
}

function fetchAllReadyOrders()
{
    $.ajax({
        type: 'get',
        url: '/fetchAllReadyOrders',
        beforeSend: function(){
            $('tbody.orders').html('');
        },
        success: function(response){
            var i = 1;
            $.each(response.orders, function(key, order){
                $('tbody.orders').append('\
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">\
                        <th scope="row" class="px-6 pys-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">\
                        '+i+'\
                        </th>\
                        <td class="px-6 py-4">\
                            '+ order.first_name +' '+ order.last_name +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.date +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.status +'\
                        </td>\
                        <td class="px-6 py-4 text-right">\
                            <a href="/order/'+ order.id +'" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">view</a>\
                        </td>\
                    </tr>\
                ');
                i++;
            })
        }
    })
}

function fetchAllShippingOrders()
{
    $.ajax({
        type: 'get',
        url: '/fetchAllShippingOrders',
        beforeSend: function(){
            $('tbody.orders').html('');
        },
        success: function(response){
            var i = 1;
            $.each(response.orders, function(key, order){
                $('tbody.orders').append('\
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">\
                        <th scope="row" class="px-6 pys-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">\
                        '+i+'\
                        </th>\
                        <td class="px-6 py-4">\
                            '+ order.first_name +' '+ order.last_name +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.date +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.status +'\
                        </td>\
                        <td class="px-6 py-4 text-right">\
                            <a href="/order/'+ order.id +'" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">view</a>\
                        </td>\
                    </tr>\
                ');
                i++;
            })
        }
    })
}

function fetchAllRecievedOrders()
{
    $.ajax({
        type: 'get',
        url: '/fetchAllRecievedOrders',
        beforeSend: function(){
            $('tbody.orders').html('');
        },
        success: function(response){
            var i = 1;
            $.each(response.orders, function(key, order){
                $('tbody.orders').append('\
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">\
                        <th scope="row" class="px-6 pys-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">\
                        '+i+'\
                        </th>\
                        <td class="px-6 py-4">\
                            '+ order.first_name +' '+ order.last_name +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.date +'\
                        </td>\
                        <td class="px-6 py-4">\
                            '+ order.status +'\
                        </td>\
                        <td class="px-6 py-4 text-right">\
                            <a href="/order/'+ order.id +'" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">view</a>\
                        </td>\
                    </tr>\
                ');
                i++;
            })
        }
    })
}