$(document).ready(function(){

});

var user_id;
function deleteUser(user_id)
{
    $('#btn-show-modal-delete-user').click();
    $('#form_delete_user').find('#user_id').val(user_id);
}