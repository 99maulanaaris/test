$(document).ready(function(){
    $('#togglePassword').click(function(){
        var passwordInput = $('#password');
        var icon = $(this).find('i');
        if(passwordInput.attr('type') === 'password'){
            passwordInput.attr('type', 'text');
            icon.removeClass('fa-eye');
            icon.addClass('fa-eye-slash');
        } else {
            passwordInput.attr('type', 'password');
            icon.removeClass('fa-eye-slash');
            icon.addClass('fa-eye');
        }
    });

    $('#password').on('input', function(){
        var password = $(this).val();
        var lengthRule = $('#lengthRule');
        var upperCaseRule = $('#upperCaseRule');
        var lowerCaseRule = $('#lowerCaseRule');
        var specialCharRule = $('#specialCharRule');

        if(password.length >= 8){
            lengthRule.addClass('valid');
        } else {
            lengthRule.removeClass('valid');
        }

        if(/[A-Z]/.test(password)){
            upperCaseRule.addClass('valid');
        } else {
            upperCaseRule.removeClass('valid');
        }

        if(/[a-z]/.test(password)){
            lowerCaseRule.addClass('valid');
        } else {
            lowerCaseRule.removeClass('valid');
        }

        if(/[!@#$%^&*(),.?":{}|<>]/.test(password)){
            specialCharRule.addClass('valid');
        } else {
            specialCharRule.removeClass('valid');
        }
    });

    $('#registerForm').submit(function(e){
        e.preventDefault();
        // Additional validation or submission logic can be added here
        alert('Registration Successful!');
    });
});
