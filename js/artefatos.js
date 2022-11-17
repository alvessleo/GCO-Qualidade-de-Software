// PopUp Formulário criar Checklist

var criarchecklistBtn = document.getElementsByClassName("adicionar")[0];
var criarchecklist = document.getElementsByClassName("criar-checklist-container")[0];
var fecharcriarchecklist = document.getElementsByClassName("fechar-criar-checklist")[0];

criarchecklistBtn.addEventListener("click", () => 
{
    criarchecklist.classList.toggle("active");
});
fecharcriarchecklist.addEventListener("click", () => 
{
    criarchecklist.classList.remove("active");
});

// PopUp Checklists dos artefatos

var checklistsBtn = document.getElementsByClassName("checklistsBtn")[0];
var popUpChecklist = document.getElementsByClassName("popup-checklists")[0];
var fecharpopup = document.getElementById("fecharpopup");

checklistsBtn.addEventListener("click", () => 
{
    popUpChecklist.classList.toggle("active");
});
fecharpopup.addEventListener("click", () => 
{
    popUpChecklist.classList.remove("active");
});