<?php
session_start();
session_name("loginUsuario");

include_once('clases/_trasp.php');
include_once('clases/_mesas.php');
require 'clases/includes.php';

$mesas = new _mesas(); 


$comensales = $mesas->c_mas_de_un_comensal($_SESSION['mesa']); //para saber si hay mas de uno      
    
    if($comensales == "1"){//si solo hay 1 comensal

       
       
            header("Location: comanda.php");
       

    }else if($comensales > "1"){//si hay más de 1 comensal


            header("Location: comensales.php");



    }

?>
