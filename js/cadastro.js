import { chamadaAPI } from './api.js';
import { mostrarErro, botoesMaterial } from './auxiliar.js';

botoesMaterial();

document.getElementById("form-cadastro").addEventListener("submit", (evento) => {

	evento.preventDefault();

    let nome = document.getElementById("nome").value;
	let usuario = document.getElementById("usuario").value;
	let senha = document.getElementById("senha").value;
    let confirmaSenha = document.getElementById("confirma-senha").value;

    if (senha != confirmaSenha)
    {
        mostrarErro("As senhas não coincidem");
        return;
    }

	chamadaAPI("auth/cadastro.php", {"nome": nome, "usuario": usuario, "senha": senha}).then(resp => {

		if (resp.ok)
		{
			window.location.replace("/pages/login/login.html");
		}
		else
		{
			resp.json().then(json => {
				mostrarErro(json.erro);
			})
		}
		
	})
	
})

