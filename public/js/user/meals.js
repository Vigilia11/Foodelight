$(document).ready(function(){
    fetchMeals();
    fetchAvailableMeals();        
    
    /*
    setInterval(function(){
        init();
    }, 5000);
    */
    $(form_dish_order).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_dish_order).attr('method'),
            url: $(form_dish_order).attr('action'),
            data: new FormData(form_dish_order),
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function(){
                $('.toast-message').text('');
            },
            success: function(response){
                if(response.status == 404)
                {
                    
                    $.each(response.errors, function(name, error){
                        $('span.'+name+'-error').text(error);
                    });
                }
                else
                {
                    
                    $('#form_dish_order').find('#dish_id').val('');
                    $('#form_dish_order').find('#quantity').val('');
                    $('#form_dish_order').find('span.error').text('');
                    $('#modal-dish-order-btn-close').click();

                    $('.toast-message').text(response.message);
                    $('#toast-order').show().delay(7000).fadeOut();
                }  
            }
        })
    })

    $(form_dish_cart).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_dish_cart).attr('method'),
            url: $(form_dish_cart).attr('action'),
            data: new FormData(form_dish_cart),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404){
                    $.each(response.errors, function(name, error){
                        $('span.'+name+'-error').text(error);
                    });
                }
                else{
                    $('#form_dish_cart').find('#dish_id').val('');
                    $('#form_dish_cart').find('#quantity').val('');
                    $('#form_dish_cart').find('span.error').text('');
                    $('#modal-dish-cart-btn-close').click();

                    $('.toast-message').text(response.message);
                    $('#toast-order').show().delay(7000).fadeOut();
                }
            }
        })
    });
});

function fetchMeals(){
    $.ajax({
        type: 'get',
        url: '/fetchMeals',
        success: function(response){
            //console.log(response.meals);
            if(!(jQuery.isEmptyObject(response.meals)))
            {
                $('#meals').html('');
            }            
            
            $.each(response.meals, function(name, dish){
                var reactColor = "text-black";
                if(dish.userReact == response.active_user)
                {
                    reactColor = "text-rose-600";
                }
                var requestColor = "text-black";
                if(dish.userRequest == response.active_user)
                {
                    requestColor = "text-sky-600";
                }

                $('#meals').append('\
                    <div class="bg-white meal-container dish ">\
                        <div class="bg-gray-100 h-60 relative overflow-x-visible overflow-y-clip">\
                            <img src="images/dishes/'+ dish.image +'" class="w-full h-full">\
                            <div class="hidden absolute top-0 right-0 px-2 py-1 bg-sky-400 available-caption-'+dish.id+'">\
                                <span class="text-sm uppercase font-medium text-white">available</span>\
                            </div>\
                            <div class="absolute bottom-0 left-0 z-10 w-full button-container bg-white">\
                                <div class="grid grid-cols-3 w-full">\
                                    <button type="button" onclick="submitReact('+ dish.id +')" class="flex justify-center tooltip '+ reactColor +' hover:text-rose-600 py-2 text-center hover:bg-gray-100">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">React</span>\
                                    </button>\
                                    <button type="button" onclick="submitRequest('+ dish.id +')" class="flex justify-center tooltip '+ requestColor +' hover:text-sky-600 py-2 hover:bg-gray-100">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Request</span>\
                                    </button>\
                                    <button type="button" onclick="viewDetails('+ dish.id +')" class="flex justify-center tooltip text-black hover:text-lime-600 py-2 hover:bg-gray-100">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Details</span>\
                                    </button>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="py-2.5 px-1 relative overflow-x-visible overflow-y-clip">\
                            <h6 class="text-black text-lg font-bold">'+dish.dish+'</h6>\
                            <h6 class="text-start  text-lime-600">₱'+dish.price+'</h6>\
                        </div>\
                    </div>\
               ');

               $.each(response.available, function(item,available){
                if(dish.id == available.dish_id && available.date == response.currentDate)
                {
                    $('.available-caption-'+dish.id).removeClass('hidden');
                }
            })
                
            })
            
        }
    });
}

