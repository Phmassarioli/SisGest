<?php
error_reporting(0);
ob_start();
session_start();

$usuario = $_SESSION['usuario'];
include "../../conexao.php";
$act = $_REQUEST['act'];
$texto_botao = "Menu Principal";
$tes = " $link";


ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL); //force php to show any error message

backup_tables('localhost', 'root', '', 'sisgest'); //don't forget to fill with your own database access informations

function backup_tables($host, $user, $pass, $name)
{
  $link = mysqli_connect($host, $user, $pass);
  mysqli_select_db($link, $name);
  $tables = array();
  $result = mysqli_query($link, 'SHOW TABLES');
  $i = 0;
  while ($row = mysqli_fetch_row($result)) {
    $tables[$i] = $row[0];
    $i++;
  }
  $return = "";
  foreach ($tables as $table) {
    $result = mysqli_query($link, 'SELECT * FROM ' . $table);
    $num_fields = mysqli_num_fields($result);
    $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
    $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE ' . $table));
    $return .= "\n\n" . $row2[1] . ";\n\n";
    for ($i = 0; $i < $num_fields; $i++) {
      while ($row = mysqli_fetch_row($result)) {
        $return .= 'INSERT INTO ' . $table . ' VALUES(';
        for ($j = 0; $j < $num_fields; $j++) {
          $row[$j] = addslashes($row[$j]);
          if (isset($row[$j])) {
            $return .= '"' . $row[$j] . '"';
          } else {
            $return .= '""';
          }
          if ($j < ($num_fields - 1)) {
            $return .= ',';
          }
        }
        $return .= ");\n";
      }
    }
    $return .= "\n\n\n";
  }
  //save file
  $handle = fopen('db_bkp/sisgest ' . date('d-m-yy') . ("--") . (md5(implode(',', $tables))) . '.sql', 'w+'); //Don' forget to create a folder to be saved, "db_bkp" in this case

  fwrite($handle, $return);
  fclose($handle);
}

?>

<body>

  <?php

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
            <h4 class="card-title title-color-blue"> Backup Realizado com Sucesso!!!</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">

            </div>
          </div>
        </div>
      </div>
    </div>


    <a class="btn btn-primary" href="../sistema/../Backup/db_bkp">
      <i></i>
      Acessar Pasta de Backup
    </a>


    <!-- external javascript
   <?php include '../js.php'; ?>
   
  
    <?php

    include "../footer.php";

    ?>