<?php
error_reporting(0);
ob_start();
session_start();

$usuario = $_SESSION['usuario'];
include "../../conexao.php";
$act = $_REQUEST['act'];

// Variaveis de Dias, Meses e ano para Calculo   

$ano = date('Y');
$mes = date('m');
$dia = date('d');

?>

<body>

  <?php
  // Aproveitamento de Codigo do Layout

  include "../head.php";
  include '../Cofre/Menu.php';
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
            <h5 class="title title-color-green"> Valores Lancados no Cofre dentro do Ano de <?php echo "$ano" ?></h5>
          </div>
          <div class="card-body">
            <div class="table-responsive ">
              <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead class=" text-primary">
                  <tr>
                    <th class="title-color-green">Nome da Carteira</th>
                    <th class="title-color-green">Quantidade de Titulos</th>
                    <th class="title-color-green">Data do Aporte</th>
                    <th class="title-color-green">Intituição/Corretora</th>
                    <th class="title-color-green">Valor Unitário</th>
                    <th class="title-color-green">Valor Total</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  // Consulta de Dados no Banco de Dados

                  $sql = "SELECT * FROM cofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'";
                  $uquery = mysqli_query($con, $sql);
                  $total_usuarios = mysqli_num_rows($uquery);
                  while ($lncp = mysqli_fetch_object($uquery)) :
                    $ucod = $lncp->cod;
                    $unome = $lncp->nome;
                    $uquantidadeTitulo = $lncp->quantidadetitulo;
                    $uvalorUnitario = $lncp->valorunitario;
                    $udata = $lncp->data;
                    $uinstituicao = $lncp->instituicao;
                    $uvalor = $lncp->valortotal;


                  ?>
                    <!-- Apresentacao dos Valores do Banco de Dados -->

                    <tr>
                      <td class="datatable-color"><?php echo $unome; ?></td>
                      <td class="datatable-color center"><?php echo $uquantidadeTitulo; ?></td>
                      <td class="datatable-color"><?php echo date('d/m/Y', strtotime($udata)); ?></td>
                      <td class="datatable-color"><?php echo $uinstituicao; ?></td>
                      <td class="">R$ <?php echo number_format($uvalorUnitario, 2, ',', '.');  ?></td>
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
                <h5 class="title title-color-green">Total de Valores Agrupados Lancados no Cofre dentro do Ano de <?php echo "$ano" ?></h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead class=" text-primary">
                      <tr>
                        <th class="title-color-green">Nome da Carteira</th>
                        <th class="title-color-green">Valor Total</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      //Consulta e Soma de Valores Agrupados no Banco de Dados

                      $sql = "SELECT nome, SUM(valortotal) AS valortotal FROM cofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31' GROUP BY nome";
                      $uquery = mysqli_query($con, $sql);
                      $total_usuarios = mysqli_num_rows($uquery);

                      while ($lncp = mysqli_fetch_object($uquery)) :
                        $ucod = $lncp->cod;
                        $unome = $lncp->nome;
                        $uvalor = $lncp->valortotal;




                      ?>
                        <!-- Apresentacao dos Valores do Banco de Dados -->

                        <tr>
                          <td class="datatable-color"><?php echo $unome; ?></td>
                          <td class="p-3 mb-2 bg-success text-white title">R$ <?php echo number_format($uvalor, 2, ',', '.');  ?></td>

                        </tr>
                      <?php endwhile; ?>
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
                    <h5 class="title title-color-green">Comparativo de Valores Lancados no Cofre Dentro do Ano de <?php echo "$ano" ?></h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive ">
                      <thead class=" text-primary">

                        <div class="ct-chart ct-perfect-fourth"></div>


                        <!-- Link do Grafico -->

                        <div class="col-md-12"><img alt="" src="../Graficos/GraficoInvestimentos.php" title=""></div>





                      </thead>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="title title-color-green">Total de Valores Guardados no Cofre Dentro do Ano de <?php echo "$ano" ?></h5>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive ">
                          <table class="table">
                            <thead class=" text-primary">
                              <tr>
                                <th class="datatable-color">Valor</th>
                                <th class="datatable-color">Média Mensal</th>
                                <th class="datatable-color">Média Diária</th>

                              </tr>
                            </thead>
                            <tbody>

                              <?php

                              //Consulta e Soma de Valores do Banco de Dados

                              $ctotal = mysqli_query($con, "SELECT SUM(valortotal)  FROM cofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                              //Soma de Valores do Banco de Dados

                              while ($sum = mysqli_fetch_array($ctotal)) :

                                $csoma = 'R$ ' . number_format($sum['SUM(valortotal)'], 2, ',', '.');

                              endwhile;


                              //Consulta e Soma de Valores do Banco de Dados

                              $MediaMensalContas = mysqli_query($con, "SELECT SUM(valortotal)  FROM cofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");




                              //Soma de Valores e Calculo da Media Mensal no Banco de Dados

                              while ($sum = mysqli_fetch_array($MediaMensalContas)) :

                                $MediaSomaContas = 'R$ ' . number_format($sum['SUM(valortotal)'] / $mes, 2, ',', '.');

                              endwhile;




                              //Consulta e Soma de Valores do Banco de Dados

                              $MediaDiariaInvestimentos = mysqli_query($con, "SELECT SUM(valortotal)  FROM cofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");

                              $teste = "30";




                              //Soma de Valores e Calculo da Media Diaria no Banco de Dados

                              while ($sum = mysqli_fetch_array($MediaDiariaInvestimentos)) :

                                $MediaDiariaInvestimentos = 'R$ ' . number_format($sum['SUM(valortotal)'] / $mes / $teste, 2, ',', '.');

                              endwhile;

                              ?>
                              <!-- Apresentacao dos Valores do Banco de Dados -->


                              <tr>

                                <td class="text-success title"><?php echo $csoma; ?></td>
                                <td class="text-success title"><?php echo $MediaSomaContas; ?></td>
                                <td class="text-success title"><?php echo $MediaDiariaInvestimentos; ?></td>

                                <td>

                                </td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>








                    <div class="content">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-header">
                              <h5 class="title title-color-red"> Valores Resgatados do Cofre dentro do Ano de <?php echo "$ano" ?></h5>
                            </div>
                            <div class="card-body">
                              <div class="table-responsive ">
                                <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                  <thead class=" text-primary">
                                    <tr>
                                      <th class="title-color-red">Data do Resgate</th>
                                      <th class="title-color-red">Valor do Resgate</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php
                                    //Consulta de Valores no Banco de Dados

                                    $sql = "SELECT * FROM resgatecofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'";
                                    $uquery = mysqli_query($con, $sql);
                                    $total_usuarios = mysqli_num_rows($uquery);
                                    while ($lncp = mysqli_fetch_object($uquery)) :
                                      $ucod = $lncp->cod;
                                      $udata = $lncp->data;
                                      $uvalor = $lncp->valor;


                                    ?>
                                      <!-- Apresentacao dos Valores do Banco de Dados -->

                                      <tr>
                                        <td class="datatable-color"><?php echo $udata; ?></td>
                                        <td class="p-3 mb-2 bg-danger text-white title">R$ <?php echo number_format($uvalor, 2, ',', '.');  ?></td>

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
                                  <h5 class="title title-color-red">Total de Valores Resgatados do Cofre Dentro do Ano de <?php echo "$ano" ?></h5>
                                </div>
                                <div class="card-body">
                                  <div class="table-responsive ">
                                    <table class="table">
                                      <thead class=" text-primary">
                                        <tr>
                                          <th class="datatable-color">Valor Total Resgatado</th>


                                        </tr>
                                      </thead>
                                      <tbody>

                                        <?php
                                        //Consulta e Soma de Valores do Banco de Dados

                                        $ctotal = mysqli_query($con, "SELECT SUM(valor)  FROM resgatecofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                                        //Soma de Valores do Banco de Dados

                                        while ($sum = mysqli_fetch_array($ctotal)) :

                                          $csoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                                        endwhile;



                                        ?>
                                        <!-- Apresentacao dos Valores do Banco de Dados -->


                                        <tr>

                                          <td class="text-danger title"><?php echo $csoma; ?></td>


                                          <td>

                                          </td>
                                        </tr>

                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>





                              <div class="row">
                                <div class="col-md-12">
                                  <div class="card">
                                    <div class="card-header">
                                      <h5 class="title title-color-blue"> Fechamento do Ano de <?php echo "$ano" ?></h5>
                                    </div>
                                    <div class="card-body">
                                      <div class="table-responsive ">
                                        <table class="table">
                                          <thead class=" text-primary">

                                            <?php
                                            //Consulta e Soma de Valores do Banco de Dados

                                            $totalganhos = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                                            //Soma de Valores do Banco de Dados

                                            while ($sum = mysqli_fetch_array($totalganhos)) :

                                              $somaganhos = 'R$ + ' . number_format($sum['SUM(valortotal)'], 2, ',', '.');

                                            endwhile;


                                            ?>
                                            <!-- Apresentacao dos Valores do Banco de Dados -->

                                            <tr>
                                              <th class="p-3 mb-2 bg-info text-white"><strong>Total de Valores Guardados no Cofre</strong> </th>
                                              <th class="p-3 mb-2 bg-success text-white"><strong><?php echo $somaganhos; ?></strong></th>
                                            </tr>




                                            <?php
                                            //Consulta e Soma de Valores do Banco de Dados

                                            $totalcontas = mysqli_query($con, "SELECT SUM(valor) FROM resgatecofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                                            //Soma de Valores do Banco de Dados

                                            while ($sum = mysqli_fetch_array($totalcontas)) :

                                              $somacontas = 'R$ - ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                                            endwhile;

                                            ?>


                                            <!-- Apresentacao dos Valores do Banco de Dados -->


                                            <tr>
                                              <th class="p-3 mb-2 bg-info text-white"><strong>Total de Valores Resgatados</strong></th>
                                              <th class="p-3 mb-2 bg-danger text-white"><strong><?php echo $somacontas; ?></strong></th>
                                            </tr>







                                          </thead>
                                          <tbody>

                                            <?php
                                            //Consulta e Soma de Valores do Banco de Dados
                                            $totalganhos = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");
                                            $totalcontas = mysqli_query($con, "SELECT SUM(valor)  FROM resgatecofre WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                                            //Soma de Valores do Banco de Dados

                                            while ($sum = mysqli_fetch_array($totalganhos)) :

                                              $saldocontas = $sum['SUM(valortotal)'];

                                            endwhile;



                                            //Soma de Valores do Banco de Dados

                                            while ($sum = mysqli_fetch_array($totalcontas)) :

                                              $saldogastos = $sum['SUM(valor)'];

                                            endwhile;





                                            // Calculo do Saldo Final 

                                            $saldo = 'R$ ' . number_format($saldocontas - $saldogastos, 2, ',', '.');



                                            ?>

                                            <!-- Apresentacao dos Valores do Banco de Dados -->


                                            <tr>


                                              <td class="text-light bg-dark title">Saldo do Ano de <?php echo "$ano" ?></td>
                                              <td class="text-light bg-dark title"><?php echo $saldo; ?></td>
                                              <td>

                                              </td>
                                            </tr>

                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>


                                  <a href="../Cofre/ComparativoAnualAnterior.php" class="btn btn-success">
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