function fetchAvailableMeals(){
    
    $.ajax({
        type: 'get',
        url: '/fetchAvailableMeals',
        beforeSend: function(){
            $('#available_meals').html('');
        },
        success: function(response){
            
            $.each(response.availables, function(key, available){

                $('#available_meals').append('\
                    <div class="bg-gray-500 h-28 md:h-40 cursor-pointer" onclick="viewDetails('+ available.id +')">\
                        <img src="/images/dishes/'+available.image+'" alt="" class="w-full h-full">\
                    </div>\
                ');
            })
        }
    });
}

function submitReact(dish_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData ={
        'dish_id': dish_id,
    };

    $.ajax({
        type: 'post',
        url: '/addReact',
        data: formData,
        dataType: 'json',
        success: function(response){
            if(response.status == 404)
            {
                console.log(response.errors);           
            }
            else
            {
                console.log(response.message);
                fetchMeals();

                $('button.modal-close-btn').click();
            }
            
        }
    });
}

function submitRequest(dish_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData ={
        'dish_id': dish_id,
    };

    $.ajax({
        type: 'post',
        url: '/addRequest',
        data: formData,
        dataType: 'json',
        success: function(response){
            if(response.status == 404)
            {
                console.log(response.errors);           
            }
            else
            {
                console.log(response.message);
                fetchMeals();

                $('button.modal-close-btn').click();
            }
            
        }
    });
}


function filter(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var filter = $('#filter').val();

    $.ajax({
        type: 'get',
        url: '/filterMeals/'+filter,
        success: function(response){
            //console.log(response.dishes);
            if(!(jQuery.isEmptyObject(response.dishes)))
            {
                $('#meals').html('');
            }            
            
            $.each(response.dishes, function(name, dish){
               
                var reactColor = "text-black";
                if(dish.userReact == response.active_user)
                {
                    reactColor = "text-rose-600";
                }
                var requestColor = "text-black";
                if(dish.userRequest == response.active_user)
                {
                    requestColor = "text-sky-600";
                }

                $('#meals').append('\
                    <div class="bg-white meal-container dish ">\
                        <div class="bg-gray-100 h-60 relative overflow-x-visible overflow-y-clip">\
                            <img src="images/dishes/'+ dish.image +'" class="w-full h-full">\
                            <div class="hidden absolute top-0 right-0 px-2 py-1 bg-sky-400 available-caption-'+dish.id+'">\
                                <span class="text-sm uppercase font-medium text-white">available</span>\
                            </div>\
                            <div class="absolute bottom-0 left-0 z-10 w-full button-container bg-white">\
                                <div class="grid grid-cols-3 w-full">\
                                    <button type="button" onclick="submitReact('+ dish.id +')" class="flex justify-center tooltip '+ reactColor +' hover:text-rose-600 py-2 text-center hover:bg-gray-100">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">React</span>\
                                    </button>\
                                    <button type="button" onclick="submitRequest('+ dish.id +')" class="flex justify-center tooltip '+ requestColor +' hover:text-sky-600 py-2 hover:bg-gray-100">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Request</span>\
                                    </button>\
                                    <button type="button" onclick="viewDetails('+ dish.id +')" class="flex justify-center tooltip text-black hover:text-lime-600 py-2 hover:bg-gray-100">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Details</span>\
                                    </button>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="py-2.5 px-1 relative overflow-x-visible overflow-y-clip">\
                            <h6 class="text-black text-lg font-bold">'+dish.dish+'</h6>\
                            <h6 class="text-start  text-lime-600">₱'+dish.price+'</h6>\
                        </div>\
                    </div>\
               ');

               $.each(response.available, function(item,available){
                if(dish.id == available.dish_id && available.date == response.currentDate)
                {
                    $('.available-caption-'+dish.id).removeClass('hidden');
                }
            })
                
            })
                
        }
    });
}

