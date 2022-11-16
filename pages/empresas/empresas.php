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
  <link rel="stylesheet" href="../../css/empresas/empresas.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/65ea520fa5.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-loader-circle icon'></i>
      <div class="logo_name">Conformity</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <i class='bx bx-search'></i>
        <input type="text" placeholder="Search...">
        <span class="tooltip">Procurar</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-building'></i>
          <span class="links_name">Minha empresa</span>
        </a>
        <span class="tooltip">Minha empresa</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-check-square' ></i>
          <span class="links_name">Checklist</span>
        </a>
        <span class="tooltip">Checklist</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bxs-analyse bx-flip-horizontal' ></i>
          <span class="links_name">Não conformidades</span>
        </a>
        <span class="tooltip">Não conformidades</span>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-log-in-circle'></i>
          <span class="links_name">Login</span>
        </a>
        <span class="tooltip">Login</span>
      </li>
  
      <li class="profile">
        <div class="profile-details">
          <!--<img src="profile.jpg" alt="profileImg">-->
          <div class="name_job">
            <div class="name">Kelly Bettio</div>
            <div class="job">Analista de qualidade</div>
          </div>
        </div>
        <i class='bx bx-log-out' id="log_out"></i>
      </li>
    </ul>
  </div>

  <!-- -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= CONTEÚDO EMPRESAS -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  
  <section class="home-section">
        <div class="home-section-title">Suas empresas</div>

      <div class="empresa-content">

      <?php
        foreach (obterRelacionadas() as $empresa)
        {  
          echo '<div class="card">
                <div class="faq">
                    <div class="func-collapse">
                      <div class="info">
                        <p><span>Nome da empresa: </span>' . $empresa['nome'] . '</p>
                        <p>Ver informações</p>
                      </div>
                      <i class="fas fa-regular fa-chevron-down"></i>
                    </div>
                    <div class="func-dados">
                      <p class="text-collapse"><span>Dono da empresa: </span>' . $empresa['dono'] . '</p>
                      <p class="text-collapse"><span>Seu cargo: </span>' . ($empresa['cargo'] ? $empresa['cargo'] : 'Nenhum') . '</p>
                      <p class="text-collapse"><span>Atua como auditor? </span>' . ($empresa['auditor'] ? 'Sim' : 'Não') . '</p>
                    </div>
                  </div>
                  <button class="acessar" onclick="location.href=\'../empresa_checklists/empresa_checklists.html\'">Acessar</button>
            </div>';

        }
      ?>
        
      </div>

  </section>
  <script src="../../js/collapse.js"></script>
  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();//calling the function(optional)
    });

    searchBtn.addEventListener("click", () => { // Sidebar open when you click on the search iocn
      sidebar.classList.toggle("open");
      menuBtnChange(); //calling the function(optional)
    });

    // following are the code to change sidebar button(optional)
    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");//replacing the iocns class
      }
    }
  </script>
</body>

</html>