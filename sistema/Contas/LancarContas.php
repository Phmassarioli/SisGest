<?php

error_reporting(0);
ob_start();
session_start();


$usuario = $_SESSION['usuario'];

include "../../conexao.php";

$act = $_REQUEST['act'];

$texto_botao = 'Lançar Conta';


// Insercao dos dados no Banco de Dados


if (isset($_POST['usuario'])) {

  $ucod  = $_POST['cod'];
  $unomeconta  = $_POST['nomeconta'];
  $uvalor  = $_POST['valor'];
  $udata  = $_POST['data'];
  $ulocal    = $_POST['local'];


  if (count($error) == 0) {

    $sql = "INSERT INTO contasfixas (cod,nomeconta,valor,data,local) VALUES ('$ucod', '$unomeconta','$uvalor','$udata','$ulocal')";

    $res = mysqli_query($con, $sql);
  }

  if ($res) {
  }
  echo "<h4 style='text-align: center;'>Conta Lançada !</h4>";
}

if (count($error) != 0) {
  foreach ($error as $erro) {
    echo $erro . "<br />";
  }
}




// Exclusao de Dados Cadastrados no Banco de Dados

if ($act == 'exclusao') {
  $ucod  = strip_tags($_GET['id']);
  $sqld = "delete from contasfixas where cod='$ucod'";

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

  <!-- Formulario-->

  <div class="panel-header-red panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-red">Lançar Conta</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">

                <input type="hidden" id="usuario" name="usuario">

                <input type="hidden" id="cod" name="cod" value="0">


                <label>Nome da Conta</label>
                <input class="form-control" type="text" id="nomeconta" name="nomeconta">

                <br>
                <br>

                <label>Valor da Conta</label>
                <input class="form-control" type="number" step="any" id="valor" name="valor">

                <br>
                <br>

                <label>Data de Pagamento</label>
                <input class="form-control" type="date" id="data" name="data">

                <br>
                <br>

                <label>Local de Pagamento</label>
                <input class="form-control" type="text" id="local" name="local">

                <br>
                <br>


                <button type="submit" class="btn btn-danger"><?php echo $texto_botao; ?></button>
                </fieldset>
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
            <h5 class="title title-color-red"> Contas Lançadas</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead class=" text-primary">
                  <tr>
                    <th class="title-color-red">Nome da Conta</th>
                    <th class="title-color-red">Data de Pagamento</th>
                    <th class="title-color-red">Local</th>
                    <th class="title-color-red">Valor da Conta</th>
                    <th class="title-color-red">Ações</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  // Consulta de Dados no Banco de Dados
                  $sql = "SELECT * FROM contasfixas ";
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

                      <td>
                        <a class="btn btn-danger" href="?id=<?php echo $ucod; ?>&act=exclusao" onclick="return confirm('Deseja Realmente Excluir Esta Conta ?')">
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


        <!--Soma de Valores no Banco de Dados -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title title-color-red"> Total de Todas as Contas Pagas Lançadas</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th class="datatable-color">Valor Total de Contas Pagas</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php

                      // Consulta e Soma de Valores no Banco 

                      $total = mysqli_query($con, "SELECT SUM(valor) FROM contasfixas");




                      while ($sum = mysqli_fetch_array($total)) :

                        $tcfpsoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');



                      ?>


                        <tr>

                          <td class="text-danger title"><?php echo $tcfpsoma; ?></td>
                          <td>

                          </td>
                        </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- externo javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   

    <?php

    include "../footer.php";

    ?>