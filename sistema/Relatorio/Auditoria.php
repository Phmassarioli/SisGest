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

  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-blue"> Selecione Uma Das Opções !</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive ">

              <a type="button" class="btn btn-primary btn-lg btn-block" href="../GerarPDF/GerarPdfRelatorioPeriodo.php">Gerar Arquivo Dentro de um Periodo Especifico</a>
              <a type="button" class="btn btn-primary btn-lg btn-block" href="../GerarPDF/PDF/PdfRelatorioCompleto.php">Gerar Arquivo Completo</a>





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