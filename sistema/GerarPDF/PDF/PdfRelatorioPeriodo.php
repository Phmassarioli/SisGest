<?php

error_reporting(0);
ini_set('display_errors', 0);

//include_once '../controller/LocacaoController.php';
include('../../bibliotecas/mpdf/mpdf.php');
include "../../../conexao.php";



// Coleta de Dados Inseridos no Formulario Para Envio para a Consulta no Banco de Dados


if (isset($_POST['usuario'])) {

  $datainicio = $_POST['datainicio'];
  $datafinal = $_POST['datafinal'];
}

// Consulta de Dados no Banco de Dados

$sql = "SELECT * FROM ganhos WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC";
$uquery = mysqli_query($con, $sql);
$total_usuarios = mysqli_num_rows($uquery);
while ($lncp = mysqli_fetch_object($uquery)) :
  $ucodganhos[] = $lncp->cod;
  $unomeganho[] = $lncp->nomeganho;
  $uorigemganho[] = $lncp->origemganho;
  $udata[] = $lncp->data;
  $uvalorganho[] = $lncp->valor;


endwhile;

// Consulta de Dados Agrupados no Banco de Dados

$sql = "SELECT nomeganho, SUM(valor) AS valor FROM ganhos WHERE data >='$datainicio' AND data <= '$datafinal' GROUP BY nomeganho";
$uquery = mysqli_query($con, $sql);
$total_usuarios = mysqli_num_rows($uquery);

while ($lncp = mysqli_fetch_object($uquery)) :
  $ucodGanhosGroup[] = $lncp->cod;
  $unomeganhoGanhosGroup[] = $lncp->nomeganho;
  $uvalorGanhosGroup[] = $lncp->valor;

endwhile;


// Consulta de Dados no Banco de Dados

$sql = "SELECT * FROM contasfixas WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC";
$uquery = mysqli_query($con, $sql);
$total_usuarios = mysqli_num_rows($uquery);
while ($lncp = mysqli_fetch_object($uquery)) :
  $ucod[] = $lncp->cod;
  $unomeconta[] = $lncp->nomeconta;
  $uvalor[] = $lncp->valor;
  $udata[] = $lncp->data;
  $ulocal[] = $lncp->local;


endwhile;

// Consulta de Dados Agrupados no Banco de Dados

$sql = "SELECT nomeconta, SUM(valor) AS valor FROM contasfixas WHERE data >='$datainicio' AND data <= '$datafinal' GROUP BY nomeconta";
$uquery = mysqli_query($con, $sql);
$total_usuarios = mysqli_num_rows($uquery);

while ($lncp = mysqli_fetch_object($uquery)) :
  $ucodContasGroup[] = $lncp->cod;
  $unomecontaContasGroup[] = $lncp->nomeconta;
  $uvalorContasGroup[] = $lncp->valor;

endwhile;



// Consulta de Dados no Banco de Dados

$sql = "SELECT * FROM gastos WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC";
$uquery = mysqli_query($con, $sql);
$total_usuarios = mysqli_num_rows($uquery);
while ($lncp = mysqli_fetch_object($uquery)) :
  $ucodgasto[] = $lncp->cod;
  $unomegasto[] = $lncp->nomegasto;
  $uvalorgasto[] = $lncp->valorgasto;
  $udatagasto[] = $lncp->data;
  $ulocalgasto[] = $lncp->local;

endwhile;



// Consulta de Dados Agrupados no Banco de Dados

$sql = "SELECT nomegasto, SUM(valorgasto) AS valorgasto FROM gastos WHERE data >='$datainicio' AND data <= '$datafinal' GROUP BY nomegasto";
$uquery = mysqli_query($con, $sql);
$total_usuarios = mysqli_num_rows($uquery);

while ($lncp = mysqli_fetch_object($uquery)) :
  $ucodGastoGroup[] = $lncp->cod;
  $unomegastoGastoGroup[] = $lncp->nomegasto;
  $uvalorgastoGastoGroup[] = $lncp->valorgasto;

