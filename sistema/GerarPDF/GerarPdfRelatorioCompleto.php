<?php
error_reporting(0);
ob_start();
session_start();

$usuario = $_SESSION['usuario'];
include "../../conexao.php";
$act = $_REQUEST['act'];

//Variaveis para Coleta de Dados Inseridos no Formulario Para Envio para a Consulta no Banco de Dados

$datainicio = '';
$datafinal = '';

$texto_botao = "Gerar Arquivo PDF";






?>

<body>

  <?php
  // Aproveitamento de Codigo do Layout

  include "../head.php";
  include '../Relatorio/Menu.php';
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
            <h4 class="title title-color-blue" style="text-align: center;"> Relatório Padrao</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-blue"> Selecione um Periodo</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <form action="PDF/PdfRelatorioCompleto.php" method="post" enctype="multipart/form-data" name="cadastro" target="new_blank">



                <input type="hidden" id="usuario" name="usuario" value="<?php $usuario; ?>" />

                <label>Data Inicio</label>
                <input class="form-control" type="date" id="$datainicio" name="datainicio" value="<?php $datainicio; ?>" OnKeyPress="formatar('##/##/##', this)" />

                <br>

                <label>Data Fim</label>
                <input class="form-control" type="date" id="$datafinal" name="datafinal" value="<?php $datafinal; ?>" OnKeyPress="formatar('##/##/##', this)" />

                <br>

                <button type="submit" id="btok" class="btn btn-primary"><?php echo $texto_botao; ?></button>

              </form>


            </div>
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