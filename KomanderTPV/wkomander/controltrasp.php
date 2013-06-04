<?php
session_start();
session_name("loginUsuario");
require 'clases/includes.php';
include_once('clases/_trasp.php');
include_once('clases/_mesas.php');
include_once('clases/_i_historial.php');
include_once('clases/_pte.php');


$mesas = new _mesas(); 

  
 if (!isset($_GET['desdecobro'])){
    $tr = new _trasp();
    $tr->traspasar($_SESSION['mesa'], $_SESSION['comensal'], $_GET['mdestino'], $_GET['cdestino']); 
 } 
 
 $comensales = $mesas->c_mas_de_un_comensal($_GET['mesa']); //para saber si hay mas de uno      
    

        if($comensales > "1"){//si hay más de 1 comensal

            header("Location: comensales.php");



        }else{
            
            header("Location: mesas.php");
            
        }

  
  


?>
