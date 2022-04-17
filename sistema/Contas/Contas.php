<?php
error_reporting(0);
ob_start();
session_start();


$usuario = $_SESSION['usuario'];
include "../../conexao.php";
$act = $_REQUEST['act'];




$texto_botao = "Buscar por Periodo";


// Coleta de dados Inseridos para Consulta no Banco de Dados


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


  <!-- Formulario de Consulta -->

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

                <button type="submit" id="btok" class="btn btn-danger"><?php echo $texto_botao; ?></button>

              </form>


            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Tabela de Dados do Banco de Dados Dentro da Consulta -->


    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-red">Contas Pagas no Periodo</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive ">
              <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead class=" text-primary">
                  <tr>
                    <th class="title-color-red">Nome da Conta</th>
                    <th class="title-color-red">Data Pagamento</th>
                    <th class="title-color-red">Local</th>
                    <th class="title-color-red">Valor da Conta</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  // Consulta de Dados do Banco de Dados

                  $sql = "SELECT * FROM contasfixas WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC";
                  $uquery = mysqli_query($con, $sql);
                  $total_usuarios = mysqli_num_rows($uquery);
                  while ($lncp = mysqli_fetch_object($uquery)) :
                    $ucod = $lncp->cod;
                    $unomeconta = $lncp->nomeconta;
                    $udata = $lncp->data;
                    $ulocal = $lncp->local;
                    $uvalor = $lncp->valor;




                  ?>

                    <tr>
                      <td class="datatable-color"><?php echo $unomeconta; ?></td>
                      <td class="datatable-color"><?php echo date('d/m/Y', strtotime($udata)); ?></td>
                      <td class="datatable-color"><?php echo $ulocal; ?></td>
                      <td class="p-3 mb-2 bg-danger text-white title">R$ <?php echo number_format($uvalor, 2, ',', '.');  ?></td>

                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!--Soma de Valores do Banco de Dados -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title title-color-red">Valor Total de Contas Pagas no Periodo</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th class="datatable-color">Contas Pagas</th>
                        <th class="datatable-color">Dias Corridos</th>
                        <th class="datatable-color">Média Diaria</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php


                      // Consulta e Soma de Valores do Banco de Dados

                      $total = mysqli_query($con, "SELECT SUM(valor) FROM contasfixas WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");

                      // Consulta e Calculo da Media de Valores em dias Contados

                      $mediaDia = mysqli_query($con, "SELECT SUM(valor) FROM contasfixas WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");


                      $teste = (($data_inicial = "$data") . ($data_final = "$dataf"));
                      $diferenca = strtotime($data_final) - strtotime($data_inicial);
                      $dias = floor($diferenca / (60 * 60 * 24));


                      // Soma de Valores Totais

                      while ($sum = mysqli_fetch_array($total)) :

                        $tcfpsoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                      endwhile;


                      // Soma de Valores Totais e Calculo da Media de Dias Contados

                      while ($sum = mysqli_fetch_array($mediaDia)) :

                        $MediaDiaria = 'R$ ' . number_format($sum['SUM(valor)'] / $dias, 2, ',', '.');

                      endwhile;


                      ?>


                      <tr>

                        <td class="text-danger title"><?php echo $tcfpsoma; ?></td>
                        <td class="text-danger title"><?php echo $dias; ?></td>
                        <td class="text-danger title"><?php echo $MediaDiaria; ?></td>
                        <td>

                        </td>
                      </tr>
                      <?php ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>





            <a href="../Contas/ContasEspecificas.php" class="btn btn-danger">
              <i></i>
              Consultar Conta Especifica
            </a>





            <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   

    <?php

    include "../footer.php";

    ?>