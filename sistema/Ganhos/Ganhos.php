<?php
error_reporting(0);
ob_start();
session_start();
$usuario = $_SESSION['usuario'];
include "../../conexao.php";

$act = $_REQUEST['act'];



$texto_botao = "Buscar por Periodo";


// Coleta de dados do Formulario para Consulta no Banco de Dados



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
  <div class="panel-header-green panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-green"> Selecione um Periodo</h5>
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

                <button type="submit" id="btok" class="btn btn-success"><?php echo $texto_botao; ?></button>

              </form>


            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabela de Dados no Banco de Dados -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-green">Ganhos Dentro do Periodo</h5>
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

                  $sql = "SELECT * FROM ganhos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC";
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

                      $sql = "SELECT nomeganho, SUM(valor) AS valor FROM ganhos WHERE data >='$data' AND data <= '$dataf' GROUP BY nomeganho";
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
                    <h5 class="title title-color-green">Valor Total de Ganhos Dentro do Periodo</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive ">
                      <table class="table">
                        <thead class=" text-primary">
                          <tr>
                            <th class="datatable-color">Ganhos</th>
                            <th class="datatable-color">Dias Corridos</th>
                            <th class="datatable-color">M??dia Di??ria</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          //consulta e Soma de Valores no Banco de Dados
                          $total = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");
                          $MediaDia = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");

                          //Calculo da Media diaria de Valores Somados
                          $teste = (($data_inicial = "$data") . ($data_final = "$dataf"));
                          $diferenca = strtotime($data_final) - strtotime($data_inicial);
                          $dias = floor($diferenca / (60 * 60 * 24));



                          //Soma de Valores no Banco de Dados 

                          while ($sum = mysqli_fetch_array($total)) :

                            $soma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                          endwhile;


                          //Calculo da Media diaria de Valores Somados

                          while ($sum = mysqli_fetch_array($MediaDia)) :

                            $MediaDiaria = 'R$ ' . number_format($sum['SUM(valor)'] / $dias, 2, ',', '.');

                          endwhile;

                          ?>
                          <!-- Apresentacao dos Valores do Banco de Dados -->


                          <tr>

                            <td class="text-success title"><?php echo $soma; ?></td>
                            <td class="text-success title"><?php echo $dias; ?></td>
                            <td class="text-success title"><?php echo $MediaDiaria; ?></td>
                            <td>

                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>



                <a href="../Ganhos/GanhosEspecificos.php" class="btn btn-success">
                  <i></i>
                  Consultar Ganho Especifico
                </a>


                <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conex??o
    mysqli_close($con); ?>
   
    <?php

    include "../footer.php";


    ?>