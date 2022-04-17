<?php

error_reporting(0);
ob_start();
session_start();

$usuario = $_SESSION['usuario'];

include "../../conexao.php";

$act = $_REQUEST['act'];

$texto_botao = 'Lançar na Carteira';




// Insercao dos dados no Banco de Dados


if (isset($_POST['usuario'])) {

  $ucod  = $_POST['cod'];
  $unome  = $_POST['nome'];
  $uquantidadeTitulo  = $_POST['quantidadetitulo'];
  $uvalorUnitario  = $_POST['valorunitario'];
  $uvalor  = $_POST['valortotal'];
  $udata  = $_POST['data'];
  $uinstituicao    = $_POST['instituicao'];

  // Calculo de Valor Unitario

  $uvalor = ("$uquantidadeTitulo") * ("$uvalorUnitario");




  if (count($error) == 0) {

    $sql = "INSERT INTO cofre (cod,nome,quantidadetitulo,valorunitario,valortotal,data,instituicao) VALUES ('$ucod', '$unome','$uquantidadeTitulo','$uvalorUnitario','$uvalor','$udata','$uinstituicao')";

    $res = mysqli_query($con, $sql);
  }

  if ($res) {
  }
  echo "<h4 style='text-align: center;'>Valor Lançado com Sucesso !!</h4>";
  echo "<h4 style='text-align: center;'>$uValorTotal</h4>";
}

if (count($error) != 0) {
  foreach ($error as $erro) {
    echo $erro . "<br />";
  }
}



// Exclusao de Dados Cadastrados no Banco de Dados


if ($act == 'exclusao') {
  $ucod  = strip_tags($_GET['id']);
  $sqld = "delete from cofre where cod='$ucod'";

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
            <h5 class="title title-color-green">Lançar Valores Dentro do Cofre</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="cadastro">

                <input type="hidden" id="usuario" name="usuario">

                <input type="hidden" id="cod" name="cod" value="0">


                <label>Nome da Carteira</label>
                <input class="form-control" type="text" id="nome" name="nome">

                <br>
                <br>

                <label>Quantidade de Titulos</label>
                <input class="form-control" type="number" id="quantidadetitulo" name="quantidadetitulo">

                <br>
                <br>

                <label>Valor Unitário do Titulo</label>
                <input class="form-control" type="number" step="any" id="valorunitario" name="valorunitario">

                <br>
                <br>

                <label>Data do Aporte</label>
                <input class="form-control" type="date" id="data" name="data">

                <br>
                <br>

                <label>Intituição/Corretora</label>
                <input class="form-control" type="text" id="uinstituicao" name="instituicao">

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
            <h5 class="title title-color-green"> Valores Lançados No Cofre</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                <thead class=" text-primary">
                  <tr>
                    <th class="title-color-green">Nome da Carteira</th>
                    <th class="title-color-green">Quantidade de Titulos</th>
                    <th class="title-color-green">Data do Aporte</th>
                    <th class="title-color-green">Intituição/Corretora</th>
                    <th class="title-color-green">Valor Unitário</th>
                    <th class="title-color-green">Valor Total</th>
                    <th class="title-color-green">Ações</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  // Consulta de Dados no Banco de Dados

                  $sql = "SELECT * FROM cofre ";
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

                      <td>
                        <a class="btn btn-danger" href="?id=<?php echo $ucod; ?>&act=exclusao" onclick="return confirm('Deseja Realmente Excluir Este Valor do Cofre ?')">
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
                <h5 class="title title-color-green"> Total de Todos os Valores Já Lançados</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive ">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                        <th class="datatable-color">Valor Total</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php


                      //Consulta e Soma de Valores do Banco de Dados

                      $total = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre");



                      //Soma de Valores do Banco de Dados

                      while ($sum = mysqli_fetch_array($total)) :

                        $tcfpsoma = 'R$ ' . number_format($sum['SUM(valortotal)'], 2, ',', '.');



                      ?>


                        <tr>
                          <!-- Apresentacao dos Valores do Banco de Dados -->


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