function viewDetails(dish_id){
    $('#showDetailsModal').click();

    $.ajax({
        type: 'get',
        url: '/editMeals/'+dish_id,
        beforeSend: function(){
            $('#dish-image').html('');
                $('#dish-name').text('');
                $('#dish-price').text('');
                $('#dish-reacts').text('');
                $('#dish-request').text('');
                $('div.btn-container').hide();
        },
        success: function(response){
            //console.log(response.meal);

            $.each(response.meal, function(key, dish){
                $('#dish-image').html('\
                    <img src="images/dishes/'+dish.image+'" class="w-full h-full">\
                ');
                $('#dish-name').text(dish.dish);
                $('#dish-price').text(dish.price);
                $('#dish-reacts').text(dish.totalReact);
                $('#dish-request').text(dish.totalRequest);

                if(dish.available_date == response.currentDate){
                    $('div.btn-container').show();
                    $('#btn-order').val(dish.id);
                    $('#btn-cart').val(dish.id);
                }
            })
        }
    })
}

function submitReact(dish_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData ={
        'dish_id': dish_id,
    };

    $.ajax({
        type: 'post',
        url: '/addReact',
        data: formData,
        dataType: 'json',
        success: function(response){
            if(response.status == 404)
            {
                console.log(response.errors);           
            }
            else
            {
                console.log(response.message);
                fetchMeals();
            }
            
        }
    });
}

function submitRequest(dish_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData ={
        'dish_id': dish_id,
    };

    $.ajax({
        type: 'post',
        url: '/addRequest',
        data: formData,
        dataType: 'json',
        success: function(response){
            if(response.status == 404)
            {
                console.log(response.errors);           
            }
            else
            {
                console.log(response.message);
                fetchMeals();

            }
            
        }
    });
}

function showOrderModal(){
    $('#modalDetails-btn-close').click();
    
    dish_id = $('#btn-order').val();

    $.ajax({
        type: 'get',
        url: '/editMeals/'+dish_id,
        beforeSend: function(){
            $('#form_dish_order').find('#quantity').val('');
            $('#form_dish_order').find('#price').val('');
            $('#form_dish_order').find('#dish_name').text('');
        },
        success: function(response){
            //console.log(response.meal);

            $.each(response.meal, function(key, dish){
                $('#form_dish_order').find('#dish_id').val(dish.id);
                $('#form_dish_order').find('#dish_name').text(dish.dish);
            })
        }
    })
}

function showCartModal(){
    $('#modalDetails-btn-close').click();
    
    dish_id = $('#btn-cart').val();

    $.ajax({
        type: 'get',
        url: '/editMeals/'+dish_id,
        beforeSend: function(){
            $('#form_dish_cart').find('#quantity').val('');
            $('#form_dish_cart').find('#price').val('');
            $('#form_dish_cart').find('#dish_name').text('');
        },
        success: function(response){
            //console.log(response.meal);

            $.each(response.meal, function(key, dish){
                $('#form_dish_cart').find('#dish_id').val(dish.id);
                $('#form_dish_cart').find('#dish_name').text(dish.dish);
            })
        }
    })
}

function dishPriceOrder(){

    var dish_id = $('#form_dish_order').find('#dish_id').val();
    var quantity = $('#form_dish_order').find('#quantity').val();
    
    $.ajax({
        type: 'get',
        url: '/fetchDishPrice/'+dish_id,
        beforeSend: function(){
            $('#form_dish_order').find('#price').val('');
        },
        success: function(response){
            //console.log(response.dish);

            var price;

            $.each(response.dish, function(key,item){
                price = quantity * item.price;
                if(price > 0){
                    $('#form_dish_order').find('#price').val(price);
                }else{
                    $('#form_dish_order').find('#price').val('');
                }
                
            })
        }
    });
    
}

function showDeleteModal(){
    $('#btn-show-delete-modal').click();
}

function showEditModal(){
    $('#btn-show-edit-modal').click();
}

function dishPriceCart(){

    dish_id = $('#form_dish_cart').find('#dish_id').val();
    var quantity = $('#form_dish_cart').find('#quantity').val();
    $.ajax({
        type: 'get',
        url: '/fetchDishPrice/'+dish_id,
        beforeSend: function(){
            $('#form_dish_cart').find('#price').val('');
        },
        success: function(response){
            //console.log(response.dish);

            var price;

            $.each(response.dish, function(key,item){
                price = quantity * item.price;
                if(price > 0){
                    $('#form_dish_cart').find('#price').val(price);
                }else{
                    $('#form_dish_cart').find('#price').val('');
                }
            })
        }
    });
}