endwhile;


//Consulta e Soma de Valores do Banco de Dados

$totalganhos = mysqli_query($con, "SELECT SUM(valor)  FROM ganhos WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC");


//Soma de Valores do Banco de Dados

while ($sum = mysqli_fetch_array($totalganhos)) :

  $somaganhos = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

endwhile;





//Consulta e Soma de Valores do Banco de Dados

$ctotal = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC");


//Soma de Valores do Banco de Dados

while ($sum = mysqli_fetch_array($ctotal)) :

  $csoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

endwhile;




//Consulta e Soma de Valores do Banco de Dados

$gtotal = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC");



//Soma de Valores do Banco de Dados

while ($sum = mysqli_fetch_array($gtotal)) :

  $gsoma = 'R$ ' . number_format($sum['SUM(valorgasto)'], 2, ',', '.');

endwhile;




// Consulta de Dados no Banco de Dados

$sql = "SELECT * FROM cofre WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC";
$uquery = mysqli_query($con, $sql);
$total_usuarios = mysqli_num_rows($uquery);
while ($lncp = mysqli_fetch_object($uquery)) :
  $ucodcofre[] = $lncp->cod;
  $unomecofre[] = $lncp->nome;
  $uquantidadeTitulo[] = $lncp->quantidadetitulo;
  $uvalorUnitario[] = $lncp->valorunitario;
  $udatacofre[] = $lncp->data;
  $uinstituicaocofre[] = $lncp->instituicao;
  $uvalorcofre[] = $lncp->valortotal;


endwhile;


// Consulta de Dados Agrupados no Banco de Dados

$sql = "SELECT nome, SUM(valortotal) AS valortotal FROM cofre WHERE data >='$datainicio' AND data <= '$datafinal' GROUP BY nome";
$uquery = mysqli_query($con, $sql);
$total_usuarios = mysqli_num_rows($uquery);

while ($lncp = mysqli_fetch_object($uquery)) :
  $ucodCofreGroup[] = $lncp->cod;
  $unomeCofreGroup[] = $lncp->nome;
  $uvalorCofreGroup[] = $lncp->valortotal;

endwhile;

//Consulta e Soma de Valores do Banco de Dados

$totalcofre = mysqli_query($con, "SELECT SUM(valortotal)  FROM cofre WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC");



//Soma de Valores do Banco de Dados

while ($sum = mysqli_fetch_array($totalcofre)) :

  $cofresoma = 'R$ ' . number_format($sum['SUM(valortotal)'], 2, ',', '.');

endwhile;



// Consulta de Dados no Banco de Dados

$sql = "SELECT * FROM resgatecofre WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC";
$uquery = mysqli_query($con, $sql);
$total_usuarios = mysqli_num_rows($uquery);
while ($lncp = mysqli_fetch_object($uquery)) :
  $ucodresgate[] = $lncp->cod;
  $udataresgate[] = $lncp->data;
  $uvalorresgate[] = $lncp->valor;



endwhile;


//Consulta e Soma de Valores do Banco de Dados

$totalresgate = mysqli_query($con, "SELECT SUM(valor)  FROM resgatecofre WHERE data >='$datainicio' AND data <= '$datafinal' ORDER BY data ASC");




//Soma de Valores do Banco de Dados

while ($sum = mysqli_fetch_array($totalresgate)) :

  $resgatesoma = 'R$ ' . number_format($sum['SUM(valor)'], 2, ',', '.');

endwhile;





$corpo_pagina = "
<html>

  <body>
  

  <div class='titulo'>
  <h1> Relatório de Ganhos no Periodo</h1>
</div>

<br>

  <table class='tabela'>
  <thead>

  <tr>

<th class='tabela'>Data do Ganho</th>
<th class='tabela'>Nome do Ganho</th>
<th class='tabela'>Origem do Ganho</th>
<th class='tabela'>Valor do Ganho</th>

</tr>

</thead>



";

