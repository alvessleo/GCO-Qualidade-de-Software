import { chamadaAPI } from './api.js';

// PopUp Formulário criar Artefatos

var adicionarArtefato = document.getElementsByClassName("adicionarArtefato")[0];
var formCriarArtefato = document.getElementsByClassName("formCriarArtefato")[0];
var closeArtefatoBtn = document.getElementsByClassName("closeArtefatoBtn")[0];

adicionarArtefato.addEventListener("click", () => 
{
    formCriarArtefato.classList.toggle("active")
});
closeArtefatoBtn.addEventListener("click", () => 
{
    formCriarArtefato.classList.remove("active");
});

// PopUp Formulário criar Checklist

var ultimoArtefato = null;

var criarchecklistBtn = document.getElementsByClassName("adicionar");
var formNovaChecklist = document.getElementById("formNovaChecklist");
var criarchecklist = document.getElementsByClassName("criar-checklist-container")[0];
var fecharcriarchecklist = document.getElementsByClassName("fechar-criar-checklist")[0];

if (criarchecklistBtn.length > 0)
{
    criarchecklistBtn[0].addEventListener("click", () => 
    {
        criarchecklist.classList.toggle("active");
    });
}

fecharcriarchecklist.addEventListener("click", () => 
{
    criarchecklist.classList.remove("active");
});

// PopUp Checklists dos artefatos

var checklistsBtn = document.getElementsByClassName("checklistsBtn");
var popUpChecklist = document.getElementsByClassName("popup-checklists")[0];
var fecharpopup = document.getElementById("fecharpopup");



Array.from(checklistsBtn).forEach(element => {
    
    element.addEventListener("click", () => 
    {
        let listCards = document.getElementById('checklist-cards');
        let template = document.getElementById('card-template');
        let nomeArtefato = document.getElementById('nomeartefatolista');

        ultimoArtefato = element.getAttribute('codigo');
        nomeArtefato.innerText = element.getAttribute('nome');

        chamadaAPI("artefato/checklists.php", {"codigo_artefato": ultimoArtefato}).then(res => {

            if (res.status == 200)
            {
                listCards.replaceChildren();
                if ('json' in res)
                {
                    let algum = false;
                    for (var key in res.json)
                    {
                        algum = true;
                        let checklist = res.json[key];

                        let novoCard = template.cloneNode(true);               
                        
                        novoCard.removeAttribute('id');
                        novoCard.getElementsByClassName('rnome')[0].innerText = checklist.nome;
                        novoCard.getElementsByClassName('rautor')[0].innerText = checklist.nomecriador;
                        
                        let botaoVisualizarChecklist = novoCard.getElementsByClassName("rvisualizar");
                        botaoVisualizarChecklist[0].addEventListener("click", () =>
                        {
                            window.location.href = `/pages/checklist/checklist.php?codigo=${checklist.codigo_checklist}`;
                        });
                        
                        listCards.appendChild(novoCard);
                    }

                    if (!algum)
                        listCards.innerHTML = "<p>Nenhuma checklist para este artefato!</p>";

                }   
                else
                {
                    alert(res.text);
                }
                popUpChecklist.classList.toggle("active");
            }
            else
            {
                if ('json' in res && 'erro' in res.json)
                    alert(res.json.erro);
                else
                    alert("Erro de status ".concat(res.status));
            }
        });

    });

});


formNovaChecklist.addEventListener("submit", (event) => 
{
    event.preventDefault();

    let nome = document.getElementById("nomenovachecklist").value;
    
	chamadaAPI("artefato/criarchecklist.php", {"codigo_artefato": ultimoArtefato, "nome": nome}).then(res => {
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


document.getElementById("criarArtefatoConfirma").addEventListener("click", (event) => {
    
    let codigo_empresa = event.target.getAttribute('empresa');
    let nome_artefato = document.getElementById('ra_nome').value;
    let descricao = document.getElementById('ra_descricao').value;
    let recurso = document.getElementById('ra_recurso').value;

    chamadaAPI("artefato/cadastro.php", {"codigo_empresa": codigo_empresa, "nome_artefato": nome_artefato, "descricao": descricao, "recurso": recurso}).then(res => {
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

fecharpopup.addEventListener("click", () => 
 {
    popUpChecklist.classList.remove("active");
 });