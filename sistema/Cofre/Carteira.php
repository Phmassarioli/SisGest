<?php
error_reporting(0);
ob_start();
session_start();

$usuario = $_SESSION['usuario'];
include "../../conexao.php";
$act = $_REQUEST['act'];





?>

<body>

  <?php
  // Aproveitamento de Codigo do Layout

  include "../head.php";
  include 'Menu.php';
  include "../navbar.php";
  include "../scripts.php";
  ?>




  <!-- Apresentacao dos Dados do Banco de Dados na Tabela -->
  <div class="panel-header-green panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-green"> Valores Lancados no Cofre</h5>
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

                  //Consulta de Dados do Banco para Apresentacao na Tabela
                  $sql = "SELECT * FROM cofre ORDER BY data ASC";
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
                <h5 class="title title-color-green">Total de Valores Agrupados Lancados no Cofre</h5>
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
                      //Consulta e Soma de Valores Agrupados do Banco de Dados

                      $sql = "SELECT nome, SUM(valortotal) AS valortotal FROM cofre GROUP BY nome";
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


            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title title-color-green">Total de Valores Guardados no Cofre</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive ">
                      <table class="table">
                        <thead class=" text-primary">
                          <tr>
                            <th class="datatable-color">Valores do Cofre</th>

                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          //Consulta e Soma de Valores do Banco de Dados

                          $total = mysqli_query($con, "SELECT SUM(valortotal)  FROM cofre ORDER BY data ASC");

                          //Soma de Valores do Banco de Dados

                          while ($sum = mysqli_fetch_array($total)) :

                            $soma = 'R$ ' . number_format($sum['SUM(valortotal)'], 2, ',', '.');

                          endwhile;




                          ?>

                          <!-- Apresentacao dos Valores do Banco de Dados -->

                          <tr>

                            <td class="text-success title"><?php echo $soma; ?></td>

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
                        <h5 class="title title-color-red">Valores Resgatados do Cofre</h5>
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

                              // Consulta de Dados no Banco de Dados

                              $sql = "SELECT * FROM resgatecofre ORDER BY data ASC";
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
                            <h5 class="title title-color-red">Total de Valores Resgatados do Cofre</h5>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive ">
                              <table class="table">
                                <thead class=" text-primary">
                                  <tr>
                                    <th class="datatable-color">Valores Resgatados</th>

                                  </tr>
                                </thead>
                                <tbody>

                                  <?php
                                  //Consulta e Soma de Valores do Banco de Dados

                                  $ctotal = mysqli_query($con, "SELECT SUM(valor)  FROM resgatecofre ORDER BY data ASC");




                                  //Soma de Valores do Banco de Dados

                                  while ($sum = mysqli_fetch_array($ctotal)) :

                                    $csoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                                  endwhile;




                                  ?>


                                  <tr>
                                    <!-- Apresentacao dos Valores do Banco de Dados -->

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
                                <h5 class="title title-color-blue"> Resumo de Valores</h5>
                              </div>
                              <div class="card-body">
                                <div class="table-responsive ">
                                  <table class="table">
                                    <thead class=" text-primary">

                                      <?php

                                      //Consulta e Soma de Valores do Banco de Dados

                                      $totalganhos = mysqli_query($con, "SELECT SUM(valortotal)  FROM cofre");


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

                                      $totalcontas = mysqli_query($con, "SELECT SUM(valor)  FROM resgatecofre");


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

                                      $totalganhos = mysqli_query($con, "SELECT SUM(valortotal)  FROM cofre");

                                      //Consulta e Soma de Valores do Banco de Dados

                                      $totalcontas = mysqli_query($con, "SELECT SUM(valor)  FROM resgatecofre");


                                      //Soma de Valores do Banco de Dados

                                      while ($sum = mysqli_fetch_array($totalganhos)) :

                                        $saldocontas = $sum['SUM(valortotal)'];

                                      endwhile;



                                      //Soma de Valores do Banco de Dados

                                      while ($sum = mysqli_fetch_array($totalcontas)) :

                                        $saldogastos = $sum['SUM(valor)'];

                                      endwhile;





                                      //Calculo de Saldo Final
                                      $saldo = 'R$ ' . number_format($saldocontas - $saldogastos, 2, ',', '.');



                                      ?>
                                      <!-- Apresentacao dos Valores do Banco de Dados -->

                                      <tr>


                                        <td class="text-light bg-dark title">Saldo do Periodo</td>
                                        <td class="text-light bg-dark title"><?php echo $saldo; ?></td>
                                        <td>

                                        </td>
                                      </tr>

                                    </tbody>
                                  </table>
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