for ($i = 0; $i < count($ucodganhos); $i++) {

  $corpo_pagina .= "
  

  <tbody>

  <tr>
  <td class='tabela'>" . $udata[$i] . "</td>
  <td class='tabela'>" . $unomeganho[$i] . "</td>
  <td class='tabela'>" . $uorigemganho[$i] . "</td>
  <td class='tabela fontgreen'>R$ " . $uvalorganho[$i] . "</td>

</tr>

</tbody>

";
}






$corpo_pagina .= "


                 
                  </table>

                  <div style='page-break-after: always'></div>

                  <div class='titulo'>
                  <h1>Ganhos Agrupados no Periodo</h1>
                </div>


                <br>
                        
                          <table class='tabela'>
                          <thead>
                        
                          <tr>
                        
                        <th class='tabela'>Nome do Ganho</th>
                        <th class='tabela'>Valor Total</th>
                        
                        </tr>
                        
                        </thead>

                        ";

for ($i = 0; $i < count($ucodGanhosGroup); $i++) {

  $corpo_pagina .= "
                          
                        
                          <tbody>
                        
                          <tr>
                          <td class='tabela'>" . $unomeganhoGanhosGroup[$i] . "</td>
                          <td class='tabela fontgreen'>R$ " . $uvalorGanhosGroup[$i] . "</td>


                        
                        </tr>
                        
                        </tbody>
                        
                        ";
}


$corpo_pagina .= "


                        </table>


                       
                  <div style='page-break-after: always'></div>

                  <div class='titulo'>
                  <h1> Total de Ganhos no Periodo</h1>
                  </div>
                  
                  <br>

                  <div class='titulo'>
                  <table>
                  <thead>
                  <tr>
       
                  <div>
                      <th>Valor Total de Ganhos</th>
    
                      </tr>
                      </thead>
    
                      <tbody>
    
                      <tr>
    
                      <td class='fontgreen demarq'> $somaganhos</td>
    
                      </tr>
    
                      </tbody>
                      </table>

                      </div>

                     
                      <div style='page-break-after: always'></div>
                      
                      

  <div class='titulo'>
  <h1>Relatório de Contas Pagas no Periodo</h1>
</div>

<br>

  <table class='tabela'>
  <thead>

  <tr>


<th class='tabela'>Nome  da  Conta</th>
<th class='tabela'>Data de Pagamento</th>
<th class='tabela'>Local de Pagamento</th>
<th class='tabela'>Valor  da  Conta</th>

</tr>

</thead>



";

for ($i = 0; $i < count($ucod); $i++) {

  $corpo_pagina .= "
  

  <tbody>

  <tr>
  
  <td class='tabela'>" . $unomeconta[$i] . "</td>
  <td class='tabela'>" . $udata[$i] . "</td>
  <td class='tabela'>" . $ulocal[$i] . "</td>
  <td class='tabela fontred'>R$ " . $uvalor[$i] . "</td>

</tr>

</tbody>



";
}



$corpo_pagina .= "


</table>
                 

                  <div style='page-break-after: always'></div>

                  <div class='titulo'>
  <h1>Contas Pagas Agrupadas no Periodo</h1>
</div>

<br>

  <table class='tabela'>
  <thead>

  <tr>


<th class='tabela'>Nome  da  Conta</th>
<th class='tabela'>Valor Total</th>

</tr>

</thead>





";

for ($i = 0; $i < count($ucodContasGroup); $i++) {

  $corpo_pagina .= "
  

  <tbody>

  <tr>
  
  <td class='tabela'>" . $unomecontaContasGroup[$i] . "</td>
  <td class='tabela fontred'>R$ " . $uvalorContasGroup[$i] . "</td>

  

</tr>

</tbody>



";
}



$corpo_pagina .= "


                          </table>


                  <div style='page-break-after: always'></div>



                  <div class='titulo'>
                  <h1> Total de Contas Pagas no Periodo</h1>
                  <table>
                  <thead>
                  <tr>
       
                  <div>
                      <th>Valor Total de Contas Pagas</th>
    
                      </tr>
                      </thead>
    
                      <tbody>
    
                      <tr>
    
                      <td class='fontred demarq'>$csoma</td>
    
                      </tr>
    
                      </tbody>
                      </table>

                      </div>

                      <div style='page-break-after: always'></div>


                              

