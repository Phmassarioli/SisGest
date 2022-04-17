<?php
error_reporting(0);
ob_start();
session_start();

$usuario = $_SESSION['usuario'];
include "../../conexao.php";
$act = $_REQUEST['act'];
$texto_botao = "Buscar por Periodo";

// Variaveis de Dias, Meses e ano para Calculo   

$ano = date('Y');
$mes = date('m');
$dia = date('d');

?>

<body>

  <?php
  // Aproveitamento de Codigo do Layout

  include "../head.php";
  include 'Menu.php';
  include "../navbar.php";
  include "../scripts.php";
  ?>
  <!-- Tabela de Valores do Banco de Dados -->

  <div class="panel-header-green panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-green"> Valores de Ganhos dentro do Ano de <?php echo "$ano" ?></h5>
          </div>
          <div class="card-body">
            <div class="table-responsive ">
              <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead class=" text-primary">
                  <tr>
                    <th class="title-color-green">Nome do Ganho</th>
                    <th class="title-color-green">Origem do Ganho</th>
                    <th class="title-color-green">Data do Ganho</th>
                    <th class="title-color-green">Valor do Ganho</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  // Consulta de Dados no Banco de Dados

                  $sql = "SELECT * FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'";
                  $uquery = mysqli_query($con, $sql);
                  $total_usuarios = mysqli_num_rows($uquery);
                  while ($lncp = mysqli_fetch_object($uquery)) :
                    $ucod = $lncp->cod;
                    $unomeganho = $lncp->nomeganho;
                    $uorigemganho = $lncp->origemganho;
                    $udata = $lncp->data;
                    $uvalor = $lncp->valor;


                  ?>
                    <!-- Apresentacao dos Valores do Banco de Dados -->

                    <tr>
                      <td class="datatable-color"><?php echo $unomeganho; ?></td>
                      <td class="datatable-color"><?php echo $uorigemganho; ?></td>
                      <td class="datatable-color"><?php echo date('d/m/Y', strtotime($udata)); ?></td>
                      <td class="p-3 mb-2 bg-success text-white title">R$ <?php echo number_format($uvalor, 2, ',', '.');  ?></td>

                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title title-color-green"> Valor Total de Ganhos Agrupados Dentro do Periodo</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead class=" text-primary">
                      <tr>
                        <th class="title-color-green">Nome do Ganho</th>
                        <th class="title-color-green">Valor do Ganho</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      // Consulta de Dados Agrupados no Banco de Dados

                      $sql = "SELECT nomeganho, SUM(valor) AS valor FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31' GROUP BY nomeganho";
                      $uquery = mysqli_query($con, $sql);
                      $total_usuarios = mysqli_num_rows($uquery);

                      while ($lncp = mysqli_fetch_object($uquery)) :
                        $ucod = $lncp->cod;
                        $unomeganho = $lncp->nomeganho;
                        $uvalor = $lncp->valor;




                      ?>
                        <!-- Apresentacao dos Valores do Banco de Dados -->

                        <tr>
                          <td class="datatable-color"><?php echo $unomeganho; ?></td>
                          <td class="p-3 mb-2 bg-success text-white title">R$ <?php echo number_format($uvalor, 2, ',', '.');  ?></td>

                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title title-color-green">Total de Ganhos Dentro do Ano de <?php echo "$ano" ?></h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th class="datatable-color">Valor Total de gastos </th>
                        <th class="datatable-color">Média Mensal</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      //Consulta e Soma de Valores do Banco de Dados

                      $ctotal = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                      //Soma de Valores do Banco de Dados

                      while ($sum = mysqli_fetch_array($ctotal)) :

                        $csoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                      endwhile;

                      //Consulta e Soma de Valores do Banco de Dados

                      $MediaMensalContas = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");




                      //Soma de Valores e Calculo da Media Mensal no Banco de Dados

                      while ($sum = mysqli_fetch_array($MediaMensalContas)) :

                        $MediaSomaContas = 'R$ ' . number_format($sum['SUM(valor)'] / $mes, 2, ',', '.');

                      endwhile;

                      ?>

                      <!-- Apresentacao dos Valores do Banco de Dados -->

                      <tr>

                        <td class="text-success title"><?php echo $csoma; ?></td>
                        <td class="text-success title"><?php echo $MediaSomaContas; ?></td>
                        <td>

                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>



            <!-- Grafico Comparativo entre Meses -->

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title title-color-green">Comparativo de Ganhos Dentro do Ano de <?php echo "$ano" ?></h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive ">
                      <thead class=" text-primary">

                        <div class="ct-chart ct-perfect-fourth"></div>


                        <!-- Link do Grafico -->

                        <div class="col-md-12"><img alt="" src="../Graficos/GraficoGanhos.php" title=""></div>





                      </thead>
                    </div>
                  </div>
                </div>



                <a href="../Ganhos/ComparativoAnualAnterior.php" class="btn btn-success">
                  <i></i>
                  Consultar Anos Anteriores
                </a>









                <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   

    <?php

    include "../footer.php";

    ?>