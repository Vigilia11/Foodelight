$(document).ready(function(){
    fetchCakes();
    fetchAvailableCakes();
    
    /*
    setInterval(function(){
        init();
    }, 5000);
    */
    $(add_dish_form).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(add_dish_form).attr('method'),
            url: $(add_dish_form).attr('action'),
            data: new FormData(add_dish_form),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    //console.log(response.errors);
                    
                    $.each(response.errors, function(name, error){
                        $('span.'+name+'-error').text(error);
                    });
                }
                else
                {
                    $('img.profile-picture-preview').attr('src', '');
                    $('#add_dish_form').find('span.error').text('');
                    $('#add_dish_form').find('input').val('');
                    $('#btn_add_dish_hide').click();
                    addFormReset();
                    fetchCakes();
                }
                
            }
        })
    });

    $(form_edit_dish).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var dish_id = $('#form_edit_dish').find('#dish_id').val();
        var formData={
            //'dish_id': $('#form_edit_dish').find('#dish_id').val(),
            'name': $('#form_edit_dish').find('#name').val(),
            'price': $('#form_edit_dish').find('#price').val(),
        };

        $.ajax({
            type: 'PUT',
            url: '/updateCake/'+dish_id,
            data: formData,
            dataType: 'json',
            //processData: false,
            //contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    //console.log(response.errors);
                    
                    $.each(response.errors, function(name, error){
                        $('span.'+name+'-error').text(error);
                    });
                }
                else
                {
                    
                    $('#form_edit_dish').find('#dish_id').val('');
                    $('#form_edit_dish').find('#name').val('');
                    $('#form_edit_dish').find('#price').val('');
                    $('#modal-edit-dish-close-button').click();
                    fetchCakes();
                    //alert("success");
                }                
            }
        })
    });

    $(form_edit_dish_image).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            type: $(form_edit_dish_image).attr('method'),
            url: $(form_edit_dish_image).attr('action'),
            data: new FormData(form_edit_dish_image),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                if(response.status == 404)
                {
                    //console.log(response.errors);
                    
                    $.each(response.errors, function(name, error){
                        $('span.'+name+'-error').text(error);
                    });
                }
                else
                {
                    
                    $('#form_edit_dish_image').find('#dish_id').val('');
                    $('#form_edit_dish_image').find('#name').val('');
                    $('#form_edit_dish_image').find('#img_dish_edit').attr('src','');
                    $('#form_edit_dish_image').find('span.error').text('');
                    $('#modal-edit-dish-image-close-button').click();
                    fetchCakes();
                    //alert("success");
                }                
            }
        })
    });


});

