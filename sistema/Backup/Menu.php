

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
        <h6 style="text-align: center;"> Backup</h6>
      </a>

    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
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
          <a href="../MenuPrincipal/index.html">
            <i class="now-ui-icons media-1_button-power"></i>
            <p class="title">Sair</p>
          </a>
        </li>
      </ul>
    </div>
  </div>