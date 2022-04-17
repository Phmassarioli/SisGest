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
             <p>Na área do Cofre é o local onde você pode lancar todos os Valores Guardados.
              Por exemplo Se você tiver uma reserva de dinheiro guardada na sua conta poupanca, esses valores podem ser lancados nesta area.
              Assim com Valores de investimentos e afins.
            

</p>

<img src="img/LancarCofre.png" alt="LancarCofre">
           


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
            <h5 class="title title-color-green"> Aba Resgate de Valores </h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Na area de resgate de valores é o local onde você pode lancar valores de retirada do valor do montante guardado.
               por exemplo em caso de necessidade você precise tirar uma quantia de dinheiro de sua conta poupanca este é o local para lancar este valor. </p>
            
            
               <img src="img/ResgateCofre.png" alt="ResgateCofre">


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
            <h5 class="title title-color-green"> Valores Dentro do Ano </h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
             <p>Já na aba de Valores Anuais é possível Ver um breve relatorio de valores 
               Guardados e Resgatados do Cofre, um pequeno grafico para se comparar valores entre os meses e a somatoria
               de valores dentro do ano.</p>
            
            
               <img src="img/ComparativoAnual1.png" alt="ComparativoAnua">
               <p>
               <p>
               <img src="img/ComparativoAnual2.png" alt="ComparativoAnua">
               <p>
                
               
               <img src="img/ComparativoAnual3.png" alt="ComparativoAnua">
               <p>

            </div>
          </div>
        </div>
      </div>
    </div>

    

   
 

    <a type="submit" id="btok" class="btn btn-success" href="../Cofre/LancarValores.php"><?php echo $texto_botao; ?></a>
  



                <!-- external javascript
   <?php include '../js.php'; ?>
   
   <?php // fecha a conexão
    mysqli_close($con); ?>
   
    <?php

    include "../footer.php";


    ?>