";





$corpo_pagina .= "


  
  

  <div class='titulo'>
  <h1>Relatório de Gastos no Periodo</h1>
  </div>

  <br>

  <table class='tabela'>
  <thead>

  <tr>

<th class='tabela'>Nome do Gasto</th>
<th class='tabela'>Data do Gasto</th>
<th class='tabela'>Local do Gasto</th>
<th class='tabela'>Valor do Gasto</th>

</tr>

</thead>



";

for ($i = 0; $i < count($ucodgasto); $i++) {

  $corpo_pagina .= "


  <tbody>

  <tr>
  <td class='tabela'>" . $unomegasto[$i] . "</td>
  <td class='tabela'>" . $udatagasto[$i] . "</td>
  <td class='tabela'>" . $ulocalgasto[$i] . "</td>
  <td class='tabela fontred'>R$ " . $uvalorgasto[$i] . "</td>


</tr>

</tbody>

";
}



$corpo_pagina .= "


                 
                  </table>

                  <div style='page-break-after: always'></div>


                  <div class='titulo'>
                  <h1>Gastos Agrupados no Periodo</h1>
                  </div>
                
                  <br>
                
                  <table class='tabela'>
                  <thead>
                
                  <tr>
                
                <th class='tabela'>Nome do Gasto</th>
                <th class='tabela'>Valor do Gasto</th>
                
                </tr>
                
                </thead>
                
                
                
                ";

for ($i = 0; $i < count($ucodGastoGroup); $i++) {

  $corpo_pagina .= "
                
                
                  <tbody>
                
                  <tr>
                  <td class='tabela'>" . $unomegastoGastoGroup[$i] . "</td>
                  <td class='tabela fontred'>R$ " . $uvalorgastoGastoGroup[$i] . "</td>

                 
                
                
                </tr>
                
                </tbody>
                
                ";
}

$corpo_pagina .= "

                </table>

                  <div style='page-break-after: always'></div>

                  <div class='titulo'>
                  <h1>Total de Gastos no Periodo</h1>
                  <table>
                  <thead>
                  <tr>
       
                  
                      <th>Valor Total de Gastos</th>
    
                      </tr>
                      </thead>
    
                      <tbody>
    
                      <tr>
    
                      <td class='fontred demarq'> $gsoma</td>
    
                      </tr>
    
                      </tbody>
                      </table>

                      </div>

                                 

";


$corpo_pagina .= "


                 
                  </table>

                  <br>
                  <br>

                  <div style='page-break-after: always'></div>
                  <div class='titulo'>
                  <h1> Relatório de Investimentos no Periodo</h1>
                </div>
                
                <br>
                
                  <table class='tabela'>
                  <thead>
                
                  <tr>
                
                <th class='tabela'>Nome do Investimento</th>
                <th class='tabela'>Quantidade de Titulos</th>
                <th class='tabela'>Valor Unitário</th>
                <th class='tabela'>Data do Investimento</th>
                <th class='tabela'>Instituição/Corretora</th>
                <th class='tabela'>Valor Total</th>
                
                
                </tr>
                
                </thead>
                
                
                
                ";

for ($i = 0; $i < count($ucodcofre); $i++) {

  $corpo_pagina .= "
                  
                
                  <tbody>
                
                  <tr>
                  <td class='tabela'>" . $unomecofre[$i] . "</td>
                  <td class='tabela'>" . $uquantidadeTitulo[$i] . "</td>
                  <td class='tabela'>" . $uvalorUnitario[$i] . "</td>
                  <td class='tabela'>R$ " . $udatacofre[$i] . "</td>
                  <td class='tabela'>" . $uinstituicaocofre[$i] . "</td>
                  <td class='tabela fontgreen'>R$ " . $uvalorcofre[$i] . "</td>

                  


                
                </tr>
                
                </tbody>
                
                ";
}



