<?php
 // Importar o módulo
 require("../bibliotecas/phplot-6.2.0/phplot.php");
 require_once('../../conexao.php');
  
 // Instanciar o gráfico com tamanho pré-definido
 // Deixar em branco faz com que o gráfico encaixe na janela
 $grafico = new PHPlot(1400,700);
  
 // Definindo o formato final da imagem
 $grafico->SetFileFormat("png");
  
 // Definindo o título do gráfico
 $grafico->SetTitle("Investimentos nos Ultimos Meses");
  
 // Tipo do gráfico
 // Por ser: lines, bars, linepoints, pizza, points, squared, stackedarea, stackedbars, thinbarline
 $grafico->SetPlotType("bars");
  
 // Título dos dados no eixo Y
 $grafico->SetYTitle("Valores Totais");
  
 // Título dos dados no eixo X
 $grafico->SetXTitle("Ultimos Meses");

 
 $ano = date('Y');
 $mes = date('m');
 $dia = date('d');
 



 //analizar //


 // Calculo dos Meses //

 // Calculo Mes Janeiro //
 $totaljan = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-01-01' AND '$ano-02-01'");

                         while($sum = mysqli_fetch_array($totaljan)):

                        $somajan = $sum['SUM(valortotal)'];

                    endwhile;
                    // Calculo Mes Janeiro //



// Calculo Mes fevereiro //
                    $totalfev = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-02-01' AND '$ano-03-01'");

                         while($sum = mysqli_fetch_array($totalfev)):

                        $somafev = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes fevereiro //



                    // Calculo Mes Marco //
                    $totalmarc = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-03-01' AND '$ano-04-01'");

                         while($sum = mysqli_fetch_array($totalmarc)):

                        $somamarc = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes Marco //


 



  // Calculo Mes abril //
                    $totalabr = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-04-01' AND '$ano-05-01'");

                         while($sum = mysqli_fetch_array($totalabr)):

                        $somaabr = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes abril //



  // Calculo Mes maio //
                    $totalmai = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-05-01' AND '$ano-06-01'");

                         while($sum = mysqli_fetch_array($totalmai)):

                        $somamai = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes maio //



  // Calculo Mes junho //
                    $totaljun = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-06-01' AND '$ano-07-01'");

                         while($sum = mysqli_fetch_array($totaljun)):

                        $somajun = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes junho //



  // Calculo Mes julho //
                    $totaljulh = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-07-01' AND '$ano-08-01'");

                         while($sum = mysqli_fetch_array($totaljulh)):

                        $somajulh = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes julho //



  // Calculo Mes agosto //
                    $totalago = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-08-01' AND '$ano-09-01'");

                         while($sum = mysqli_fetch_array($totalago)):

                        $somaago = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes agosto //



  // Calculo Mes setembro //
                    $totalset = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-09-01' AND '$ano-10-01'");

                         while($sum = mysqli_fetch_array($totalset)):

                        $somaset = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes setembro //



  // Calculo Mes outubro //
                    $totalout = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-10-01' AND '$ano-11-01'");

                         while($sum = mysqli_fetch_array($totalout)):

                        $somaout = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes outubro //



  // Calculo Mes novembro //
                    $totalnov = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-11-01' AND '$ano-12-01'");

                         while($sum = mysqli_fetch_array($totalnov)):

                        $somanov = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes novembro //



  // Calculo Mes dezembro //
                    $totaldez = mysqli_query($con, "SELECT SUM(valortotal) FROM cofre WHERE data BETWEEN '$ano-12-01' AND '$ano-12-31'");

                         while($sum = mysqli_fetch_array($totaldez)):

                        $somadez = $sum['SUM(valortotal)'];

                    endwhile;
  // Calculo Mes dezembro //


  // Calculo dos Meses //

  
                        

  //analizar //  

  // Calculo dos Meses //
 $jan = $somajan;
 $fev = $somafev;
 $marc = $somamarc;
 $abr = $somaabr;
 $mai = $somamai;
 $jun = $somajun;
 $julh = $somajulh;
 $ago = $somaago;
 $set = $somaset;
 $out = $somaout;
 $nov = $somanov;
 $dez = $somadez;

   
 // dados do gráfico
 $dados = array(
 array('jan', $jan ),
 array('fev', $fev ),
 array('marc', $marc ),
 array('abr', $abr ),
 array('mai', $mai ),
 array('jun', $jun ),
 array('julh', $julh ),
 array('ago', $ago ),
 array('set', $set ),
 array('out', $out ),
 array('nov', $nov ),
 array('dez', $dez ),
 );
  



 $grafico->SetDataValues($dados);
  
 //Exibimos o gráfico
 $grafico->DrawGraph();
