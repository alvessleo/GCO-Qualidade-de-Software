import { chamadaAPI } from './api.js';
import { mostrarErro, botoesMaterial } from './auxiliar.js';

botoesMaterial();

document.getElementById("form-login").addEventListener("submit", (evento) => {

	evento.preventDefault();

	let usuario = document.getElementById("usuario").value;
	let senha = document.getElementById("senha").value;

	chamadaAPI("auth/login.php", {"usuario": usuario, "senha": senha}).then(resp => {

		if (resp.ok)
		{
			window.location.replace("/pages/dashboard/dashboard.html");
		}
		else
		{
			resp.json().then(json => {
				mostrarErro(json.erro);
			})
		}
		
	})
	
})