function fetchCakes(){
    $.ajax({
        type: 'get',
        url: '/fetchCakes',
        success: function(response){
            //console.log(response.cakes);
            $('#cakes').html('');
            
            $.each(response.cakes, function(name, dish){
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
                $('#cakes').append('\
                    <div class="bg-white meal-container dish ">\
                        <div class="bg-gray-100 h-60 relative overflow-x-visible overflow-y-clip">\
                            <img src="images/dishes/'+ dish.image +'" class="w-full h-full">\
                            <div class="hidden absolute top-0 right-0 px-2 py-1 bg-sky-400 available-caption-'+dish.id+'">\
                                <span class="text-sm uppercase font-medium text-white">available</span>\
                            </div>\
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
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">\
                                <div class="grid grid-cols-4 pb-1.5">\
                                    <div class="flex justify-center gap-3 items-center relative">\
                                        <button type="button" onclick="addToAvailable('+dish.id+')" class="tooltip text-gray-800 hover:text-lime-600">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Add to available</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex justify-center gap-3 items-center">\
                                        <button type="button" onclick="editDish('+ dish.id +')" class="tooltip text-gray-800 hover:text-lime-600">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Edit</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        <button type="button" onclick="editDishImage('+ dish.id +')" class="tooltip text-gray-800 hover:text-lime-600">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Change photo</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        <button type="button" onclick="showDeleteModal('+ dish.id +')" class="tooltip text-red-600 hover:text-red-800">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Delete</span>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                ');

                $.each(response.available, function(item,available){
                    if(dish.id == available.dish_id && available.date == response.currentDate)
                    {
                        $('.available-caption-'+dish.id).removeClass('hidden');
                    }
                })
                
            });
            
        }
    });
}

function fetchAvailableCakes(){
    
    $.ajax({
        type: 'get',
        url: '/fetchAvailableCakes',
        beforeSend: function(){
            $('#available_cakes').html('');
        },
        success: function(response){
            
            $.each(response.availables, function(key, available){

                $('#available_cakes').append('\
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
                fetchCakes();

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
                fetchCakes();

                $('button.modal-close-btn').click();
            }
            
        }
    });
}

function addFormReset(){
    if(!$('#img_dish').hasClass("hidden")){
        $('#img_dish').addClass('hidden');
    }
    if($('#temporary_image').hasClass("hidden")){
        $('#temporary_image').removeClass('hidden');
    }

    $('#img_dish').attr('src', '');
    $('#add_dish_form').find('span.error').text('');
    $('#add_dish_form').find('input').val('');
}

var dish_id;
function editDish(dish_id){
    //$('#modal-edit-dish').show();
    $('#btn-show-edit-modal').click();
    $.ajax({
        type: 'get',
        url: '/editCakes/' + dish_id,
        beforeSend: function(){
                $('#form_edit_dish').find('#name').val('');
                $('#form_edit_dish').find('#price').val('');
        },
        success: function(response){
            $.each(response.cake, function(key,dish){
                $('#form_edit_dish').find('#dish_id').val(dish.id);
                $('#form_edit_dish').find('#name').val(dish.dish);
                $('#form_edit_dish').find('#price').val(dish.price);
            });
            
        }
    })
}

function editDishImage(dish_id){
    //$('#modal-edit-dish').show();
    $('#btn-show-edit-image-modal').click();
    $.ajax({
        type: 'get',
        url: '/editCakes/' + dish_id,
        beforeSend: function(){
                $('#form_edit_dish_image').find('#name').val('');
                $('#form_edit_dish_image').find('#name').val();
                $('#form_edit_dish_image').find('#img_dish_edit').attr('src','');
                $('#form_edit_dish_image').find('span.error').text('');
        },
        success: function(response){
            $.each(response.cake, function(key,dish){
                $('#form_edit_dish_image').find('#dish_id').val(dish.id);
                $('#form_edit_dish_image').find('#name').val(dish.dish);
                $('#form_edit_dish_image').find('#img_dish_edit').attr('src','images/dishes/'+dish.image);
            });
            
        }
    })
}

function showDeleteModal(dish_id){
    $('#btn-show-delete-modal').click();
    //$('h3.delete-message').text('Do you want to delete '+dish+'?');
    $('#modal-delete-dish').find('#dish_id').val(dish_id);
    
}

function deleteDish(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        
    var dish_id = $('#modal-delete-dish').find('#dish_id').val();

    $.ajax({
        type: 'delete',
        url: '/deleteDish/'+dish_id,
        success: function(response){
            $('#modal-delete-dish').find('#dish_id').val('');
            console.log(response.message);
            fetchCakes();
        }
    })
}

function filter(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
/*
    var formData={
        'filter': $('#filter').val(),
    }*/
    var filter = $('#filter').val();

    $.ajax({
        type: 'get',
        url: '/filterCakes/'+filter,
        success: function(response){
            //console.log(response.dishes);
            $('#cakes').html('');          
            
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
                $('#cakes').append('\
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
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">\
                                <div class="grid grid-cols-4 pb-1.5">\
                                    <div class="flex justify-center gap-3 items-center relative">\
                                        <button type="button" onclick="addToAvailable('+dish.id+')" class="tooltip text-gray-800 hover:text-lime-600">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Add to available</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex justify-center gap-3 items-center">\
                                        <button type="button" onclick="editDish('+ dish.id +')" class="tooltip text-gray-800 hover:text-lime-600">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Edit</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        <button type="button" onclick="editDishImage('+ dish.id +')" class="tooltip text-gray-800 hover:text-lime-600">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Change photo</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        <button type="button" onclick="showDeleteModal('+ dish.id +')" class="tooltip text-red-600 hover:text-red-800">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-black border border-white z-10 rounded-md">Delete</span>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
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

function addToAvailable(dish_id){
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
        url: '/addAvailable',
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
                fetchCakes();
                fetchAvailableCakes();
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
            $('#form_dish_order').find('#dish_name').text('');
        },
        success: function(response){
            console.log(response.meal);

            $.each(response.meal, function(key, dish){
                $('#form_dish_order').find('#dish_id').val(dish.id);
                $('#form_dish_order').find('#dish_name').text(dish.dish);
            })
        }
    })
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
                $('#div_remove_available').hide('hidden');
                $('#button_remove_available').val('');
        },
        success: function(response){
            console.log(response.meal);

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

            $.each(response.available, function(key,available){                
                if(available.date == response.currentDate)
                {
                    $('#div_remove_available').show('hidden');
                    $('#button_remove_available').val(available.id);
                }
            });
        }
    })
}

function deleteAvailable()
{
    var available_id = $('#button_remove_available').val();
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'delete',
        url: '/deleteAvailable/'+ available_id,
        success: function(response){
            $('#modalDetails-btn-close').click();
            fetchCakes();
            fetchAvailableCakes();
        }
    })
}