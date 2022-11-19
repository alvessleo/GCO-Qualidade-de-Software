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

  <?php carregarComponente('sidebar.php'); ?>

  <!-- -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= CONTEÚDO EMPRESAS -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

  <section class="home-section">
    <div class="home-section-title">Suas empresas</div>

    <div class="empresa-section">
      <div class="empresa-content-cards">

        <?php
        foreach (obterRelacionadas() as $empresa) {
          echo
          '
                <div class="empresa-card">
                  <p><span>Nome da Empresa: </span>' . $empresa['nome'] . '</p>
                  <p><span>Dono da Empresa: </span>' . $empresa['dono'] . '</p>
                  <p><span>Seu Cargo: </span>' . ($empresa['cargo'] ? $empresa['cargo'] : 'Nenhum') . '</p>
                  <p><span>Atua Como Auditor? </span>' . ($empresa['auditor'] ? 'Sim' : 'Não') . '</p>
                  <button class="empresa-btn" onclick="location.href=\'/pages/minha-empresa/minha-empresa.php?codigo=' . $empresa['codigo_empresa'] . '\'">Acessar</button>
                </div>
            ';
        }
        ?>


      </div>
    </div>

  </section>
  <script src="../../js/collapse.js"></script>
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