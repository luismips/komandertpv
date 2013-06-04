<?php
  session_start();
  session_name("cliente");
require '../clases/includes.php';

$bd=Db::getInstance(); 

$ssql = "SELECT * FROM cliente_mesa INNER JOIN puntos ON 
    cliente_mesa.id_mesa = puntos.id_punto WHERE cliente_mesa.pass = '".$_POST['contrasena']."'";

$rs = $bd->ejecutar($ssql);
if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    while ( $a = $bd->obtener_fila($rs,0)){

        $_SESSION["pass"] = $a["pass"];
        $_SESSION["idmesa"] = $a["id_mesa"];
        $_SESSION["mesa"] = $a["nombre"];
        $_SESSION["comensal"] = $a["comensal"];
        $_SESSION["cliente_autent"] = "S";
        $_SESSION["padre"] = 0;

    }
     
        
//         $dec = "SELECT valor FROM vars WHERE variable = 'decimales'";
//    $rs2 = $bd->ejecutar($dec);
//    if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
//        while ( $imp = $bd->obtener_fila($rs2,0)){
//            $_SESSION["decimales"] = $imp["valor"];
//        }
//   
//    }
    
           $dec = "SELECT valor FROM vars WHERE variable = 'idioma'";
    $rs2 = $bd->ejecutar($dec);
    if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
        while ( $imp = $bd->obtener_fila($rs2,0)){
            $_SESSION["idioma_local"] = $imp["valor"];
        }
     
    }
    
       //Para el uso de impresoras para ver la cola
    $impresion = "SELECT valor FROM vars WHERE variable = 'impresoras'";
    $rs2 = $bd->ejecutar($impresion);
    if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
        while ( $imp = $bd->obtener_fila($rs2,0)){
            $_SESSION["impresion"] = $imp["valor"];
        }
       
    }
    
      //Para el tipo de moneda
//    $dec = "SELECT valor FROM vars WHERE variable = 'moneda'";
//    $rs2 = $bd->ejecutar($dec);
//    if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
//        while ( $imp = $bd->obtener_fila($rs2,0)){
//            $_SESSION["moneda"] = $imp["valor"];
//        }
//        
//    }
    
    
    $_SESSION["tipo"] = "cliente";
    $_SESSION["usuario"] = "Cliente";
         
        header("Location: comandacli.php?mesa=".$_SESSION["mesa"]."&comensal=".$_SESSION["comensal"]."&padre=0");
    }else {
        
       header("Location: index.php?errorusuario=si");
    }
?> 