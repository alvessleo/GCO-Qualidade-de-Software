function mostrarErro(texto = "Erro desconhecido")
{
    let alerts = document.getElementById('alerts');
    let textoerro = document.getElementById('texto-erro');

    alerts.style.display = "flex";
    textoerro.innerText = texto;

    setTimeout(() => {
        alerts.style.display = "none";
    }, 5000);
}

function botoesMaterial()
{
    const inputs = document.querySelectorAll(".input");

    inputs.forEach(input => {
        input.addEventListener("focus", (event) => {
            let parent = event.target.parentNode.parentNode;
            parent.classList.add("focus");
        });

        input.addEventListener("blur", (event) => {
            let parent = event.target.parentNode.parentNode;
            if(event.target.value == ""){
                parent.classList.remove("focus");
            }
            
        });

    });

}

export { mostrarErro, botoesMaterial };