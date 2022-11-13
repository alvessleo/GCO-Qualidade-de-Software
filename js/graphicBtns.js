button1 = document.getElementsByClassName('conformidades-btn');
button2 = document.getElementsByClassName('funcionarios-btn');

function graficoConformidades() 
{
    document.getElementById('graphicconform').style.display = 'block', '!important';
    document.getElementById('graphicbars').style.display = 'none', '!important';
}

function graficoFuncionarios() 
{
    document.getElementById('graphicconform').style.display = 'none', '!important';
    document.getElementById('graphicbars').style.display = 'block', '!important';
}