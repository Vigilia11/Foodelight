$(document).ready(function(){
    fetchName();

    $(form_update_password).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_update_password).attr('method'),
            url: $(form_update_password).attr('action'),
            data: new FormData(form_update_password),
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function(){
                $('span.error').text("");
            },
            success: function(response){

                if(response.status == 404)
                {
                    $.each(response.errors, function(name, error){
                        $('span.'+name+'_error').text(error);
                    });
                }
                else{
                    $('span.error').text("");
                    $('#form_update_password').find('input').val("");
                    $('#seePassword').prop('checked', false);
                    $('#btn-close-modal-change-password').click();
                    $('#toast').show().delay(7000).fadeOut();
                    $('div.toast-message').text(response.message);
                }
                
            }
        })
    });


    $(form_change_name).on('submit', function(e){
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: $(form_change_name).attr('method'),
            url: $(form_change_name).attr('action'),
            data: new FormData(form_change_name),
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function(){
                $('span.error').text("");
            },
            success: function(response){

                if(response.status == 404)
                {
                    $.each(response.errors, function(name, error){
                        $('span.'+name+'_error').text(error);
                    });
                }
                else{
                    $('#form_change_name').find('span.error').text("");
                    $('#form_change_name').find('input').val("");
                    $('#btn-close-modal-change-name').click();
                    $('#toast').show().delay(7000).fadeOut();
                    $('div.toast-message').text(response.message);
                    fetchName();
                }
                
            }
        })
    });

    //see password
    document
    .getElementById("seePassword")
    .addEventListener("change", function(){
        var currentPassword = document.getElementById("current_password");
        var password = document.getElementById("password");
        var confirmPassword = document.getElementById("password_confirmation");
        if(this.checked){
            currentPassword.type = "text";
            password.type = "text";
            confirmPassword.type = "text";
        } else{
            currentPassword.type = "password";
            password.type = "password";
            confirmPassword.type = "password"
        }
    })
});

function showModalChangeName(){
    $('#btn-show-modal-change-name').click();

    $.ajax({
        type: 'get',
        url: '/fetchAccount',
        beforeSend: function(){
            $('#form_change_name').find('#first_name').val('');
            $('#form_change_name').find('#last_name').val('');
        },
        success: function(response){
            //console.log(response.account);
            
            $.each(response.account, function(key, account){
                $('#form_change_name').find('#first_name').val(account.first_name);
                $('#form_change_name').find('#last_name').val(account.last_name);
            })
            
        }
    })
}

function fetchName(){

    $.ajax({
        type: 'get',
        url: '/fetchAccount',
        beforeSend: function(){
            $('h6.name').text('');
        },
        success: function(response){
            //console.log(response.account);
            
            $.each(response.account, function(key, account){
                $('h6.name').text(account.first_name + " " + account.last_name);
            })
            
        }
    })
}