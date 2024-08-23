$(document).ready(function(){
    fetchProfile();

    $(form_update_photo).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_update_photo).attr('method'),
            url: $(form_update_photo).attr('action'),
            data: new FormData(form_update_photo),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){

                if(response.status == 404)
                {
                    $.each(response.errors, function(name, error){
                        $('span.'+name+'-error').text(error);
                    });
                }
                else{
                    $('#btn-close-modal-change-photo').click();
                    $('#toast').show().delay(7000).fadeOut();
                    $('div.toast-message').text(response.message);
                    fetchProfile();
                }
                
            }
        })
    })

    $(form_edit_info).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_edit_info).attr('method'),
            url: $(form_edit_info).attr('action'),
            data: new FormData(form_edit_info),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){

                if(response.status == 404)
                {
                    $.each(response.errors, function(name, error){
                        $('span.'+name+'-error').text(error);
                    });
                }
                else{
                    $('#btn-close-modal-edit-info').click();
                    $('#toast').show().delay(7000).fadeOut();
                    $('div.toast-message').text(response.message);
                    fetchProfile();
                }
                
            }
        })
    })
});

function fetchProfile(){

    $.ajax({
        type: 'get',
        url: '/fetchProfile',
        beforeSend: function(){
            $('h6.mobile-number').text('');
            $('h6.address-1').text('');
            $('h6.address-2').text('');
        },
        success: function(response){
            //console.log(response.profile);

            $.each(response.profile, function(name, profile){
                $('img.profile-picture').attr('src', '/images/profile/'+profile.photo);
                $('h6.mobile-number').text(profile.mobile_number);
                $('h6.address-1').text(profile.street + ", " + profile.barangay);
                $('h6.address-2').text(profile.city + ", " + profile.province + ", " + profile.country);
            });
            
        }
    })
}

function editProfile(){

    $.ajax({
        type: 'get',
        url: '/fetchProfile',
        beforeSend: function(){
            $('#form_edit_info').find('#mobile_number').val('');
            $('#form_edit_info').find('#street').val('');
            $('#form_edit_info').find('#barangay').val('');
            $('#form_edit_info').find('#city').val('');
        },
        success: function(response){
            //console.log(response.profile);

            $('#btn-show-modal-edit-info').click();
            $.each(response.profile, function(name, profile){
                $('#form_edit_info').find('#mobile_number').val(profile.mobile_number);
                $('#form_edit_info').find('#street').val(profile.street);
                $('#form_edit_info').find('#barangay').val(profile.barangay);
                $('#form_edit_info').find('#city').val(profile.city);

                
            });
            
        }
    })
}

//image preview
/*
photo.onchange = evt => {
    
    const [file] = photo.files
    if (file) {
        
        image_preview.src = URL.createObjectURL(file)
        
        $('#image_preview').show();
    }
}
*/