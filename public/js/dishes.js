$(document).ready(function(){

    fetchMeals();
    fetchCakes();
    fetchBreads();
    fetchJuice();
    fetchMostFavorites();
    fetchMostRequested()

    
    //add dish
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
                    fetchMeals();
                    fetchMostFavorites()
                }
                
            }
        })
    });

    /*
    $('.meal-container').mouseenter(function(){
        if($('.button_ordera').hasClass("translate-y-full")){
            $('.button_ordera').removeClass("translate-y-full");
            //$('.contenta').removeClass("overflow-hidden");
        }        
    });
    $('.meal-container').mouseleave(function(){
        if(!$('.button_ordera').hasClass("translate-y-full")){
            $('.button_ordera').addClass("translate-y-full");
            //$('.contenta').addClass("overflow-hidden");
        } 
    });
    */  
});

image.onchange = evt => {
    const [file] = image.files
    if (file) {
        
        img_dish.src = URL.createObjectURL(file)
        
        if($('#img_dish').hasClass("hidden")){
            $('#img_dish').removeClass('hidden');
        }
        if(!$('#temporary_image').hasClass("hidden")){
            $('#temporary_image').addClass('hidden');
        }
        //$('#img_add_preview').show();
    }
}

var dish_id;
function showFavoriteRequest(dish_id){
    
    if($('#button_order'+dish_id).hasClass("translate-y-full")){
        $('#button_order'+dish_id).removeClass("translate-y-full");
        //$('#content'+dish_id).removeClass("overflow-hidden");
    }
    
    if($('#mealcontent'+dish_id).hasClass("overflow-hidden")){
     
        $('#mealcontent'+dish_id).removeClass("overflow-hidden");
    }
    
}

function hideFavoriteRequest(dish_id){
    if(!$('#button_order'+dish_id).hasClass("translate-y-full")){
        $('#button_order'+dish_id).addClass("translate-y-full");
    }
    if(!$('#mealcontent'+dish_id).hasClass("overflow-hidden")){
        $('#mealcontent'+dish_id).addClass("overflow-hidden");
    }
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

function submitReact(dish_id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var formData ={
        'dish_id': dish_id,
        'react': "1",
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
                fetchMostFavorites();

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
                fetchMostFavorites();
                fetchMostRequested();

                $('button.modal-close-btn').click();
            }
            
        }
    });
}



function fetchMostFavorites(){
    $.ajax({
        type: 'get',
        url: '/fetchMostFavorites',
        success: function(response){
            //console.log(response.meals);
            if(!(jQuery.isEmptyObject(response.meals)))
            {
                $('#most_favorites').html('');
            }
            
            var i=1;
            $.each(response.meals, function(name, meal){
                
                $('#most_favorites').append('\
                    <div class="col-span-1 h-48 relative ps-4" role="button" onclick="selectedDish('+ meal.id +')">\
                        <div class="absolute top-0 -left-2 text-white text-6xl font-extrabold" style="text-shadow: 4px 4px 8px #e11d48">'+ i +'</div>\
                        <div class="h-full bg-white shadow">\
                            <img src="images/dishes/'+ meal.image +'" alt="" class="w-full h-full">\
                        </div>\
                    </div>\
                ');
                i++;
            })
            
        }
    });
}

function fetchMostRequested(){
    $.ajax({
        type: 'get',
        url: '/fetchMostRequested',
        success: function(response){
            //console.log(response.meals);
            if(!(jQuery.isEmptyObject(response.meals)))
            {
                $('#most_requested').html('');
            }
            
            var i=1;
            $.each(response.meals, function(name, meal){
                
                $('#most_requested').append('\
                    <div class="col-span-1 h-48 relative ps-4" onclick="selectedDish('+ meal.id +')">\
                        <div class="absolute top-0 -left-2 text-white text-6xl font-extrabold" style="text-shadow: 4px 4px 8px #9333ea">'+ i +'</div>\
                        <div class="h-full bg-white shadow">\
                            <img src="images/dishes/'+ meal.image +'" alt="" class="w-full h-full">\
                        </div>\
                    </div>\
                ');
                i++;
            })
            
        }
    });
}

