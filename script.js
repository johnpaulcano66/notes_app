// script.js

document.addEventListener('DOMContentLoaded', function () {
    const loginBtn = document.getElementById('login-btn');
    const registerBtn = document.getElementById('register-btn');
    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');

    loginBtn.addEventListener('click', function () {
        loginForm.classList.add('active');
        registerForm.classList.remove('active');
    });

    registerBtn.addEventListener('click', function () {
        registerForm.classList.add('active');
        loginForm.classList.remove('active');
    });

    const loginFormInputs = document.querySelectorAll('.login-form input');
    const registerFormInputs = document.querySelectorAll('.register-form input');

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();
        // Check login credentials
        console.log('Login form submitted');
    });

    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();
        // Register new user
        console.log('Register form submitted');
    });
});
