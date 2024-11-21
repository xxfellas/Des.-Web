const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');


registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
});

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
});

btnPopup.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
    wrapper.classList.remove('active');
});

document.addEventListener("DOMContentLoaded", function () {
    // Seleciona o botão Entrar
    const btnEntrar = document.querySelector(".btnEntrar");

    if (btnEntrar) {
        btnEntrar.addEventListener("click", function (event) {
            event.preventDefault(); // Impede o envio do formulário

            // Seleciona os campos de email e senha
            const email = document.querySelector('input[type="email"]').value;
            const password = document.querySelector('input[type="password"]').value;

            // Simula validação simples (ajuste conforme sua lógica)
            if (email && password) {
                // Redireciona para index.html
                window.location.href = "./index.html";
            } else {
                alert("Por favor, preencha o email e a senha.");
            }
        });
    } else {
        console.error("Botão 'Entrar' não encontrado.");
    }
});