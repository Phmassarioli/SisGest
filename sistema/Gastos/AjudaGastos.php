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

  <div class="panel-header-red panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title title-color-red">Como Funciona ?</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Na área de gastos é o local onde você pode inserir todos os gastos do dia a dia. Por exemplo 
              Se você for ao mercado e fez uma compra de R$ 80,00, você não precisa colocar o nome e o preço de
              todos os itens que comprou. Basta apenas colocar o nome do gasto que nesse caso seria o MERCADO, o valor
              do total que foi gasto no mercado que seria R$ 80,00 a data que foi realizado o gasto e o local que no caso seria o nome do mercado.
</p>
            <img src="img/LancarGasto.png" alt="Tela de Lancar Gastos">



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
            <h5 class="title title-color-red">Aba de Gastos </h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Na aba de gastos é possível realizar consulta de Gastos dentro de um período especifico
                Onde você insere a data de começo do período e a data final. Por exemplo se quiser saber o quanto você
                gastou em um determinado mês basta você inserir as datas que você saberá o quanto de valores foram gastos naquele Periodo.
</p>
             
        <img src="img/Gastos.png" alt="Tela de Lancar Gastos">



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
            <h5 class="title title-color-red">Aba de Gastos Específicos </h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Já na aba de gastos específicos é possível realizar consulta de um Gasto especifico dentro de um período. 
                Por exemplo, você quer saber a quantia que você gastou com combustível dentro de um mês. Basta você inserir 
                as datas de inicio e fim do período que você saberá o quanto de valores foram gastos com combustível naquele Período.</p>
             
                <img src="img/GastoEspecifico.png" alt="Tela de Lancar Gastos">



            </div>
          </div>
        </div>
      </div>
    </div>


  
    <a type="submit" id="btok" class="btn btn-danger "href="../Gastos/LancarGasto.php"><?php echo $texto_botao; ?></a>
  



                <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   
    <?php

    include "../footer.php";


    ?>