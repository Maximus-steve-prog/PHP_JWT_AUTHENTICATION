$(document).ready(function(){

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var passwordRegex = /^(?=.*[A-Za-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;
    
    $('.form-control').each(function() {
        $(this).on('click',function(){
            $(this).css({
                'border': '1px solid blue' // Ensure to specify border style
            });
        })
        $(this).on('focusout',function(){
            if ($(this).val() == '') {
                $(this).css({
                    'border': '1px solid red' // Ensure to specify border style
                });
            }else{
                $(this).css({
                    'border': '1px solid green' // Ensure to specify border style
                });
            }
        })
    });

    $('#loginEmail').on('focusout', function(){
        if(emailRegex.test($(this).val())){
            $(this).css({
                'border': '1px solid green' // Ensure to specify border style
            });
        }else{
            $(this).css({
                'border': '1px solid red' // Ensure to specify border style
            });
        }
    });

    $('#loginPassword').on('focusout', function(){
        if(passwordRegex.test($(this).val())){
            $(this).css({
                'border': '1px solid green' // Ensure to specify border style
            });
        }else{
            $(this).css({
                'border': '1px solid red' // Ensure to specify border style
            });
        }
    });

    const URL = `../../ServerAPI/userAPI.php`

    $('#registerBtn').click(function() {
        $('.form-control').each(function() {
            if ($(this).val() == '') {
                $(this).css({
                    'border': '1px solid red' // Ensure to specify border style
                });
            }else{
                const username = $('#registerUsername').val();
                const email = $('#registerEmail').val();
                const password = $('#registerPassword').val();
                $.ajax({
                    url: URL,
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ action: 'register', username, password,email }),
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });
    });

    $('#loginBtn').click(function() {

        $('.form-control').each(function() {
            if ($(this).val() == '') {
                $(this).css({
                    'border': '1px solid red' // Ensure to specify border style
                });
            }else{
                const email = $('#loginEmail').val();
                const password = $('#loginPassword').val();
                $.ajax({
                    url: URL,
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ action: 'login', email, password }),
                    success: function(response) {
                        if (response.content) {
                            // localStorage.setItem('jwt', response.token);
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });
            }
        })
    
    });

});