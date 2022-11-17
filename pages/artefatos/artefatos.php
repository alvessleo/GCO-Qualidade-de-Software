<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api-interna/empresa.php');

if (!isset($_SESSION['codigo_usuario']))
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

  <div class="criar-checklist-container">
    <div class="criar-checklist-content">
      <div class="fechar-criar-checklist"><i class="fas fa-solid fa-plus fecharpopup"></i></div>
      <h2>Criar Checklist</h2>
      <form action="">
        <p>Nome da Checklist</p>
        <input type="text" placeholder="Nome">
        <button>Criar Checklist</button>
      </form>
    </div>
  </div>

  <div class="popup-checklists">
    <div class="popup-container">
      <div class="fechar-icon"><i class="fas fa-solid fa-plus fecharpopup" id="fecharpopup"></i></div>
        <div class="title-content">
          <h2>Checklists do artefato <span>Repositório GitHub</span></h2>
          <i class="fas fa-solid fa-plus adicionar"></i>
        </div>
        <div class="checklist-cards">

          <div class="card">
            <div class="checklist-nome"><span>Nome:</span> Checklist 1</div>
            <div class="autor"><span>Autor:</span> Gustavo Guimarães</div>
            <div class="button-container">
              <button>Vizualizar Checklist</button>
            </div>
          </div>

          <div class="card">
            <div class="checklist-nome"><span>Nome:</span> Checklist 1</div>
            <div class="autor"><span>Autor:</span> Gustavo Guimarães</div>
            <div class="button-container">
              <button>Vizualizar Checklist</button>
            </div>
          </div>

          <div class="card">
            <div class="checklist-nome"><span>Nome:</span> Checklist 1</div>
            <div class="autor"><span>Autor:</span> Gustavo Guimarães</div>
            <div class="button-container">
              <button>Vizualizar Checklist</button>
            </div>
          </div>

          <div class="card">
            <div class="checklist-nome"><span>Nome:</span> Checklist 1</div>
            <div class="autor"><span>Autor:</span> Gustavo Guimarães</div>
            <div class="button-container">
              <button>Vizualizar Checklist</button>
            </div>
          </div>

          <div class="card">
            <div class="checklist-nome"><span>Nome:</span> Checklist 1</div>
            <div class="autor"><span>Autor:</span> Gustavo Guimarães</div>
            <div class="button-container">
              <button>Vizualizar Checklist</button>
            </div>
          </div>

        </div>
    </div>
  </div>

  <section class="home-section">

    <div class="container-artefatos">

      <div class="company-info">
        <div class="name-user-company">
          <h1>Company name</h1>
          <p class="nome">Leonardo Alves</p>
          <p class="tag">Diretor</p>
        </div>
      </div>

      <div class="artefato-container">
        <h2>Artefatos</h2>
      </div>

      <div class="artefatos-cards">

        <div class="card">
          <div class="artefato">Repositório GitHub</div>
          <div class="descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, delectus vitae! Beatae deleniti animi eligendi consequuntur perferendis est ea nihil! Nihil sed corporis reiciendis quod, dolorem amet tempora eligendi aliquid.</div>
          <div class="btns-container">
            <button class=" card-btn checklistsBtn">Vizualizar Checklists</button>
            <button class="card-btn recurso">Vizualizar Recurso</button>
          </div>
        </div>

        <div class="card">
          <div class="artefato">Repositório GitHub</div>
          <div class="descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, delectus vitae! Beatae deleniti animi eligendi consequuntur perferendis est ea nihil! Nihil sed corporis reiciendis quod, dolorem amet tempora eligendi aliquid.</div>
          <div class="btns-container">
            <button class=" card-btn checklistsBtn">Vizualizar Checklists</button>
            <button class="card-btn recurso">Vizualizar Recurso</button>
          </div>
        </div>

        <div class="card">
          <div class="artefato">Repositório GitHub</div>
          <div class="descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, delectus vitae! Beatae deleniti animi eligendi consequuntur perferendis est ea nihil! Nihil sed corporis reiciendis quod, dolorem amet tempora eligendi aliquid.</div>
          <div class="btns-container">
            <button class=" card-btn checklistsBtn">Vizualizar Checklists</button>
            <button class="card-btn recurso">Vizualizar Recurso</button>
          </div>
        </div>

      </div>

    </div>

  </section>


  <script src="../../js/artefatos.js"></script>
  <script src="../../js/minha_empresa.js"></script>
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