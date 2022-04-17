<?php
error_reporting(0);
ob_start();
session_start();
$usuario = $_SESSION['usuario'];
include "../../conexao.php";

$act = $_REQUEST['act'];



$texto_botao = "Buscar por Periodo";


// Coleta de Dados Inseridos no Formulario Para Envio para a Consulta no Banco de Dados



if (isset($_POST['usuario'])) {

  $data = $_POST["data"];
  $dataf = $_POST["dataf"];
}

?>

<body>

  <?php
  // Aproveitamento de Codigo do Layout

  include "../head.php";
  include 'Menu.php';
  include "../navbar.php";
  include "../scripts.php";
  ?>
  <!-- Formulario -->

  <div class="panel-header-red panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-red"> Selecione um Periodo</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">


                <input type="hidden" id="usuario" name="usuario">

                <label>Data Inicio</label>
                <input class="form-control" type="date" id="$data" name="data" OnKeyPress="formatar('##/##/##', this)" />

                <br>

                <label>Data Fim</label>
                <input class="form-control" type="date" id="$dataf" name="dataf" OnKeyPress="formatar('##/##/##', this)" />

                <br>

                <button type="submit" id="btok" class="btn btn-danger "><?php echo $texto_botao; ?></button>

              </form>


            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabela de Valores do Banco de Dados -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-red">Gastos no Periodo</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive ">
              <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead class=" text-primary">
                  <tr>
                    <th class="title-color-red">Nome do Gasto</th>
                    <th class="title-color-red">Data do Gasto</th>
                    <th class="title-color-red">Local</th>
                    <th class="title-color-red">Valor do Gasto</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  // Consulta de Dados no Banco de Dados

                  $sql = "SELECT * FROM gastos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC";
                  $uquery = mysqli_query($con, $sql);
                  $total_usuarios = mysqli_num_rows($uquery);
                  while ($lncp = mysqli_fetch_object($uquery)) :
                    $ucod = $lncp->cod;
                    $unomegasto = $lncp->nomegasto;
                    $udata = $lncp->data;
                    $ulocal = $lncp->local;
                    $uvalorgasto = $lncp->valorgasto;




                  ?>

                    <!-- Apresentacao dos Valores do Banco de Dados -->

                    <tr>
                      <td class="datatable-color"><?php echo $unomegasto; ?></td>
                      <td class="datatable-color"><?php echo date('d/m/Y', strtotime($udata)); ?></td>
                      <td class="datatable-color"><?php echo $ulocal; ?></td>
                      <td class="p-3 mb-2 bg-danger text-white title">R$ <?php echo number_format($uvalorgasto, 2, ',', '.');  ?></td>

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
                <h5 class="title title-color-red"> Gastos Agrupados no Período</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead class=" text-primary">
                      <tr>
                        <th class="title-color-red">Nome do Gasto</th>
                        <th class="title-color-red">Valor do Gasto</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      //Consulta e Soma de Valores do Banco de Dados

                      $sql = "SELECT nomegasto, SUM(valorgasto) AS valorgasto FROM gastos WHERE data >='$data' AND data <= '$dataf' GROUP BY nomegasto";
                      $uquery = mysqli_query($con, $sql);
                      $total_usuarios = mysqli_num_rows($uquery);

                      while ($lncp = mysqli_fetch_object($uquery)) :
                        $ucod = $lncp->cod;
                        $unomegasto = $lncp->nomegasto;
                        $uvalorgasto = $lncp->valorgasto;




                      ?>
                        <!-- Apresentacao dos Valores do Banco de Dados -->

                        <tr>
                          <td class="datatable-color"><?php echo $unomegasto; ?></td>
                          <td class="p-3 mb-2 bg-danger text-white title">R$ <?php echo number_format($uvalorgasto, 2, ',', '.');  ?></td>

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
                    <h5 class="title title-color-red">Valor Total de Gastos no Periodo</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive ">
                      <table class="table">
                        <thead class=" text-primary">
                          <tr>
                            <th class="datatable-color">Gastos</th>
                            <th class="datatable-color">Dias Corridos</th>
                            <th class="datatable-color">Média Diária</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          //Consulta e Soma de Valores do Banco de Dados

                          $total = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");
                          $MediaDia = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");

                          //Calculo da Media diaria de Valores Somados

                          $teste = (($data_inicial = "$data") . ($data_final = "$dataf"));
                          $diferenca = strtotime($data_final) - strtotime($data_inicial);
                          $dias = floor($diferenca / (60 * 60 * 24));


                          //Soma de Valores do Banco de Dados

                          while ($sum = mysqli_fetch_array($total)) :

                            $soma = 'R$ ' . number_format($sum['SUM(valorgasto)'], 2, ',', '.');

                          endwhile;



                          //Calculo da Media diaria de Valores Somados

                          while ($sum = mysqli_fetch_array($MediaDia)) :

                            $MediaDiaria = 'R$ ' . number_format($sum['SUM(valorgasto)'] / $dias, 2, ',', '.');

                          endwhile;



                          ?>
                          <!-- Apresentacao dos Valores do Banco de Dados -->


                          <tr>

                            <td class="text-danger title"><?php echo $soma; ?></td>
                            <td class="text-danger title"><?php echo $dias; ?></td>
                            <td class="text-danger title"><?php echo $MediaDiaria; ?></td>
                            <td>

                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>



                <a href="../Gastos/GastosEspecificos.php" class="btn btn btn-danger">
                  <i></i>
                  Consultar Gasto Especifico
                </a>



                <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   
    <?php

    include "../footer.php";


    ?>