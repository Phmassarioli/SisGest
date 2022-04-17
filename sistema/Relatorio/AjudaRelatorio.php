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
            <h5 class="title title-color-green"> Como Funciona ?</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Na área de Relatório é o local onde você pode Ver todos os Valores Lancados.
             Desde contas pagas até valores ganhos e gastos do dia a dia tudo detalhado basta
              apenas inserir as datas de inicio e data final para ver todos os dados.
            

</p>

<img src="img/Relatorio1.png" alt="Relatorio">
           


            </div>
          </div>
        </div>
      </div>
    </div>


    
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-green"> Valores dentro do Ano</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Já na aba de Valores Anuais  é possível Ver um breve relatorio de todos valores ganhos,contas pagas e gastos do dia a dia
               dentro do ano, um pequeno grafico para se comparar valores entre os meses e a somatoria de valores.
            

</p>
<p>

<img src="img/Relatorio1.png" alt="Relatorio">
<p>
           
<img src="img/ValoresAnuais1.png" alt="ValoresAnuais">
<p>
<img src="img/ValoresAnuais2.png" alt="ValoresAnuais">
<p>
<img src="img/ValoresAnuais3.png" alt="ValoresAnuais">
<p>
<img src="img/ValoresAnuais4.png" alt="ValoresAnuais">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-green"> Auditoria</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Na área de Auditoria é o local onde você pode Ver obter um relatorio em arquivo PDF disponivel para ser impresso.
            Basta voce escolher entre duas opções que são escolher um arquivo entre duas datas de inicio e fim, ou um arquivo completo
            

</p>
<p>
<img src="img/Auditoria1.png" alt="Relatorio">
<p>

<img src="img/Auditoria2.png" alt="Relatorio">
           


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