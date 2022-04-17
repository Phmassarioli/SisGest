<?php
error_reporting(0);
ob_start();
session_start();

$texto_botao = "OK";

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
            <h5 class="title title-color-green"> Como Funciona ?</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <p>Na área de Ganhos é o local onde você pode inserir todos os Ganhos do dia a dia ou no mês. Por exemplo 
              Se você recebe um pagamento de R$ 1.000,00 de um Salario ou se voce for um profissional autonomo de um servico. Basta apenas colocar o nome
              do ganho que no caso poder ser um salario do mês ou nome de um serviço realizado, a origem do ganho que pode ser uma breve descrição como salario de (abril)
              ou servico de limpeza de uma casa, a data do dia que foi ganhado a renda e o valor
              do total ganhado.
</p>

            <img src="img/LancarGanho.png" alt="Tela de Lancar Gastos">



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
            <h5 class="title title-color-green"> Aba de Ganhos</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <p>Na aba de Ganhos é possível realizar consulta de Valores Ganhos dentro de um período especifico
                Onde você insere a data de começo do período e a data final. Por exemplo se quiser saber o quanto você
                Ganhou em um determinado Periodo. Basta você inserir as datas que você saberá o quanto de valores foram Ganhos naquele Periodo.
</p>
             
        <img src="img/Ganhos.png" alt="Tela de Lancar Gastos">

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
            <h5 class="title title-color-green"> Aba de Ganhos Específicos</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <p>Já na aba de Ganhos específicos é possível realizar consulta de um Ganho especifico dentro de um período. 
                Por exemplo, você quer saber a quantia que você Ganhou com Salarios ou serviços dentro de um periodo. Basta você inserir 
                as datas de inicio e fim do período que você saberá o quanto de valores que voce ganhou naquele Período.</p>
             
                <img src="img/GanhoEspecifico.png" alt="Tela de Lancar Gastos">



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
            <p>Já na aba de Valores Anuais  é possível Ver um breve relatorio de valores ganhos
               dentro do ano, um pequeno grafico para se comparar valores entre os meses e a somatoria de valores Ganhos dentro do ano.</p>
             
                <img src="img/ValoresAnuais1.png" alt="Tela de Lancar Gastos">

                <img src="img/ValoresAnuais2.png" alt="Tela de Lancar Gastos">

            </div>
          </div>
        </div>
      </div>
    </div>

    

    <a type="submit" id="btok" class="btn btn-success" href="../Ganhos/LancarGanhos.php"><?php echo $texto_botao; ?></a>
  



                <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   
    <?php

    include "../footer.php";


    ?>