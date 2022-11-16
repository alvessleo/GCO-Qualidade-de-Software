import { chamadaAPI, dadosSessao } from './api.js';
import { mostrarErro, botoesMaterial } from './auxiliar.js';

dadosSessao().then(res => {
	if (res)
		window.location.replace("/pages/empresas/empresas.php");
})


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

	chamadaAPI("auth/cadastro.php", {"nome": nome, "usuario": usuario, "senha": senha}).then(res => {
		if (res.status != 201)
		{
			if ('json' in res && 'erro' in res.json)
				mostrarErro(res.json.erro);
			else
				mostrarErro("Erro de status ".concat(res.status));
		}
		else
			window.location.replace("/pages/login/login.html");

	});

});

