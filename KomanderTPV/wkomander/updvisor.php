<?php
 session_start();
 session_name("loginUsuario");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
include_once('clases/_updvisor.php');

$upd = new _updvisor();


if ($_SESSION["modo"]=="normal" || $_SESSION["modo"]=="pte" || $_SESSION["modo"]=="servido"){ 
   if (isset($_GET["ver"])){
       if ($_GET["ver"]=="mas"){
          echo $upd->g_mas($_GET["visor"], $_GET["lastcola"]); 
       }else{
           echo $upd->g_menos($_GET["visor"], $_GET["lastcola"]);
       }
   }else{
       echo $upd->g_cola_normal($_GET["visor"], $_GET["lastcola"]);
   }
    
    
    
    
}else if ($_SESSION["modo"]=="articulos_pte_agrupados" || $_SESSION["modo"]=="articulos_pte_agrupados_mods"){
    echo $upd->g_pte_agrupados($_GET["visor"], $_SESSION["zona"]);
}




?> 
