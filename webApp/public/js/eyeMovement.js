/*document.addEventListener('DOMContentLoaded', function () {
    const passField = document.getElementById('password');
    const loginImage = document.getElementById('loginImage');
    const eyePass = document.getElementById('eyepass')
    const emailField = document.getElementById('email')

    passField.addEventListener('focus', function () {
        loginImage.src = "images/catclose.png";
    });


    passField.addEventListener('blur', function () {
        loginImage.src = 'images/cat.png';
    });


    emailField.addEventListener('input', function () {
        if (emailField.value.length <= 4) {
            loginImage.src = 'images/catleft.png';
        } else if (emailField.value.length > 8) {
            loginImage.src = 'images/catright.png';
        } else {
            loginImage.src = 'images/cat.png';
        }
    });


    eyePass.addEventListener('click', function () {
        if (passField.type === 'password') {
            loginImage.src = 'images/catpick.png'
            passField.type = 'text'
        } else {
            loginImage.src = 'images/catclose.png';
            passField.type = 'password'

        }
    });

});
*/
