image.onchange = evt => {
    const [file] = image.files
    if (file) {
        
        img_dish.src = URL.createObjectURL(file)
        
        if($('img.image-preview').hasClass("hidden")){
            $('img.image-preview').removeClass('hidden');
        }
        if(!$('#temporary_image').hasClass("hidden")){
            $('#temporary_image').addClass('hidden');
        }
        //$('#img_add_preview').show();
    }
}

image_edit.onchange = evt => {
    const [file] = image_edit.files
    if (file) {
        
        img_dish_edit.src = URL.createObjectURL(file)
        
        //$('#img_add_preview').show();
    }
}