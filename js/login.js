import { chamadaAPI, dadosSessao } from './api.js';
import { mostrarErro, botoesMaterial } from './auxiliar.js';

dadosSessao().then(res => {
	if (res)
		window.location.replace("/pages/empresas/empresas.php");
})

botoesMaterial();

document.getElementById("form-login").addEventListener("submit", (evento) => {

	evento.preventDefault();

	let usuario = document.getElementById("usuario").value;
	let senha = document.getElementById("senha").value;

	chamadaAPI("auth/login.php", {"usuario": usuario, "senha": senha}).then(res => {

		if (res.status != 200)
		{
			if ('json' in res && 'erro' in res.json)
				mostrarErro(res.json.erro);
			else
				mostrarErro("Erro de status ".concat(res.status));
		}
		else
			window.location.replace("/pages/empresas/empresas.php");

	});
	
});

