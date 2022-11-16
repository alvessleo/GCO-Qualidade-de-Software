import { chamadaAPI, dadosSessao } from './api.js';
import { mostrarErro, botoesMaterial } from './auxiliar.js';

dadosSessao().then(res => {
	if (!res)
		window.location.replace("/pages/login/login.html");
})

botoesMaterial();

document.getElementById("form-cadastro_empresa").addEventListener("submit", (evento) => {

	evento.preventDefault();

	let nome = document.getElementById("nome").value;
	let cargo = document.getElementById("cargo").value;
    let auditor = document.getElementById("auditor").checked ? 1 : 0;

	chamadaAPI("empresa/cadastro.php", {"nome": nome, "cargo": cargo, "auditor": auditor}).then(res => {
		if (res.status != 201)
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

