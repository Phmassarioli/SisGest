<!--

=========================================================
* Now UI Dashboard PRO - v1.6.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard-pro
* Copyright 2021 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->


<div class="wrapper ">
  <div class="sidebar" data-color="blue">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">

      <a class="simple-text logo-normal">
        <h5 class="title" style="text-align: center;"> SisGest</h5>
        <h6 style="text-align: center;">Relatório</h6>
      </a>

    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
        <li>
          <a href="../Relatorio/Relatorio.php">
            <i class="now-ui-icons files_paper"></i>
            <p class="title">Relatório</p>
          </a>
        </li>
        <li>
          <a href="../Relatorio/ComparativoAnual.php">
            <i class="now-ui-icons business_chart-bar-32"></i>
            <p class="title">Valores Dentro do Ano</p>
          </a>
        </li>
        <li>
          <a href="../Relatorio/Auditoria.php">
            <i class="now-ui-icons files_paper"></i>
            <p class="title">Auditoria</p>
          </a>
        </li>
        <li>
          <a href="../Backup/Backup.php" onclick="return confirm('Você Realmente Deseja Realizar o Backup ')">
            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
            <p class="title">Backup</p>
          </a>
        </li>
        <li>
          <a href="../Backup/Rest_Bkp.php" onclick="return confirm('Você Realmente Deseja Restaurar o Backup para o Banco de Dados ? ')">
            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
            <p class="title">Restaurar Backup</p>
          </a>
        </li>
        <li>
        <a href="../Relatorio/AjudaRelatorio.php">
        <i class="now-ui-icons business_bulb-63"></i>
            <p class="title">Ajuda</p>
          </a>
        </li>
        <li>
          <a href="../MenuPrincipal/index.html">
            <i class="now-ui-icons arrows-1_minimal-left"></i>
            <p class="title">Menu Principal</p>
          </a>
        </li>
      </ul>
    </div>
  </div>