<?php


/**
 * Description of _check_mods
 *
 * @author luismips
 */
class _check_mods {
     
    public function procesa_mod($mod) {

        $bd=Db::getInstance(); 
        
	$ssql = "SELECT id_modificador, precio, nombre_".$_SESSION["lang"]." AS nombre FROM modificadores WHERE id_modificador = ".$mod;

        $stmt=$bd->ejecutar($ssql); 
        
        $id = "";
        $precio = 0;
        $mods = "";//$_SESSION["mods"];
        
          if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
               $id = $a["id_modificador"];
               $precio = (FLOAT)stripslashes($a['precio']);
               $mods = $a["nombre"];
            }      
        }
        
        if (stristr( $_SESSION["mods"], $mods)){
            $_SESSION["ids_mods"] = str_replace($id." ", "", $_SESSION["ids_mods"]);
            $_SESSION["mods"] = str_replace($mods." ", "", $_SESSION["mods"]);
            $_SESSION["precio_mods"] = (FLOAT)$_SESSION["precio_mods"] - $precio;
            
        } else {
            $_SESSION["ids_mods"] .= $id." ";
            $_SESSION["mods"] .= $mods." ";
            $_SESSION["precio_mods"] = (FLOAT)$_SESSION["precio_mods"] + $precio;
            
        }
        
        return $_SESSION["mods"];
    }
}

?>