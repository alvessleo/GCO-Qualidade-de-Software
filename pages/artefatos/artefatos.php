<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api-interna/empresa.php');

if (!isset($_SESSION['codigo_usuario']) || !isset($_GET['codigo']) || !eFuncionario($_SESSION['codigo_usuario'], $_GET['codigo']))
  redirecionar('/pages/login/login.html');
  
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/dashboardnavbar/dashboard.css">
  <link rel="stylesheet" href="../../css/artefatos/artefatos.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/65ea520fa5.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php carregarComponente('sidebar.php'); ?>

  <!-- -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= CONTEÚDO MINHA EMPRESA -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

  <div class="formCriarArtefato">
    <div class="formContainer">
      <h2>Formulário Artefato</h2>
      <i class="fas fa-solid fa-plus closeArtefatoBtn"></i>
      <form action="">
        <div class="item">
          <p>Nome Artefato</p>
          <input type="text" placeholder="Artefato">
        </div>
        <div class="item">
          <p>Descrição</p>
          <textarea name="" id="" placeholder="Descrição"></textarea>
        </div>
        <div class="item">
          <p>Recurso</p>
          <input type="text" placeholder="Recurso">
        </div>
        <a href="#">Criar Artefato</a>
      </form>
    </div>
  </div>

  <div class="criar-checklist-container">
    <div class="criar-checklist-content">
      <div class="fechar-criar-checklist"><i class="fas fa-solid fa-plus fecharpopup"></i></div>
      <h2>Criar Checklist</h2>
      <form id="formNovaChecklist">
        <p>Nome da Checklist</p>
        <input id="nomenovachecklist" type="text" placeholder="Nome">
        <button type="submit">Criar Checklist</button>
      </form>
    </div>
  </div>

  <div class="popup-checklists">
    <div class="popup-container">
      <div class="fechar-icon"><i class="fas fa-solid fa-plus fecharpopup" id="fecharpopup"></i></div>
        <div class="title-content">
          <h2>Checklists do artefato <span id="nomeartefatolista">Desconhecido</span></h2>
          

          <?php
          
            if (eFuncionario($_SESSION['codigo_usuario'], $_GET['codigo'], true))
              echo '<i class="fas fa-solid fa-plus adicionar"></i>';
          ?>
          
        </div>
        <div id="checklist-cards" class="checklist-cards">

        </div>

        <div id="card-template" class="card">
          <div class="checklist-nome"><span>Nome: </span><p class="rnome"></p></div>
          <div class="autor"><span>Autor: </span><p class="rautor"></p></div>
          <div class="button-container">
            <button class='rvisualizar'>Visualizar Checklist</button>
          </div>
        </div>

        
    </div>
  </div>

  <section class="home-section">

    <div class="container-artefatos">

      <div class="company-info">
        <div class="name-user-company">
          <?php
              $empresa = obterRelacionadas()[$_GET['codigo']];

              echo '<h1>' . $empresa['nome'] . '</h1>
              <p class="nome">' . $empresa['dono'] .'</p>
              <p class="tag">Dono</p>';
          ?>
        </div>
      </div>

      <div class="artefato-container">
        <h2>Artefatos</h2>
        <i class="fas fa-solid fa-plus adicionarArtefato"></i>
      </div>

      <div class="artefatos-cards">


        <?php
          foreach (obterArtefatos($_GET['codigo']) as $artefato)
          {
            echo '
            <div class="card">
              <div class="artefato">'.$artefato['nome_artefato'].'</div>
              <div class="descricao">'.($artefato['descricao'] ? $artefato['descricao'] : "Sem descrição") .'</div>
              <div class="btns-container">
                <button class="card-btn checklistsBtn" nome="'. $artefato['nome_artefato'] .'" codigo="'. $artefato['codigo_artefato'] .'">Visualizar Checklists</button>
                <button class="card-btn recurso" onclick="window.location.assign(\''. $artefato['recurso'] .'\');">Visualizar Recurso</button>
              </div>
            </div>';

          }

        ?>
      </div>

    </div>

  </section>


  <script src="/js/artefatos.js" type="module"></script>
  
  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });

    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
      }
    }
  </script>

</body>

</html>