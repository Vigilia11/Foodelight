//image preview
photo.onchange = evt => {
    
    const [file] = photo.files
    if (file) {
        
        image_preview.src = URL.createObjectURL(file)
        
        $('#image_preview').show();
    }
}