function selectedDish(dish_id)
{
    $('#btn_show_most_favorite_modal').click();

    $.ajax({
        type: 'get',
        url: '/fetchSelectedDish/' + dish_id,
        success: function(response){
            
            $.each(response.meal, function(key, item){
                var reactButtonColor="";
                if(response.active_user == item.userReact){ reactButtonColor="text-rose-600" }
                else{ reactButtonColor="text-gray-800" };
                var reacts ="";
                if(item.totalReact >= 1){ reacts=item.totalReact; }

                var requestButtonColor="";
                if(response.active_user == item.userRequest){ requestButtonColor="text-indigo-600" }
                else{ requestButtonColor="text-gray-800" }
                var requests="";
                if(item.totalRequest >= 1){ requests=item.totalRequest; }

                var category_color ="";
                if(item.category=="Meal"){ category_color ="text-red-700"; }

                $('img.modal_dishImage').attr('src', 'images/dishes/'+item.image);
                $('h1.modal_dishName').text(item.dish);
                $('div.modal_category').html('\
                    <h2 class="'+ category_color +'">'+ item.category +'</h2>\
                ');
                $('h2.modal_price').text(item.price);
                $('div.modal_button_react').html('\
                    <span class="text-md font-medium text-gray-800 modal_reacts">'+ reacts +'</span>\
                    <button type="button" class="tooltip text-center '+ reactButtonColor +'" onclick="submitReact('+ item.id +')">\
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />\
                        </svg>\
                        <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-gray-800 border border-white z-10 rounded-md">Favorite</span>\
                    </button>\
                ');
                $('div.modal_button_request').html('\
                    <span class="text-md font-medium text-gray-800 modal_requests">'+ requests +'</span>\
                    <button type="button" class="tooltip text-center '+ requestButtonColor +'" onclick="submitRequest('+ item.id +')">\
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />\
                        </svg>\
                        <span class="tooltiptext text-sm  px-2 py-1.5 text-center text-white absolute bg-gray-800 z-10 border border-white rounded-md">Request</span>\
                    </button>\
                ');
            });
            
        }
    });
}

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
            
            $.each(response.meals, function(name, meal){
                var showReact="";
                if(meal.totalReact >= 1){
                    showReact = "<span class='text-sm font-semibold text-gray-800'>"+ meal.totalReact +"</span>";
                }
                var reactButtonColor="";
                if(response.active_user == meal.userReact){ reactButtonColor="text-rose-600" }
                else{ reactButtonColor="text-gray-800" }

                var showRequest="";
                if(meal.totalRequest >= 1){
                    showRequest = "<span class='text-sm font-semibold text-gray-800'>"+ meal.totalRequest +"</span>";
                }
                var requestButtonColor="";
                if(response.active_user == meal.userRequest){ requestButtonColor="text-indigo-600" }
                else{ requestButtonColor="text-gray-800" }

                $('#meals').append('\
                    <div class="bg-white meal-container dish">\
                        <div class="bg-gray-100 h-48 relative">\
                            <img src="images/dishes/'+ meal.image +'" alt="" class="w-full h-full">\
                        </div>\
                        <div class="py-2.5 px-1 relative overflow-hidden">\
                            <h6 class="text-black text-lg font-bold">'+ meal.dish +'</h6>\
                            <div class="grid grid-cols-2">\
                                <div class="text-start  text-lime-600">₱'+ meal.price +'/order</div>\
                            </div>\
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">\
                                <div class="grid grid-cols-2 pb-1.5">\
                                    <div class="flex justify-center gap-2 items-center">\
                                        '+ showReact +'\
                                        <button type="button" class="tooltip text-center '+ reactButtonColor +'" onclick="submitReact('+ meal.id +')">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-gray-800 border border-white z-10 rounded-md">Favorite</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        '+ showRequest +'\
                                        <button type="button" class="tooltip text-center '+ requestButtonColor +'" onclick="submitRequest('+ meal.id +')">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm  px-2 py-1.5 text-center text-white absolute bg-gray-800 z-10 border border-white rounded-md">Request</span>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                ');
                
            })
            
        }
    });
}


