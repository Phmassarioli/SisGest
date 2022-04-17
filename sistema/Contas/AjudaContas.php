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
             <p>Na área de Contas é o local onde você pode inserir todas as Contas pagas no Mês. Por exemplo 
              Se você paga uma fatura de um cartão de credito de R$ 200,00 no mês. Basta apenas colocar o nome da conta que nesse caso seria Cartão de Credito, o valor
              do total que foi Pago na Conta, a data que foi realizado o Pagamento e o local que no caso seria o nome do local onde foi pago a conta.
</p>
            <img src="img/LancarConta.png" alt="Tela de Lancar Gastos">



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
            <h5 class="title title-color-red">Aba de Contas </h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Na aba de Contas é possível realizar consulta de Contas pagas dentro de um período especifico
                Onde você insere a data de começo do período e a data final. Por exemplo se quiser saber o quanto você
                pagou de contas em um determinado Periodo. Basta você inserir as datas que você saberá o quanto de valores foram pagos em contas naquele Periodo.
</p>
             
        <img src="img/Contas.png" alt="Tela de Lancar Gastos">



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
            <h5 class="title title-color-red">Aba de Contas Específicas </h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Já na aba de Contas específicas é possível realizar consulta de uma conta especifica dentro de um período. 
                Por exemplo, você quer saber a quantia que você pagou em contas com Banco dentro de um periodo. Basta você inserir 
                as datas de inicio e fim do período que você saberá o quanto de valores de contas pagas foram gastos com Banco naquele Período.</p>
             
                <img src="img/ContaEspecifica.png" alt="Tela de Lancar Gastos">



            </div>
          </div>
        </div>
      </div>
    </div>


    <a type="submit" id="btok" class="btn btn-danger "href="../Contas/LancarContas.php"><?php echo $texto_botao; ?></a>
  



                <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   
    <?php

    include "../footer.php";


    ?>