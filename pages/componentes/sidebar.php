<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/api/cabecalhos.php');
?>

<script src="/js/api.js" type="module"></script>

<div class="sidebar">
  <div class="logo-details">
    <i class='bx bx-loader-circle icon'></i>
    <div class="logo_name">Conformity</div>
    <i class='bx bx-menu' id="btn"></i>
  </div>
  <ul class="nav-list" id="comp-sidebar">
    <li>
      <a href="#">
        <i class='bx bx-error-alt'></i>
        <span class="links_name">Minhas NC</span>
      </a>
      <span class="tooltip">Minhas NC</span>
    </li>
    <li>
      <a href="/pages/empresas/empresas.php">
        <i class='bx bx-building'></i>
        <span class="links_name">Empresas</span>
      </a>
      <span class="tooltip">Empresas</span>
    </li>
    <li>
      <a href="/pages/cadastro/empresa_cadastro.html">
        <i class="fas fa-solid fa-plus"></i>
        <span class="links_name">Criar Empresa</span>
      </a>
      <span class="tooltip">Criar Empresa</span>
    </li>

    <li class="profile">
      <div class="profile-details">
        <!--<img src="profile.jpg" alt="profileImg">-->
        <div class="name_job">
          <div class="name"><?php echo $_SESSION['nome'] ?></div>
          <div class="job"><?php echo $_SESSION['usuario'] ?></div>
        </div>
      </div>
      <i class='bx bx-log-out' id="log_out"></i>
    </li>
  </ul>
</div>
<script src="/js/sidebar.js" type="module"></script>