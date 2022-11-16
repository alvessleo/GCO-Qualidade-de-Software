/*
// Gerenciando o form
const form = document.querySelector("div.form-funcionario");

document.getElementById("add-func").addEventListener("click", () => {
    form.style.display="flex";
});
*/

var CadastrarFuncionario = document.getElementById("cadastrarFuncionario");
var popupFuncionario = document.getElementsByClassName("form-funcionario")[0];
var closeButton = document.getElementsByClassName("close")[0];

CadastrarFuncionario.addEventListener("click", () => 
{
    popupFuncionario.classList.toggle("active");
});

closeButton.addEventListener("click", () => 
{
    popupFuncionario.classList.remove("active");
});