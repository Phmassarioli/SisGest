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

  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-blue"> Selecione um Ano</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">

                <input type="hidden" id="usuario" name="usuario">

                <label>Data Inicio</label>
                <input class="form-control" type="number" id="$ano" name="ano" OnKeyPress="formatar('##/##/##', this)" />
                <br>

                <button type="submit" id="btok" class="btn btn-primary"><?php echo $texto_botao; ?></button>

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
                    $uveiculo = $lncp->veiculo;
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
                      //Consulta e Soma de Valores Agrupados no Banco de Dados

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
                          //Consulta e Soma de Valores do Banco de Dados

                          $ctotal = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                          //Soma de Valores do Banco de Dados

                          while ($sum = mysqli_fetch_array($ctotal)) :

                            $csoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                          endwhile;


                          //Soma de Valores e Calculo da Media Mensal do Banco de Dados

                          $MediaMensalContas = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                          //Soma de Valores e Calculo da Media Mensal do Banco de Dados

                          while ($sum = mysqli_fetch_array($MediaMensalContas)) :

                            $MediaSomaContas = 'R$ ' . number_format($sum['SUM(valor)'] / $mes, 2, ',', '.');

                          endwhile;


                          //Soma de Valores e Calculo da Media Mensal do Banco de Dados

                          $MediaDiariaContas = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");

                          $teste = "30";


                          //Soma de Valores e Calculo da Media Diaria do Banco de Dados

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







                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="title title-color-red"> Contas Pagas Dentro do Ano de <?php echo "$ano" ?></h5>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive ">
                          <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                            <thead class=" text-primary">
                              <tr>
                                <th class="title-color-red">Nome da Conta</th>
                                <th class="title-color-red">Data do Pagamento</th>
                                <th class="title-color-red">Local</th>
                                <th class="title-color-red">Valor da Conta</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              //Consulta de Valores no Banco de Dados

                              $sql = "SELECT * FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'";
                              $uquery = mysqli_query($con, $sql);
                              $total_usuarios = mysqli_num_rows($uquery);
                              while ($lncp = mysqli_fetch_object($uquery)) :
                                $ucod = $lncp->cod;
                                $unomeconta = $lncp->nomeconta;
                                $udata = $lncp->data;
                                $ulocal = $lncp->local;
                                $uvalor = $lncp->valor;


                              ?>
                                <!-- Apresentacao dos Valores do Banco de Dados -->

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

                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-header">
                            <h5 class="title title-color-red"> Valor Total de Contas Agrupadas Dentro do Ano de <?php echo $ano ?></h5>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive ">
                              <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead class=" text-primary">
                                  <tr>
                                    <th class="title-color-red">Nome da Conta</th>
                                    <th class="title-color-red">Valor da Conta</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php
                                  //Consulta e Soma de Valores Agrupados no Banco de Dados

                                  $sql = "SELECT nomeconta, SUM(valor) AS valor FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31' GROUP BY nomeconta";
                                  $uquery = mysqli_query($con, $sql);
                                  $total_usuarios = mysqli_num_rows($uquery);

                                  while ($lncp = mysqli_fetch_object($uquery)) :
                                    $ucod = $lncp->cod;
                                    $unomeconta = $lncp->nomeconta;
                                    $uvalor = $lncp->valor;




                                  ?>
                                    <!-- Apresentacao dos Valores do Banco de Dados -->

                                    <tr>
                                      <td class="datatable-color"><?php echo $unomeconta; ?></td>
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
                                <h5 class="title title-color-red">Valor Total de Contas Pagas Dentro do Ano de <?php echo "$ano" ?></h5>
                              </div>
                              <div class="card-body">
                                <div class="table-responsive ">
                                  <table class="table">
                                    <thead class=" text-primary">
                                      <tr>
                                        <th class="datatable-color">Contas Pagas </th>
                                        <th class="datatable-color">Média Mensal</th>
                                        <th class="datatable-color">Média Diária</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <?php
                                      //Consulta e Soma de Valores do Banco de Dados

                                      $ctotal = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                                      //Soma de Valores do Banco de Dados

                                      while ($sum = mysqli_fetch_array($ctotal)) :

                                        $csoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                                      endwhile;


                                      //Soma de Valores do Banco de Dados

                                      $MediaMensalContas = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");



                                      //Soma de Valores e Calculo da Media Mensal do Banco de Dados


                                      while ($sum = mysqli_fetch_array($MediaMensalContas)) :

                                        $MediaSomaContas = 'R$ ' . number_format($sum['SUM(valor)'] / $mes, 2, ',', '.');

                                      endwhile;


                                      //Soma de Valores do Banco de Dados

                                      $MediaDiariaContas = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");

                                      $teste = "30";


                                      //Soma de Valores e Calculo da Media Diaria do Banco de Dados

                                      while ($sum = mysqli_fetch_array($MediaDiariaContas)) :

                                        $MediaDiariaContas = 'R$ ' . number_format($sum['SUM(valor)'] / $mes / $teste, 2, ',', '.');

                                      endwhile;

                                      ?>

                                      <!-- Apresentacao dos Valores do Banco de Dados -->

                                      <tr>

                                        <td class="text-danger title"><?php echo $csoma; ?></td>
                                        <td class="text-danger title"><?php echo $MediaSomaContas; ?></td>
                                        <td class="text-danger title"><?php echo $MediaDiariaContas; ?></td>
                                        <td>

                                        </td>
                                      </tr>

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <br>
                            <br>


                            <div class="row">
                              <div class="col-md-12">
                                <div class="card">
                                  <div class="card-header">
                                    <h5 class="title title-color-red">Gastos Dentro do Ano de <?php echo "$ano" ?></h5>
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
                                          //Consulta de Valores no Banco de Dados

                                          $sql = "SELECT * FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'";
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
                                        <h5 class="title title-color-red"> Valor Total de Gastos Agrupados Dentro do Ano de <?php echo $ano ?></h5>
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
                                              //Consulta e Soma de Valores Agrupados no Banco de Dados

                                              $sql = "SELECT nomegasto, SUM(valorgasto) AS valorgasto FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31' GROUP BY nomegasto";
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
                                            <h5 class="title title-color-red"> Valor Total de Gastos Dentro do Ano de <?php echo "$ano" ?></h5>
                                          </div>
                                          <div class="card-body">
                                            <div class="table-responsive ">
                                              <table class="table">
                                                <thead class=" text-primary">
                                                  <tr>
                                                    <th class="datatable-color">Gastos </th>
                                                    <th class="datatable-color">Média Mensal</th>
                                                    <th class="datatable-color">Média Diária</th>
                                                  </tr>
                                                </thead>
                                                <tbody>

                                                  <?php
                                                  //Consulta e Soma de Valores do Banco de Dados

                                                  $gtotal = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");

                                                  //Soma de Valores do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($gtotal)) :

                                                    $gsoma = 'R$ ' . number_format($sum['SUM(valorgasto)'], 2, ',', '.');

                                                  endwhile;



                                                  //Soma de Valores do Banco de Dados

                                                  $MediaMensalGastos = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");



                                                  //Soma de Valores e Calculo da Media Mensal do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($MediaMensalGastos)) :

                                                    $MediaMensalSomaGastos = 'R$ ' . number_format($sum['SUM(valorgasto)'] / $mes, 2, ',', '.');

                                                  endwhile;



                                                  //Soma de Valores do Banco de Dados

                                                  $MediaDiariaContas = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");

                                                  $teste = "30";


                                                  //Soma de Valores e Calculo da Media Diaria do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($MediaDiariaContas)) :

                                                    $MediaDiariaContas = 'R$ ' . number_format($sum['SUM(valorgasto)'] / $mes / $teste, 2, ',', '.');

                                                  endwhile;

                                                  ?>
                                                  <!-- Apresentacao dos Valores do Banco de Dados -->

                                                  <tr>

                                                    <td class="text-danger title"><?php echo $gsoma; ?></td>
                                                    <td class="text-danger title"><?php echo $MediaMensalSomaGastos; ?></td>
                                                    <td class="text-danger title"><?php echo $MediaDiariaContas; ?></td>
                                                    <td>

                                                    </td>
                                                  </tr>

                                                </tbody>
                                              </table>
                                            </div>
                                          </div>
                                        </div>



                                        <br>
                                        <br>


                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="card">
                                              <div class="card-header">
                                                <h5 class="title title-color-red">Valor Total de Gastos + Contas Pagas Dentro do Ano de <?php echo "$ano" ?></h5>
                                              </div>
                                              <div class="card-body">
                                                <div class="table-responsive ">
                                                  <table class="table">
                                                    <thead class=" text-primary">
                                                      <tr>
                                                        <th class="datatable-color">Gastos + Contas Pagas</th>
                                                        <th class="datatable-color">Média Mensal</th>
                                                        <th class="datatable-color">Média Diária</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>

                                                      <?php

                                                      //Consulta e Soma de Valores do Banco de Dados

                                                      $gatotal = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");
                                                      $cototal = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");



                                                      //Soma de Valores do Banco de Dados

                                                      while ($sum = mysqli_fetch_array($cototal) + mysqli_fetch_array($gatotal)) :

                                                        $gacosoma = 'R$ ' . number_format($sum['SUM(valor)'] + $sum['SUM(valorgasto)'], 2, ',', '.');



                                                      endwhile;


                                                      //Consulta e Soma de Valores do Banco de Dados

                                                      $MediaMensalGastos = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");
                                                      $MediaMensalContas = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");



                                                      //Soma de Valores do Banco de Dados

                                                      while ($sum = mysqli_fetch_array($MediaMensalContas) + mysqli_fetch_array($MediaMensalGastos)) :

                                                        $SomaMedias = 'R$ ' . number_format($sum['SUM(valor)'] / $mes + $sum['SUM(valorgasto)'] / $mes, 2, ',', '.');



                                                      endwhile;



                                                      //Consulta e Soma de Valores do Banco de Dados

                                                      $MediaDiariaGastos = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");

                                                      $MediaDiariaContas = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");

                                                      $teste = "30";




                                                      //Soma de Valores do Banco de Dados

                                                      while ($sum = mysqli_fetch_array($MediaDiariaContas) + mysqli_fetch_array($MediaDiariaGastos)) :

                                                        $SomaMediasdiarias = 'R$ ' . number_format($sum['SUM(valor)'] / $mes / $teste + $sum['SUM(valorgasto)'] / $mes / $teste, 2, ',', '.');



                                                      endwhile;





                                                      ?>

                                                      <!-- Apresentacao dos Valores do Banco de Dados -->

                                                      <tr>

                                                        <td class="text-danger title"><?php echo $gacosoma; ?></td>
                                                        <td class="text-danger title"><?php echo $SomaMedias; ?></td>
                                                        <td class="text-danger title"><?php echo $SomaMediasdiarias; ?></td>

                                                        <td>

                                                        </td>
                                                      </tr>

                                                    </tbody>
                                                  </table>
                                                </div>
                                              </div>
                                            </div>





                                          </div>

                                        </div>
                                      </div>
                                    </div>






                                    <br>
                                    <br>




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

                                                  $totalganhos = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                                                  //Soma de Valores do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($totalganhos)) :

                                                    $somaganhos = 'R$ + ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                                                  endwhile;


                                                  ?>
                                                  <!-- Apresentacao dos Valores do Banco de Dados -->

                                                  <tr>
                                                    <th class="p-3 mb-2 bg-info text-white"><strong>Total de Ganhos</strong> </th>
                                                    <th class="p-3 mb-2 bg-success text-white"><strong><?php echo $somaganhos; ?></strong></th>
                                                  </tr>




                                                  <?php
                                                  //Consulta e Soma de Valores do Banco de Dados

                                                  $totalcontas = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");




                                                  //Soma de Valores do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($totalcontas)) :

                                                    $somacontas = 'R$ - ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                                                  endwhile;

                                                  ?>



                                                  <!-- Apresentacao dos Valores do Banco de Dados -->


                                                  <tr>
                                                    <th class="p-3 mb-2 bg-info text-white"><strong>Total de Contas</strong></th>
                                                    <th class="p-3 mb-2 bg-danger text-white"><strong><?php echo $somacontas; ?></strong></th>
                                                  </tr>


                                                  <?php

                                                  //Consulta e Soma de Valores do Banco de Dados

                                                  $totalgasto = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                                                  //Soma de Valores do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($totalgasto)) :

                                                    $somagastos = 'R$ - ' . number_format($sum['SUM(valorgasto)'], 2, ',', '.');

                                                  endwhile;

                                                  ?>
                                                  <!-- Apresentacao dos Valores do Banco de Dados -->

                                                  <tr>
                                                    <th class="p-3 mb-2 bg-info text-white"><strong>Total de Gastos </strong></th>
                                                    <th class="p-3 mb-2 bg-danger text-white"><strong><?php echo $somagastos; ?></strong></th>
                                                  </tr>





                                                </thead>
                                                <tbody>

                                                  <?php

                                                  //Consulta e Soma de Valores do Banco de Dados

                                                  $totalganhos = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");
                                                  $totalcontas = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");
                                                  $totalgasto = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-12-31'");


                                                  //Soma de Valores do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($totalcontas)) :

                                                    $saldocontas = $sum['SUM(valor)'];

                                                  endwhile;



                                                  //Soma de Valores do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($totalgasto)) :

                                                    $saldogastos = $sum['SUM(valorgasto)'];

                                                  endwhile;


                                                  //Soma de Valores do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($totalganhos)) :

                                                    $saldoganhos = $sum['SUM(valor)'];

                                                  endwhile;



                                                  // Calculo do Saldo Final 

                                                  $saldo = 'R$ ' . number_format($saldoganhos - ($saldocontas + $saldogastos), 2, ',', '.');



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







                                        <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   
    <?php

    include "../footer.php";

    ?>