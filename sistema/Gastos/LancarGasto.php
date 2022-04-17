<?php

error_reporting(0);
ob_start();
session_start();

$usuario = $_SESSION['usuario'];

include "../../conexao.php";

$act = $_REQUEST['act'];

$texto_botao = 'Lancar Gasto';

// Insercao dos dados no Banco de Dados


if (isset($_POST['usuario'])) {

  $ucod  = strip_tags($_POST['cod']);
  $unomegasto  = strip_tags($_POST['nomegasto']);
  $uvalorgasto  = strip_tags($_POST['valorgasto']);
  $udata  = strip_tags($_POST['data']);
  $ulocal    = strip_tags($_POST['local']);


  if (count($error) == 0) {

    $sql = "INSERT INTO gastos (cod,nomegasto,valorgasto,data,local) VALUES ('$ucod', '$unomegasto','$uvalorgasto','$udata','$ulocal')";


    $res = mysqli_query($con, $sql);
  }

  if ($res) {
  }
  echo "<h4 style='text-align: center;'>Gasto Lançado !</h4>";
}

if (count($error) != 0) {
  foreach ($error as $erro) {
    echo $erro . "<br />";
  }
}

// Exclusao de Dados Cadastrados no Banco de Dados

if ($act == 'exclusao') {
  $ucod  = strip_tags($_GET['id']);
  $sqld = "delete from gastos where cod='$ucod'";

  $deleta = mysqli_query($con, $sqld);
  $usuario_classe = "success";
  $erro_senha = "<label class='control-label' for='inputError'>Registro apagado com sucesso</label>";
} else {
  $read = "";
  $consulta = "";
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
            <h5 class="title title-color-red">Lançar Gasto</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">

                <input type="hidden" id="usuario" name="usuario">

                <input type="hidden" id="cod" name="cod" value="0">

                <label>Nome do Gasto</label>
                <input class="form-control" type="text" id="nomegasto" name="nomegasto">

                <br>
                <br>

                <label>Valor do Gasto</label>
                <input class="form-control" type="number" step="any" id="valorgasto" name="valorgasto">

                <br>
                <br>

                <label>Data do Gasto</label>
                <input class="form-control" type="date" id="data" name="data">

                <br>
                <br>

                <label>Local do Gasto</label>
                <input class="form-control" type="text" id="local" name="local">

                <br>
                <br>



                <button type="submit" class="btn btn-danger"><?php echo $texto_botao; ?></button>

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
            <h5 class="title title-color-red">Gastos Lançados</h5>
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
                    <th class="title-color-red">Ações</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  // Consulta de Dados no Banco de Dados

                  $sql = "SELECT * FROM gastos";
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
                      <td>
                        <a class="btn btn-danger" href="?id=<?php echo $ucod; ?>&act=exclusao" onclick="return confirm('Deseja Realmente Excluir Este Gasto ?')">
                          <i></i>
                          Apagar
                        </a>
                      </td>
                    </tr>
                  <?php endwhile; ?>
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
                <h5 class="title title-color-red"> Total de Todos Gastos Lançados</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th class="datatable-color">Valor Total de Gastos</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      //Consulta e Soma de Valores do Banco de Dados

                      $total = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos");


                      //Soma de Valores do Banco de Dados

                      while ($sum = mysqli_fetch_array($total)) :

                        $soma = 'R$ ' . number_format($sum['SUM(valorgasto)'], 2, ',', '.');

                      endwhile;

                      ?>
                      <!-- Apresentacao dos Valores do Banco de Dados -->



                      <tr>

                        <td class="text-danger title"><?php echo $soma; ?></td>
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