function fetchCakes(){
    $.ajax({
        type: 'get',
        url: '/fetchCakes',
        success: function(response){
            //console.log(response.meals);
            if(!(jQuery.isEmptyObject(response.dishes)))
            {
                $('#cakes').html('');
            }            
            
            $.each(response.dishes, function(name, dish){
                var showReact="";
                if(dish.totalReact >= 1){
                    showReact = "<span class='text-sm font-semibold text-gray-800'>"+ dish.totalReact +"</span>";
                }
                var reactButtonColor="";
                if(response.active_user == dish.userReact){ reactButtonColor="text-rose-600" }
                else{ reactButtonColor="text-gray-800" }

                var showRequest="";
                if(dish.totalRequest >= 1){
                    showRequest = "<span class='text-sm font-semibold text-gray-800'>"+ dish.totalRequest +"</span>";
                }
                var requestButtonColor="";
                if(response.active_user == dish.userRequest){ requestButtonColor="text-indigo-600" }
                else{ requestButtonColor="text-gray-800" }

                $('#cakes').append('\
                    <div class="bg-white meal-container dish">\
                        <div class="bg-gray-100 h-48 relative">\
                            <img src="images/dishes/'+dish.image +'" alt="" class="w-full h-full">\
                        </div>\
                        <div class="py-2.5 px-1 relative overflow-hidden">\
                            <h6 class="text-black text-lg font-bold">'+ dish.dish +'</h6>\
                            <div class="grid grid-cols-2">\
                                <div class="text-start  text-lime-600">₱'+ dish.price +'/order</div>\
                            </div>\
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">\
                                <div class="grid grid-cols-2 pb-1.5">\
                                    <div class="flex justify-center gap-2 items-center">\
                                        '+ showReact +'\
                                        <button type="button" class="tooltip text-center '+ reactButtonColor +'" onclick="submitReact('+ dish.id +')">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-gray-800 border border-white z-10 rounded-md">Favorite</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        '+ showRequest +'\
                                        <button type="button" class="tooltip text-center '+ requestButtonColor +'" onclick="submitRequest('+ dish.id +')">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm  px-2 py-1.5 text-center text-white absolute bg-gray-800 z-10 border border-white rounded-md">Request</span>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                ');
                
            })
            
        }
    });
}

function fetchBreads(){
    $.ajax({
        type: 'get',
        url: '/fetchBreads',
        success: function(response){
            //console.log(response.meals);
            if(!(jQuery.isEmptyObject(response.dishes)))
            {
                $('#breads').html('');
            }            
            
            $.each(response.dishes, function(name, dish){
                var showReact="";
                if(dish.totalReact >= 1){
                    showReact = "<span class='text-sm font-semibold text-gray-800'>"+ dish.totalReact +"</span>";
                }
                var reactButtonColor="";
                if(response.active_user == dish.userReact){ reactButtonColor="text-rose-600" }
                else{ reactButtonColor="text-gray-800" }

                var showRequest="";
                if(dish.totalRequest >= 1){
                    showRequest = "<span class='text-sm font-semibold text-gray-800'>"+ dish.totalRequest +"</span>";
                }
                var requestButtonColor="";
                if(response.active_user == dish.userRequest){ requestButtonColor="text-indigo-600" }
                else{ requestButtonColor="text-gray-800" }

                $('#breads').append('\
                    <div class="bg-white meal-container dish">\
                        <div class="bg-gray-100 h-48 relative">\
                            <img src="images/dishes/'+dish.image +'" alt="" class="w-full h-full">\
                        </div>\
                        <div class="py-2.5 px-1 relative overflow-hidden">\
                            <h6 class="text-black text-lg font-bold">'+ dish.dish +'</h6>\
                            <div class="grid grid-cols-2">\
                                <div class="text-start  text-lime-600">₱'+ dish.price +'/order</div>\
                            </div>\
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">\
                                <div class="grid grid-cols-2 pb-1.5">\
                                    <div class="flex justify-center gap-2 items-center">\
                                        '+ showReact +'\
                                        <button type="button" class="tooltip text-center '+ reactButtonColor +'" onclick="submitReact('+ dish.id +')">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-gray-800 border border-white z-10 rounded-md">Favorite</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        '+ showRequest +'\
                                        <button type="button" class="tooltip text-center '+ requestButtonColor +'" onclick="submitRequest('+ dish.id +')">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm  px-2 py-1.5 text-center text-white absolute bg-gray-800 z-10 border border-white rounded-md">Request</span>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                ');
                
            })
            
        }
    });
}

