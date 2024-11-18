document.addEventListener('DOMContentLoaded', function () {
    const passField = document.getElementById('password');
    const loginImage = document.getElementById('loginImage');
    // const eyePass = document.getElementById('eyepass')
    const emailField = document.getElementById('email')

    passField.addEventListener('focus', function () {
        loginImage.src = "images/login/06.png";
    });


    passField.addEventListener('blur', function () {
        loginImage.src = 'images/login/1.png';
    });


    emailField.addEventListener('input', function () {
        if (emailField.value.length <= 4) {
            loginImage.src = 'images/login/2.png';
        } else if (emailField.value.length >= 5 && emailField.value.length <= 9) {
            loginImage.src = 'images/login/3.png';
        } else if (emailField.value.length >= 10 && emailField.value.length <= 14){
            loginImage.src = 'images/login/4.png';
        } else {
            loginImage.src = 'images/login/5.png';
        }
    });


    /* eyePass.addEventListener('click', function () {
        if (passField.type === 'password') {
            loginImage.src = 'images/login/06.png'
            passField.type = 'text'
        } else {
            loginImage.src = 'images/login/06.png';
            passField.type = 'password'

        }
    }); */

});

