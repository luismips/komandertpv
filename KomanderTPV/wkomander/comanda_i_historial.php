<?php
session_start();
if ($_SESSION["tipo"]!="cliente"){
    session_name("loginUsuario");
}else{
     session_name("cliente");
}

require 'clases/includes.php';

include_once('clases/_i_historial.php');

$idarticulo = $_POST['idarticulo'];
$articulo = $_POST['articulo'];
$mesa = $_SESSION['mesa'];
$comensal = $_SESSION['comensal'];
$usuario = $_SESSION['usuario'];
    
    
    
//    Comprueba si la mesa esta ocupada... si no, la inicia
    $hist = new _i_historial();

    if (!$hist->c_ocupado($mesa)){
        $hist->nuevo_historial($mesa, $comensal);
        $hist->ocupar_mesa($mesa);
    }
   
    if (isset($_POST['desdemods'])){//si viene desde la pantalla mods

            //comprobar si el ultimo articulo es igual, si lo es, suma cantidad, si no añade normal
            $_SESSION['uds'] = $_POST['uds'];
        
            $id_hist = $hist->c_hist_descr($mesa, $comensal, $_SESSION['articulo'], $_SESSION['mods']);
            if(!$id_hist==""){
                //        echo "existe, habria ke sumar 1";
                $hist->suma_uds_conmods($id_hist, $_SESSION['idarticulo'], $_SESSION["precio_mods"], $_SESSION['uds']);
             }else{
                 //        echo "no existe, habria ke añadirlo";
                 //Insertar hist_descr
                $hist->i_hist_descr($mesa, $comensal, $_SESSION['articulo'], $usuario, $_SESSION["mods"], $_SESSION['uds'], $_SESSION["precio_mods"], $_SESSION["zona"], $_SESSION['idarticulo'], $_SESSION["ids_mods"]);
            }
   
    } else {// si no viene desde mods
               $_SESSION["ids_mods"] = "";
               $_SESSION["mods"] = "";//inicializa variable mods
               $_SESSION["precio_mods"] = (FLOAT)0.00;
               $_SESSION["articulo"] = $articulo;
                //comprobar si el ultimo articulo es igual, si lo es, suma cantidad, si no añade normal
                $id_hist = $hist->c_hist_descr($mesa, $comensal, $articulo, $_SESSION['mods']);
                
                if(!$id_hist==""){
                    //        echo "existe, habria ke sumar 1";
                    $hist->suma_uno($id_hist, $idarticulo);
                 }else{
                    //        echo "no existe, habria ke añadirlo";
                     //Insertar hist_descr
                    $hist->i_hist_descr($mesa, $comensal, $articulo, $usuario, "", "1", "0", $_SESSION["zona"], $idarticulo, "");
                }
   
                
//       }
    }
    
   
    
//    echo $mesa. $comensal. $articulo. $usuario. $_SESSION["mods"]. $_SESSION['uds']. $_SESSION["precio_mods"]. $_SESSION["zona"]. $idarticulo. $_SESSION["ids_mods"];
    
  
    
?>
