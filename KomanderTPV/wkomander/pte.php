<?php
//session_start();
//session_name("loginUsuario");
include ("seguridad.php");
require 'clases/includes.php';
include_once('clases/_pte.php');
include_once('clases/_mesas.php');
require_once("../pdf/dompdf/dompdf_config.inc.php");

$pt = new _pte();
$mesas = new _mesas();


 
if (isset($_GET['todo'])){
        $pt->i_cola($_SESSION['mesa']);
         header("Location: mesas.php");
}

else{
    
    $comensales = $mesas->c_mas_de_un_comensal($_SESSION['mesa']); //para saber si hay mas de uno      
    
    if($comensales == "1"){//si solo hay 1 comensal

        $pt->i_cola($_SESSION['mesa']);
        if(isset($_SESSION['zona'])){
            header("Location: mesas.php");
        }

    }else if($comensales > "1"){//si hay más de 1 comensal


            header("Location: comensales.php");



    }else{
        
        header("Location: mesas.php");
    }
}


?>


