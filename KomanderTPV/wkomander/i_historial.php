<?php

    session_start();
  

    require 'clases/includes.php';
    
    include_once('clases/_i_historial.php');
     
    $idarticulo = $_GET['idarticulo'];
    $articulo = $_GET['articulo'];
    $mesa = $_GET['mesa'];
    $comensal = str_replace("%20", " ", $_GET['comensal']);
    $usuario = $_GET['usuario'];
    
//    Comprueba si la mesa esta ocupada... si no, la inicia
    $hist = new _i_historial();

    if (!$hist->c_ocupado($mesa)){
        $hist->nuevo_historial($mesa, $comensal);
        $hist->ocupar_mesa($mesa);
    }
   
    if (isset($_GET['desdemods'])){//si viene desde la pantalla mods
//        $hist->i_hist_descr($mesa, $comensal, $articulo, $_SESSION["usuario"], $_SESSION["mods"], $_GET['uds'], $_SESSION["precio_mods"]);
            //comprobar si el ultimo articulo es igual, si lo es, suma cantidad, si no añade normal
                $id_hist = $hist->c_hist_descr($mesa, $comensal, $articulo, $_SESSION['mods']);
            if(!$id_hist==""){
        //        echo "existe, habria ke sumar 1";
                $hist->suma_uds_conmods($id_hist, $idarticulo, $_SESSION["precio_mods"], $_GET['uds']);
             }else{
        //        echo "no existe, habria ke añadirlo";
                 //Insertar hist_descr
                $hist->i_hist_descr($mesa, $comensal, $articulo, $usuario, $_GET["mods"], $_GET['uds'], $_SESSION["precio_mods"], $_SESSION["zona"], $idarticulo, $_SESSION["ids_mods"]);
            }
   if ($_SESSION["tipo"] != "cliente"){     
        header("Location: comanda.php?mesa=".$mesa."&comensal=".$comensal."&padre=".$_GET['padre']);
   }else{
       header("Location: cliente/comandacli.php?mesa=".$mesa."&comensal=".$comensal."&padre=".$_GET['padre']);
 
   }    
    } else {// si no viene desde mods
        //comprobar si lleva modificadores 
       if ($hist->c_mods($idarticulo)){//si los lleva, redirecciona a mods
               $_SESSION["ids_mods"] = "";
               $_SESSION["mods"] = "";//inicializa variable mods
               $_SESSION["precio_mods"] = (FLOAT)0.00;
               $_SESSION["articulo"] = $articulo;
               header("Location: mods.php?uds=1&articulo=".$articulo."&idarticulo=".$idarticulo."&mesa=".$mesa."&comensal=".$comensal."&padre=".$_GET['padre']."&usuario=".$usuario);
           }else{
               $_SESSION["ids_mods"] = "";
               $_SESSION["mods"] = "";//inicializa variable mods
               $_SESSION["precio_mods"] = (FLOAT)0.00;
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
            if ($_SESSION["tipo"] != "cliente"){     
                    header("Location: comanda.php?mesa=".$mesa."&comensal=".$comensal."&padre=".$_GET['padre']);
               }else{
                   header("Location: cliente/comandacli.php?mesa=".$mesa."&comensal=".$comensal."&padre=".$_GET['padre']);

               }       
                
       }
    } 
    
  
    
?>
