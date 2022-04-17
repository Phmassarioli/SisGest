<?php

error_reporting(0);
ob_start();
session_start();

$usuario = $_SESSION['usuario'];

include "../../conexao.php";

$act = $_REQUEST['act'];

$texto_botao = 'Lançar Valor do Resgate';



// Insercao dos dados no Banco de Dados

if (isset($_POST['usuario'])) {

  $ucod  = $_POST['cod'];
  $udata  = $_POST['data'];
  $uvalor  = $_POST['valor'];



  if (count($error) == 0) {

    $sql = "INSERT INTO resgatecofre (cod,data,valor) VALUES ('$ucod','$udata','$uvalor')";

    $res = mysqli_query($con, $sql);
  }

  if ($res) {
  }
  echo "<h4 style='text-align: center;'>Resgate do Valor Realizado com Sucesso !</h4>";
}

if (count($error) != 0) {
  foreach ($error as $erro) {
    echo $erro . "<br />";
  }
}




// Exclusao de Dados Cadastrados no Banco de Dados

if ($act == 'exclusao') {
  $ucod  = strip_tags($_GET['id']);
  $sqld = "delete from resgatecofre where cod='$ucod'";

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

  <div class="panel-header-green panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-green">Resgate de Valores do Montante Investido</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">

                <input type="hidden" id="usuario" name="usuario">

                <input type="hidden" id="cod" name="cod" value="0">


                <label>Data do Resgate do Valor Investido</label>
                <input class="form-control" type="date" id="data" name="data">

                <br>
                <br>

                <label>Valor do Resgate</label>
                <input class="form-control" type="number" step="any" id="valor" name="valor">

                <br>
                <br>

                <button type="submit" class="btn btn-success"><?php echo $texto_botao; ?></button>
                </fieldset>
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
            <h5 class="title title-color-green"> Resgates Anteriores</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead class=" text-primary">
                  <tr>
                    <th class="title-color-green">Data do Resgate</th>
                    <th class="title-color-green">Valor do Resgate</th>
                    <th class="title-color-green">Ações</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  // Consulta de Dados no Banco de Dados

                  $sql = "SELECT * FROM resgatecofre ";
                  $uquery = mysqli_query($con, $sql);
                  $total_usuarios = mysqli_num_rows($uquery);
                  while ($lncp = mysqli_fetch_object($uquery)) :
                    $ucod = $lncp->cod;
                    $udata = $lncp->data;
                    $uvalor = $lncp->valor;



                  ?>
                    <!-- Apresentacao dos Valores do Banco de Dados -->

                    <tr>

                      <td class="datatable-color"><?php echo date('d/m/Y', strtotime($udata)); ?></td>
                      <td class="p-3 mb-2 bg-success text-white title">R$ <?php echo number_format($uvalor, 2, ',', '.');  ?></td>

                      <td>
                        <a class="btn btn-danger" href="?id=<?php echo $ucod; ?>&act=exclusao" onclick="return confirm('Deseja Realmente Excluir Este Valor de Resgate ?')">
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
                <h5 class="title title-color-green"> Total de Todos os Valores Já Resgatados</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th class="datatable-color">Valores Já Resgatados</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php


                      //Consulta e Soma de Valores do Banco de Dados

                      $total = mysqli_query($con, "SELECT SUM(valor) FROM resgatecofre");



                      //Soma de Valores do Banco de Dados

                      while ($sum = mysqli_fetch_array($total)) :

                        $tcfpsoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');



                      ?>
                        <!-- Apresentacao dos Valores do Banco de Dados -->


                        <tr>

                          <td class="text-success title"><?php echo $tcfpsoma; ?></td>
                          <td>

                          </td>
                        </tr>
                      <?php endwhile; ?>
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