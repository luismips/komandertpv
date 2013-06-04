<?php
include ("seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
include_once('clases/_cobro.php');
include_once('clases/_mesas.php');


$mesas = new _mesas(); 

$cob = new _cobro();

if (isset($_GET['todo'])){
    $cob->cobrar_todo($_SESSION['mesa'], "0", $_GET['tipo'], $_GET['total'], $_GET['entregado'], $_GET['efectivo'], $_GET['tarjeta'], $_SESSION["zona"]);

}else{
    $cob->cobrar($_SESSION['mesa'], $_SESSION['comensal'], $_GET['tipo'], $_GET['total'], $_GET['entregado'], $_GET['efectivo'], $_GET['tarjeta'], $_SESSION["zona"]);
}

//------------------------------------------------------
//DESCOMENTAR PARA ABRIR CAJON--------------------------
//$cmd ="type c:\apertura.txt > lpt1";
//exec($cmd);
//------------------------------------------------------

//if (isset($_GET['todo'])){
//    
//    header ("Location: mesas.php");  
//  
//}else{
//    
//  $comensales = $mesas->c_mas_de_un_comensal($_SESSION['mesa']); //para saber si hay mas de uno      
//    
//    if($comensales == "1"){//si solo hay 1 comensal
//
//       
//       
//            header("Location: comanda.php");
//       
//
//    }else if($comensales > "1"){//si hay más de 1 comensal
//
//
//            header("Location: comensales.php");
//
//
//
//    }else{
         header("Location: mesas.php");
//    }
 
//}

?>
