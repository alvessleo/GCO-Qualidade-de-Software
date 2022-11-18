gravidade = document.getElementById("gravidade").textContent
backgroundCor = document.getElementsByClassName("cor")[0];
circulo = document.getElementsByClassName("circulo")[0];

//medio1 medio2
//complexo1 complexo2

if(gravidade === "Simples")
{
    backgroundCor.classList.toggle("simples1");
    circulo.classList.toggle("simples2");
}
else if(gravidade === "Média")
{
    backgroundCor.classList.toggle("medio1");
    circulo.classList.toggle("medio2");
}
else if(gravidade === "Complexa")
{
    backgroundCor.classList.toggle("complexo1");
    circulo.classList.toggle("complexo2");
}