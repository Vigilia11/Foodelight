//see password
document
.getElementById("seePassword")
.addEventListener("change", function(){
    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("password_confirmation");
    if(this.checked){
        password.type = "text";
        confirmPassword.type = "text";
    } else{
        password.type = "password";
        confirmPassword.type = "password"
    }
})