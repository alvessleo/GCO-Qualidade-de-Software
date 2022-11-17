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
    <link rel="stylesheet" href="../../css/minha_empresa/minha_empresa.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/65ea520fa5.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php carregarComponente('sidebar.php'); ?>
  
  <!-- -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= CONTEÚDO MINHA EMPRESA -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  
  <section class="home-section">
    <div class="form-funcionario">
        <div class="content">
            <div class="close">
                <i class='bx bx-x'></i>
            </div>
            <form id="form-funcionario-mesmo">
                <h2>Adicione um funcionário a empresa!</h2>
                <p>
                    <label for="select-funcionarios">Selecione um funcionário:</label><br>
                    <select name="select-funcionarios" id="select-funcionarios" required>
                      <?php
                        foreach (obterNaoFuncionarios($_GET['codigo']) as $funcionario)
                        {
                          echo '<option value=' . $funcionario['codigo_usuario'] . '>' . $funcionario['nome'] . '</option>';
                        }

                      ?>
                    </select>
                </p>
                <p>
                    <label for="cargo">Insira o cargo:</label><br>
                    <input class="input" type="text" id="cargo" placeholder="Cargo aqui" required>
                </p>
                <p>
                    <label for="auditor-new-funcionario">É auditor?</label><br>
                    <input id="auditor-new-funcionario" type="checkbox">
                </p>

                <input id="codempresa" type="hidden" value=<?php echo $_GET['codigo']; ?>>
                <button type="submit" id="add-func" class="add-func">Adicionar funcionario</button>
            </form>
        </div>

    </div>
    <div class="container">
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
          <h2>Vizualizar Artefato</h2>
          <button class="viewArtefatos">Artefatos</button>
        </div>
        <div class="content">
            <div class="header">
                <h2>Funcionários ativos</h2>
                
                <button id="cadastrarFuncionario" style="display: <?php echo $empresa['codigo_dono'] == $_SESSION['codigo_usuario'] ? 'auto' : 'none'; ?>">Adicionar funcionário</button>
            </div>
            <table class="funcionarios-list" border="0">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Auditor</th>
                </tr>

                <?php
                  foreach (obterFuncionarios($_GET['codigo']) as $funcionario)
                  {
                    echo '<tr>
                      <td>' . $funcionario['codigo_usuario'] . '</td>
                      <td>' . $funcionario['nome'] . '</td>
                      <td>' . ($funcionario['cargo'] ? $funcionario['cargo'] : 'Nenhum') . '</td>
                      <td>' . ($funcionario['auditor'] ? 'Sim': 'Não') . '</td>
                    </tr>';
                  }

                ?>

            </table>
        </div>
    </div>  
  </section>
  <script src="/js/minha_empresa.js" type="module"></script>
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