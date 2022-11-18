import { chamadaAPI, dadosSessao } from './api.js';

var adicionarItem = document.getElementById("adicionarItem");
var popupItem = document.getElementsByClassName("form-funcionario")[0];
var titlePopUp = document.getElementById("titulo-popup");
var nomeItemPopUp = document.getElementById("nomeitem");
var estadoItemPopUp = document.getElementById("select-estado");
var comentarioItemPopUp = document.getElementById("comentarioitem");
var editOrCreate = document.getElementById("editOrCreate");


var closeButton = document.getElementsByClassName("close")[0];
var deleteButton = document.getElementsByClassName("remove-btn");
var editButton = document.getElementsByClassName("edit-btn");


var ultimoEditado = null;



adicionarItem.addEventListener("click", () => 
{
	popupItem.classList.toggle("active");
    titlePopUp.innerText = "Adicione um novo item ao checklist!";
	nomeItemPopUp.value = "";
	estadoItemPopUp.value = 4;
	comentarioItemPopUp.value = "";
	editOrCreate.value = "create";
});

closeButton.addEventListener("click", () => 
{
    popupItem.classList.remove("active");
});


Array.from(editButton).forEach((element) => {
	

	element.addEventListener("click", (evento) => {
		popupItem.classList.toggle("active");

		var codigo_itemChecklist = evento.target.getAttribute('codItemChecklist');
		ultimoEditado = codigo_itemChecklist;

		let linha = document.getElementById("tr_".concat(codigo_itemChecklist));
		let nome = linha.getElementsByClassName("r_item")[0].innerText;
		let estado = linha.getElementsByClassName("r_estado")[0].innerText;
		let comentario = linha.getElementsByClassName("r_comentario")[0].innerText;

		let codigoEstado = 0
		switch(estado) {
			case 'Não avaliado':
				codigoEstado = 1;
				break;
			case 'Atende':
				codigoEstado = 2;
				break;
			case 'Não atende':
				codigoEstado = 3;
				break;
			case 'Não se aplica':
				codigoEstado = 4;
				break;
		}
		titlePopUp.innerText = "Editar item do checklist";
		nomeItemPopUp.value = nome;
		estadoItemPopUp.value = codigoEstado;
		comentarioItemPopUp.value = comentario;
		editOrCreate.value = "edit";
	});
});

Array.from(deleteButton).forEach((element) => {

	element.addEventListener("click", (evento) => 
	{
		var codigo_itemChecklist = evento.target.getAttribute('codItemChecklist');
		
		chamadaAPI("checklist/deletaritem.php", {"codigo_itemChecklist": codigo_itemChecklist}).then(res => {
			if (res.status != 200)
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

})

document.getElementById("form-funcionario-mesmo").addEventListener("submit", (evento) => 
{
	evento.preventDefault();

	let codigo_estado = document.getElementById("select-estado").value;
	let codigo_checklist = document.getElementById("codchecklist").value;
	let item = document.getElementById("nomeitem").value;
    let comentarioitem = document.getElementById("comentarioitem").value;

	let request = {"codigo_checklist": codigo_checklist, "codigo_itemChecklist": null, "codigo_estado": codigo_estado, "item": item, "comentario": comentarioitem};
	
	if(editOrCreate.value === 'edit') {
		request = {"codigo_checklist": codigo_checklist, "codigo_itemChecklist": ultimoEditado, "codigo_estado": codigo_estado, "item": item, "comentario": comentarioitem};
	}

	chamadaAPI("checklist/adicionaroueditaritem.php", request).then(res => {
		if (res.status != 200)
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