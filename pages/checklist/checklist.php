<?php 
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api-interna/checklist.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/api-interna/empresa.php');

if (!isset($_SESSION['codigo_usuario']))
  redirecionar('/pages/login/login.html');
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">

<head>
  <meta charset="UTF-8">
  <title>Checklist</title>
  <link rel="stylesheet" href="../../css/checklist/checklist.css">
  <link rel="stylesheet" href="../../css/dashboardnavbar/dashboard.css">
  <link rel="stylesheet" href="../../css/dashboard/dashboard.css">
  <link rel="stylesheet" href="../../css/minha_empresa/minha_empresa.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/65ea520fa5.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php carregarComponente('sidebar.php'); 
  
    $itens = obterItens($_GET['codigo']);
    
    $total_itens = 0;
    $naoavaliado_itens = 0;
    $naoatende_itens = 0;
    $atende_itens = 0;
    $naoaplica_itens = 0;

    foreach ($itens as $item)
    {

      switch($item['codigo_estado'])
      {
        case 1:
          ++$naoavaliado_itens;
          break;
        case 2:
          ++$atende_itens;
          break;
        case 3:
          ++$naoatende_itens;
          break;
        case 4:
          ++$naoaplica_itens;
          break;
      }

      ++$total_itens;
    }

    $porcentagem_aderencia = floor((1 - ($naoatende_itens / $total_itens)) * 100);
  
  ?>

  <!-- -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= CONTEÚDO HOME DASHBOARD -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
  
  <section class="home-section padding">
  <div class="form-funcionario">
        <div class="content">
            <div class="close">
                <i class='bx bx-x'></i>
            </div>
            <form id="form-funcionario-mesmo">
                <h2 id="titulo-popup"></h2>
                <p>
                    <label for="nomeitem">Insira o nome do item:</label><br>
                    <input class="input" type="text" id="nomeitem" placeholder="Nome aqui" required>
                </p>

                <p>
                    <label for="select-estado">Conformidade:</label><br>
                    <select name="select-estado" id="select-estado" required>
                      <option value="1">Não avaliado</option>
                      <option value="2">Atende</option>
                      <option value="3">Não Atende</option>
                      <option value="4">N/A</option>
                    </select>
                </p>
                
                <p>
                    <label for="comentarioitem">Insira um comentário:</label><br>
                    <textarea class="textareatextarea" type="text" id="comentarioitem" placeholder="Comentário aqui" required></textarea>
                </p>

                <input id="codchecklist" type="hidden" value=<?php echo $_GET['codigo']; ?>>
                <input id="editOrCreate" type="hidden" value="edit">
                <button type="submit" id="add-func" class="add-func">Adicionar item</button>
            </form>
        </div>

    </div>

    <div class="home-section-title">Informações Relevantes</div>




    <div class="cards-content">

      <div class="cards">
        <div id="nc_atende" class="number"><?php echo $atende_itens; ?></div>
        <div class="text-card">Conformidades</div>
      </div>

      <div class="cards">
        <div class="number"><div id="nc_naoatende" class="number"><?php echo $naoatende_itens; ?></div></div>
        <div class="text-card">Não conformidades</div>
      </div>

      <div class="cards">
        <div class="number"><div class="number" id="nc_naoavaliado" ><?php echo $naoavaliado_itens; ?></div></div>
        <div class="text-card">Não avaliados</div>
      </div>

      <div class="cards">
        <div class="number"><div class="number" id="nc_naoaplica" ><?php echo $naoaplica_itens; ?></div></div>
        <div class="text-card">Não pertinentes</div>
      </div>

      <div id="ctx_conformidade_container">
        <canvas id="ctx_conformidade"></canvas>
        <div>
          <div class="number"><?php echo $porcentagem_aderencia; ?>%</div>
          <div class="text-card">Aderencia</div>
        </div>
      </div>

    </div>

    <!-- -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= CONTEÚDO GRÁFICOS -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

    <!-- -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= CONTEÚDO CHECKLIST -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

    <?php $auditor = eAuditorChecklist($_SESSION['codigo_usuario'], $_GET['codigo']); ?>

    
    <div class="checklist-envelope">
        <h1 class="title-table"> <?php echo obterChecklist($_GET['codigo'])['nome']; ?></h1>

        <div class="checklist-content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Conformidade</th>
                        <th>Comentário</th>

                        <?php if ($auditor) {echo '<th></th>';} ?>
                        
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $contador = 1;
                    foreach ($itens as $item)
                    {
                      echo '<tr id="tr_'.$item['codigo_itemChecklist'].'">
                          <td>' . $contador++ . '</td>
                          <td class="r_item">'. $item['item'] . '</td>
                          <td class="r_estado">' . $item['estado']. '</td>
                          <td class="r_comentario">' . $item['comentario']. '</td>';
                          
                          if ($auditor)
                          {
                            echo '<td>
                              <button class="edit-btn" codItemChecklist="'. $item['codigo_itemChecklist'] .'"><i class="bx bxs-edit"></i></button> 
                              <button class="remove-btn" codItemChecklist="'. $item['codigo_itemChecklist'] .'"><i class="bx bxs-trash"></i> </button>
                            </td>';
                          }

                      echo '</tr>';
                    }

                    ?>
                </tbody>
            </table>

        </div>

        <div class="plus-icon-content" id="adicionarItem">

            <?php if ($auditor) {echo '<div class="plus-icon"><i class="fas fa-light fa-plus"></i></div>';} ?>
                
        </div>
    </div>
  </section>


  <script src="../../js/graphics.js"></script>
  <script src="../../js/collapse.js"></script>
  <script src="../../js/graphicBtns.js"></script>
  
  <script src="/js/checklist.js" type="module"></script>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");

    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();//calling the function(optional)
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