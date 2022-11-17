graficoConformidades = document.getElementById("comformidadesGraphic");
ConformidadesBtn = document.getElementById("conformidades-btn");
graficoFuncionarios = document.getElementById("FuncionariosGraphic");
funcionariosBtn = document.getElementById("funcionarios-btn");

ConformidadesBtn.addEventListener("click", () => 
{
    graficoConformidades.classList.toggle("active");
    graficoFuncionarios.classList.remove("active");
});
funcionariosBtn.addEventListener("click", () => 
{
    graficoFuncionarios.classList.toggle("active");
    graficoConformidades.classList.remove("active");
});