$corpo_pagina .= "
                
                
                                 
                                  </table>

                                  <div style='page-break-after: always'></div>
                                  
                                  <div class='titulo'>
                                  <h1>Investimentos Agrupados no Periodo</h1>
                                </div>
                                
                                <br>
                                
                                  <table class='tabela'>
                                  <thead>
                                
                                  <tr>
                                
                                <th class='tabela'>Nome do Investimento</th>
                                <th class='tabela'>Valor Total</th>
                                
                                
                                </tr>
                                
                                </thead>
                                
                                
                                
                                ";

for ($i = 0; $i < count($ucodCofreGroup); $i++) {

  $corpo_pagina .= "
                                  
                                
                                  <tbody>
                                
                                  <tr>
                                  <td class='tabela'>" . $unomeCofreGroup[$i] . "</td>
                                  <td class='tabela fontgreen'>R$ " . $uvalorCofreGroup[$i] . "</td>

                                
                                </tr>
                                
                                </tbody>
                                
                                ";
}


$corpo_pagina .= "

                                                          </table>   
                
                                  <div style='page-break-after: always'></div>
                
                                  <div class='titulo'>
                                  <h1> Total de Investimentos no Periodo</h1>
                                  </div>
                                  
                                  <br>
                
                                  <div class='titulo'>
                                  <table>
                                  <thead>
                                  <tr>
                       
                                  <div>
                                      <th>Valor Total de Investimentos</th>
                    
                                      </tr>
                                      </thead>
                    
                                      <tbody>
                    
                                      <tr>
                    
                                      <td class='fontgreen demarq'> $cofresoma</td>
                    
                                      </tr>
                    
                                      </tbody>
                                      </table>
                                      



                               

";

$corpo_pagina .= "


                 
                  </table>

                  <br>
                  <br>

                  <div style='page-break-after: always'></div>
                  <div class='titulo'>
                  <h1> Relatório de Valores Resgatados de  Investimentos no Periodo</h1>
                </div>
                
                <br>
                
                  <table class='tabela'>
                  <thead>
                
                  <tr>
                
                <th class='tabela'>Data Resgate</th>
                <th class='tabela'>Valor Resgate</th>
               
                
                
                </tr>
                
                </thead>
                
                
                
                ";

for ($i = 0; $i < count($ucodresgate); $i++) {

  $corpo_pagina .= "
                  
                
                  <tbody>
                
                  <tr>
                  <td class='tabela'>" . $udataresgate[$i] . "</td>
                  <td class='tabela fontred'>" . $uvalorresgate[$i] . "</td>
                 
                 
                  


                
                </tr>
                
                </tbody>
                
                ";
}



$corpo_pagina .= "
                
                
                                 
                                  </table>
                
                                  <div style='page-break-after: always'></div>
                
                                  <div class='titulo'>
                                  <h1> Total de Valores Resgatados de Investimentos no Periodo</h1>
                                  </div>
                                  
                                  <br>
                
                                  <div class='titulo'>
                                  <table>
                                  <thead>
                                  <tr>
                       
                                  <div>
                                      <th>Valor Total de Valores Resgatados</th>
                    
                                      </tr>
                                      </thead>
                    
                                      <tbody>
                    
                                      <tr>
                    
                                      <td class='fontred demarq'> $resgatesoma</td>
                    
                                      </tr>
                    
                                      </tbody>
                                      </table>
                                      
                                      


                  </body>
                  </html>                 

";






$arquivo = "Relatorio por Periodo.pdf";
$mpdf = new mPDF();
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("../../bibliotecas/mpdf/css/estilo.css");
$mpdf->WriteHTML($css, 1);
$mpdf->WriteHTML($corpo_pagina);
ob_clean();
$mpdf->Output($arquivo, 'D');
// I - Abre no navegador
// F - Salva o arquivo no servido
// D - Salva o arquivo no computador do usuário
