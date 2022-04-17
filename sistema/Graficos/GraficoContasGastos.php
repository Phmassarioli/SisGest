<?php
// Importar o módulo
require("../bibliotecas/phplot-6.2.0/phplot.php");
require_once('../../conexao.php');


// Instanciar o gráfico com tamanho pré-definido
// Deixar em branco faz com que o gráfico encaixe na janela
$grafico = new PHPlot(1400, 700);

// Definindo o formato final da imagem
$grafico->SetFileFormat("png");

// Definindo o título do gráfico
$grafico->SetTitle("Comparativo de Contas Pagas + Gastos");

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
$totalgastjan = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-01-01' AND '$ano-02-01'");

$totalcontjan = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-01-01' AND '$ano-02-01'");




while ($sum = mysqli_fetch_array($totalcontjan) + mysqli_fetch_array($totalgastjan)) :

    $somagastcontjan = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;

// Calculo Mes fevereiro //
$totalgastfev = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-02-01' AND '$ano-03-01'");

$totalcontfev = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-02-01' AND '$ano-03-01'");




while ($sum = mysqli_fetch_array($totalcontfev) + mysqli_fetch_array($totalgastfev)) :

    $somagastcontfev = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes fevereiro //



// Calculo Mes Marco //
$totalgastmarc = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-03-01' AND '$ano-04-01'");

$totalcontmarc = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-03-01' AND '$ano-04-01'");




while ($sum = mysqli_fetch_array($totalcontmarc) + mysqli_fetch_array($totalgastmarc)) :

    $somagastcontmarc = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes Marco //






// Calculo Mes abril //
$totalgastabr = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-04-01' AND '$ano-05-01'");

$totalcontabr = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-04-01' AND '$ano-05-01'");




while ($sum = mysqli_fetch_array($totalcontabr) + mysqli_fetch_array($totalgastabr)) :

    $somagastcontabr = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes abril //



// Calculo Mes maio //
$totalgastmai = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-05-01' AND '$ano-06-01'");

$totalcontmai = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-05-01' AND '$ano-06-01'");




while ($sum = mysqli_fetch_array($totalcontmai) + mysqli_fetch_array($totalgastmai)) :

    $somagastcontmai = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes maio //



// Calculo Mes junho //
$totalgastjun = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-06-01' AND '$ano-07-01'");

$totalcontjun = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-06-01' AND '$ano-07-01'");




while ($sum = mysqli_fetch_array($totalcontjun) + mysqli_fetch_array($totalgastjun)) :

    $somagastcontjun = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes junho //



// Calculo Mes julho //
$totalgastjulh = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-07-01' AND '$ano-08-01'");

$totalcontjulh = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-07-01' AND '$ano-08-01'");




while ($sum = mysqli_fetch_array($totalcontjulh) + mysqli_fetch_array($totalgastjulh)) :

    $somagastcontjulh = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes julho //



// Calculo Mes agosto //
$totalgastago = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-08-01' AND '$ano-09-01'");

$totalcontago = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-08-01' AND '$ano-09-01'");




while ($sum = mysqli_fetch_array($totalcontago) + mysqli_fetch_array($totalgastago)) :

    $somagastcontago = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes agosto //



// Calculo Mes setembro //
$totalgastset = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-09-01' AND '$ano-10-01'");

$totalcontset = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-09-01' AND '$ano-10-01'");




while ($sum = mysqli_fetch_array($totalcontset) + mysqli_fetch_array($totalgastset)) :

    $somagastcontset = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes setembro //



// Calculo Mes outubro //
$totalgastout = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-10-01' AND '$ano-11-01'");

$totalcontout = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-10-01' AND '$ano-11-01'");




while ($sum = mysqli_fetch_array($totalcontout) + mysqli_fetch_array($totalgastout)) :

    $somagastcontout = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes outubro //



// Calculo Mes novembro //
$totalgastnov = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-11-01' AND '$ano-12-01'");

$totalcontnov = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-11-01' AND '$ano-12-01'");




while ($sum = mysqli_fetch_array($totalcontnov) + mysqli_fetch_array($totalgastnov)) :

    $somagastcontnov = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes novembro //



// Calculo Mes dezembro //
$totalgastdez = mysqli_query($con, "SELECT SUM(valorgasto)  FROM gastos WHERE data BETWEEN '$ano-12-01' AND '$ano-12-31'");

$totalcontdez = mysqli_query($con, "SELECT SUM(valor)  FROM contasfixas WHERE data BETWEEN '$ano-12-01' AND '$ano-12-31'");




while ($sum = mysqli_fetch_array($totalcontdez) + mysqli_fetch_array($totalgastdez)) :

    $somagastcontdez = $sum['SUM(valor)'] + $sum['SUM(valorgasto)'];



endwhile;
// Calculo Mes dezembro //


// Calculo dos Meses //




//analizar //  

// Calculo dos Meses //
$jan = $somagastcontjan;
$fev = $somagastcontfev;
$marc = $somagastcontmarc;
$abr = $somagastcontabr;
$mai = $somagastcontmai;
$jun = $somagastcontjun;
$julh = $somagastcontjulh;
$ago = $somagastcontago;
$set = $somagastcontset;
$out = $somagastcontout;
$nov = $somagastcontnov;
$dez = $somagastcontdez;


// dados do gráfico
$dados = array(
    array('jan', $jan),
    array('fev', $fev),
    array('marc', $marc),
    array('abr', $abr),
    array('mai', $mai),
    array('jun', $jun),
    array('julh', $julh),
    array('ago', $ago),
    array('set', $set),
    array('out', $out),
    array('nov', $nov),
    array('dez', $dez),
);




$grafico->SetDataValues($dados);

//Exibimos o gráfico
$grafico->DrawGraph();
