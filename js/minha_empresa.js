import { chamadaAPI, dadosSessao } from './api.js';

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


document.getElementById("form-funcionario-mesmo").addEventListener("submit", (evento) => 
{

	evento.preventDefault();

	let codigo_usuario = document.getElementById("select-funcionarios").value;
	let codigo_empresa = document.getElementById("codempresa").value;
	let cargo = document.getElementById("cargo").value;
    let auditor = document.getElementById("auditor-new-funcionario").checked ? 1 : 0;

	chamadaAPI("empresa/adicionafuncionario.php", {"codigo_usuario": codigo_usuario, "codigo_empresa": codigo_empresa, "cargo": cargo, "auditor": auditor}).then(res => {
		if (res.status != 201)
		{
			if ('json' in res && 'erro' in res.json)
				alert(res.json.erro);
			else
				alert("Erro de status ".concat(res.status));
		}
		else
			window.location.reload();

	});
});