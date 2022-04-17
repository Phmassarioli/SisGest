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

  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-blue"> Selecione um Periodo</h5>
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
            <h5 class="title title-color-green"> Ganhos no Período</h5>
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

        <!-- Tabela de Valores do Banco de Dados -->

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

            <!-- Tabela de Valores do Banco de Dados -->

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="title title-color-green">Valor Total de Ganhos no Periodo</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive ">
                      <table class="table">
                        <thead class=" text-primary">
                          <tr>
                            <th class="datatable-color">Ganhos</th>
                            <th class="datatable-color">Dias Corridos</th>
                            <th class="datatable-color">Média Diária</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          //Consulta e Soma de Valores do Banco de Dados

                          $total = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");
                          $MediaDia = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");


                          //Calculo da Media diaria de Valores Somados

                          $teste = (($data_inicial = "$data") . ($data_final = "$dataf"));
                          $diferenca = strtotime($data_final) - strtotime($data_inicial);
                          $dias = floor($diferenca / (60 * 60 * 24));


                          //Soma de Valores do Banco de Dados

                          while ($sum = mysqli_fetch_array($total)) :

                            $soma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                          endwhile;



                          //Calculo da Media diaria de Valores Somados

                          while ($sum = mysqli_fetch_array($MediaDia)) :

                            $MediaDia = 'R$ ' . number_format($sum['SUM(valor)'] / $dias, 2, ',', '.');

                          endwhile;

                          ?>

                          <!-- Apresentacao dos Valores do Banco de Dados -->

                          <tr>

                            <td class="text-success title"><?php echo $soma; ?></td>
                            <td class="text-success title"><?php echo $dias; ?></td>
                            <td class="text-success title"><?php echo $MediaDia; ?></td>
                            <td>

                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <a href="../Ganhos/Ganhos/GanhosEspecificos.php" class="btn btn-success">
                  <i></i>
                  Consultar Ganho Especifico
                </a>

                <br>
                <br>




                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="title title-color-red">Contas Pagas no Período</h5>
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
                              // Consulta de Dados no Banco de Dados

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


                    <!-- Tabela de Valores do Banco de Dados -->

                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-header">
                            <h5 class="title title-color-red">Valor Total de Contas Pagas no Período</h5>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive ">
                              <table class="table">
                                <thead class=" text-primary">
                                  <tr>
                                    <th class="datatable-color">Contas Pagas</th>
                                    <th class="datatable-color">Dias Corridos</th>
                                    <th class="datatable-color">Média Diária</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  <?php
                                  //Consulta e Soma de Valores do Banco de Dados

                                  $ctotal = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");
                                  $MediaDia = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");

                                  //Calculo da Media diaria de Valores Somados

                                  $teste = (($data_inicial = "$data") . ($data_final = "$dataf"));
                                  $diferenca = strtotime($data_final) - strtotime($data_inicial);
                                  $dias = floor($diferenca / (60 * 60 * 24));



                                  //Soma de Valores do Banco de Dados

                                  while ($sum = mysqli_fetch_array($ctotal)) :

                                    $csoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

                                  endwhile;


                                  //Calculo da Media diaria de Valores Somados


                                  while ($sum = mysqli_fetch_array($MediaDia)) :

                                    $MediaDiaria = 'R$ ' . number_format($sum['SUM(valor)'] / $dias, 2, ',', '.');

                                  endwhile;


                                  ?>

                                  <!-- Apresentacao dos Valores do Banco de Dados -->


                                  <tr>

                                    <td class="text-danger title"><?php echo $csoma; ?></td>
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


                        <a href="../Contas/ContasEspecificas.php" class="btn btn-danger">
                          <i></i>
                          Consultar Conta Especifica
                        </a>

                        <br>
                        <br>

                        <!-- Tabela de Valores do Banco de Dados -->

                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-header">
                                <h5 class="title title-color-red"> Gastos no Período</h5>
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

                            <!-- Tabela de Valores do Banco de Dados -->

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
                                          // Consulta de Dados Agrupados no Banco de Dados

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


                                <!-- Tabela de Valores do Banco de Dados -->

                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="card">
                                      <div class="card-header">
                                        <h5 class="title title-color-red">Valor Total de Gastos no Período</h5>
                                      </div>
                                      <div class="card-body">
                                        <div class="table-responsive ">
                                          <table class="table">
                                            <thead class=" text-primary">
                                              <tr>
                                                <th class="datatable-color">Gastos </th>
                                                <th class="datatable-color">Dias Corridos</th>
                                                <th class="datatable-color">Média Diária</th>
                                              </tr>
                                            </thead>
                                            <tbody>

                                              <?php

                                              //Consulta e Soma de Valores do Banco de Dados

                                              $gtotal = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");
                                              $MediaDia = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");

                                              //Calculo da Media diaria de Valores Somados

                                              $teste = (($data_inicial = "$data") . ($data_final = "$dataf"));
                                              $diferenca = strtotime($data_final) - strtotime($data_inicial);
                                              $dias = floor($diferenca / (60 * 60 * 24));


                                              //Soma de Valores do Banco de Dados

                                              while ($sum = mysqli_fetch_array($gtotal)) :

                                                $gsoma = 'R$ ' . number_format($sum['SUM(valorgasto)'], 2, ',', '.');

                                              endwhile;


                                              //Calculo da Media diaria de Valores Somados

                                              while ($sum = mysqli_fetch_array($MediaDia)) :

                                                $MediaDiaria = 'R$ ' . number_format($sum['SUM(valorgasto)'] / $dias, 2, ',', '.');

                                              endwhile;

                                              ?>
                                              <!-- Apresentacao dos Valores do Banco de Dados -->

                                              <tr>

                                                <td class="text-danger title"><?php echo $gsoma; ?></td>
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


                                    <a href="../Gastos/GastosEspecificos.php" class="btn btn-danger">
                                      <i></i>
                                      Consultar Gasto Especifico
                                    </a>

                                    <br>
                                    <br>

                                    <!-- Tabela de Valores do Banco de Dados -->

                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="card">
                                          <div class="card-header">
                                            <h5 class="title title-color-red">Valor Total de Gastos + Contas Pagas no Período</h5>
                                          </div>
                                          <div class="card-body">
                                            <div class="table-responsive ">
                                              <table class="table">
                                                <thead class=" text-primary">
                                                  <tr>
                                                    <th class="datatable-color">Gastos + Contas Pagas </th>
                                                    <th class="datatable-color">Dias Corridos</th>
                                                    <th class="datatable-color">Média Diária</th>
                                                  </tr>
                                                </thead>
                                                <tbody>

                                                  <?php
                                                  //Consulta e Soma de Valores do Banco de Dados

                                                  $gatotal = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");
                                                  $cototal = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");


                                                  //Calculo da Media diaria de Valores Somados

                                                  $teste = (($data_inicial = "$data") . ($data_final = "$dataf"));
                                                  $diferenca = strtotime($data_final) - strtotime($data_inicial);
                                                  $dias = floor($diferenca / (60 * 60 * 24));



                                                  //Soma de Valores do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($cototal) + mysqli_fetch_array($gatotal)) :

                                                    $gacosoma = 'R$ ' . number_format($sum['SUM(valor)'] + $sum['SUM(valorgasto)'], 2, ',', '.');



                                                  endwhile;


                                                  //Consulta e Soma da Media de Valores do Banco de Dados

                                                  $MediaDiaGasto = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");
                                                  $MediaDiaConta = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");



                                                  //Soma de Valores Medios do Banco de Dados

                                                  while ($sum = mysqli_fetch_array($MediaDiaConta) + mysqli_fetch_array($MediaDiaGasto)) :



                                                    $SomaMediasdiarias = 'R$ ' . number_format($sum['SUM(valor)'] / $dias + $sum['SUM(valorgasto)'] / $dias, 2, ',', '.');

                                                  endwhile;




                                                  ?>

                                                  <!-- Apresentacao dos Valores do Banco de Dados -->

                                                  <tr>

                                                    <td class="text-danger title"><?php echo $gacosoma; ?></td>
                                                    <td class="text-danger title"><?php echo $dias; ?></td>
                                                    <td class="text-danger title"><?php echo $SomaMediasdiarias; ?></td>

                                                    <td>

                                                    </td>
                                                  </tr>

                                                </tbody>
                                              </table>
                                            </div>
                                          </div>
                                        </div>




                                        <!-- Tabela de Valores do Banco de Dados -->

                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="card">
                                              <div class="card-header">
                                                <h5 class="title title-color-blue"> Fechamento do Periodo</h5>
                                              </div>
                                              <div class="card-body">
                                                <div class="table-responsive ">
                                                  <table class="table">
                                                    <thead class=" text-primary">

                                                      <?php
                                                      //Consulta e Soma de Valores do Banco de Dados

                                                      $totalganhos = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");


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

                                                      $totalcontas = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");


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

                                                      $totalgasto = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");


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

                                                      $totalganhos = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");
                                                      $totalcontas = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");
                                                      $totalgasto = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data >='$data' AND data <= '$dataf' ORDER BY data ASC");


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

                                                      //Calculo Saldo Final
                                                      $saldo = 'R$ ' . number_format($saldoganhos - ($saldocontas + $saldogastos), 2, ',', '.');



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