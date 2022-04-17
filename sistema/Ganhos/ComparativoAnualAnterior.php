<?php
error_reporting(0);
ob_start();
session_start();

$usuario = $_SESSION['usuario'];
include "../../conexao.php";
$act = $_REQUEST['act'];
$texto_botao = "Consultar Este Ano";


// Coleta de Dados do Formulario Para Consulta

if (isset($_POST['usuario'])) {

  $ano = $_POST["ano"];
}


// Variaveis de Dias e Meses para Calculo   

$mes = ('12');
$dia = date('365');

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
            <h5 class="title title-color-green"> Selecione um Ano</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">

                <input type="hidden" id="usuario" name="usuario">

                <label>Data Inicio</label>
                <input class="form-control" type="number" id="$ano" name="ano" OnKeyPress="formatar('##/##/##', this)" />
                <br>

                <button type="submit" id="btok" class="btn btn-success"><?php echo $texto_botao; ?></button>

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
            <h5 class="title title-color-green"> Ganhos Dentro do Ano de <?php echo "$ano" ?></h5>
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
                <h5 class="title title-color-green">Valor Total de Ganhos Dentro do Ano de <?php echo "$ano" ?></h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th class="datatable-color">Ganhos </th>
                        <th class="datatable-color">Média Mensal</th>
                        <th class="datatable-color">Média Diária</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      //Consulta e Soma de Valores Agrupados no Banco de Dados

                      $ctotal = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                      //Soma de Valores do Banco de Dados

                      while ($sum = mysqli_fetch_array($ctotal)) :

                        $csoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                      endwhile;



                      $MediaMensalContas = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");

                      while ($sum = mysqli_fetch_array($MediaMensalContas)) :

                        $MediaSomaContas = 'R$ ' . number_format($sum['SUM(valor)'] / $mes, 2, ',', '.');

                      endwhile;


                      //Soma de Valores e Calculo da Media Mensal do Banco de Dados

                      $MediaDiariaContas = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");

                      $teste = "30";

                      while ($sum = mysqli_fetch_array($MediaDiariaContas)) :

                        $MediaDiariaContas = 'R$ ' . number_format($sum['SUM(valor)'] / $mes / $teste, 2, ',', '.');

                      endwhile;

                      ?>

                      <!-- Apresentacao dos Valores do Banco de Dados -->

                      <tr>

                        <td class="text-success title"><?php echo $csoma; ?></td>
                        <td class="text-success title"><?php echo $MediaSomaContas; ?></td>
                        <td class="text-success title"><?php echo $MediaDiariaContas; ?></td>
                        <td>

                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>







          </div>





          <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   
    <?php

    include "../footer.php";

    ?>