function fetchJuice(){
    $.ajax({
        type: 'get',
        url: '/fetchJuices',
        success: function(response){
            //console.log(response.meals);
            if(!(jQuery.isEmptyObject(response.dishes)))
            {
                $('#juice').html('');
            }            
            
            $.each(response.dishes, function(name, dish){
                var showReact="";
                if(dish.totalReact >= 1){
                    showReact = "<span class='text-sm font-semibold text-gray-800'>"+ dish.totalReact +"</span>";
                }
                var reactButtonColor="";
                if(response.active_user == dish.userReact){ reactButtonColor="text-rose-600" }
                else{ reactButtonColor="text-gray-800" }

                var showRequest="";
                if(dish.totalRequest >= 1){
                    showRequest = "<span class='text-sm font-semibold text-gray-800'>"+ dish.totalRequest +"</span>";
                }
                var requestButtonColor="";
                if(response.active_user == dish.userRequest){ requestButtonColor="text-indigo-600" }
                else{ requestButtonColor="text-gray-800" }

                $('#juice').append('\
                    <div class="bg-white meal-container dish">\
                        <div class="bg-gray-100 h-48 relative">\
                            <img src="images/dishes/'+dish.image +'" alt="" class="w-full h-full">\
                        </div>\
                        <div class="py-2.5 px-1 relative overflow-hidden">\
                            <h6 class="text-black text-lg font-bold">'+ dish.dish +'</h6>\
                            <div class="grid grid-cols-2">\
                                <div class="text-start  text-lime-600">₱'+ dish.price +'/order</div>\
                            </div>\
                            <div class="absolute bottom-0 left-0 w-full z-20  border-b border-gray-100 button-container" style="background-color:rgba(255,255,255,0.8)">\
                                <div class="grid grid-cols-2 pb-1.5">\
                                    <div class="flex justify-center gap-2 items-center">\
                                        '+ showReact +'\
                                        <button type="button" class="tooltip text-center '+ reactButtonColor +'" onclick="submitReact('+ dish.id +')">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm px-2 py-1.5 text-center text-white absolute bg-gray-800 border border-white z-10 rounded-md">Favorite</span>\
                                        </button>\
                                    </div>\
                                    <div class="flex items-center justify-center gap-2">\
                                        '+ showRequest +'\
                                        <button type="button" class="tooltip text-center '+ requestButtonColor +'" onclick="submitRequest('+ dish.id +')">\
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />\
                                            </svg>\
                                            <span class="tooltiptext text-sm  px-2 py-1.5 text-center text-white absolute bg-gray-800 z-10 border border-white rounded-md">Request</span>\
                                        </button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                ');
                
            })
            
        }
    });
}

/*
setInterval(function(){
    fetchMeals();
    fetchCakes();
    fetchBreads();
    fetchJuices();
}, 5000);
*/