// Gerenciando o form
const form = document.querySelector("div.form-funcionario");

const teste = document.getElementById("add-func");
document.getElementById("add-func").style.color="black";

teste.addEventListener("click", () => {
    form.style.display="flex";
    console.log("oi")
});