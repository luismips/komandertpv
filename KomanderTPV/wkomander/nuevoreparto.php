<?php
include ("seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
include_once('clases/_i_historial.php');
     
 $bd=Db::getInstance();       
//comprueba si existe el telefono
$ssql = "SELECT * FROM clientes WHERE tlf='".$_GET["tlf"]."'";

$rs = $bd->ejecutar($ssql);



     if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
            //si existe, modifica direcci�n

         $updcli = "UPDATE clientes SET nombre = '".$_GET["nombre"]."', 
             direccion='".$_GET["direccion"]."', zona_mapa='".$_GET["zona_mapa"]."', observ='".$_GET["observ"]."'  
                 WHERE tlf = '".$_GET["tlf"]."'";

         $bd->actualizar($updcli);

        }else{//si no existe, inserta datos cliente

         $inscli = "INSERT INTO clientes (nombre, direccion, zona_mapa, tlf, observ) VALUES 
             ('".$_GET["nombre"]."', '".$_GET["direccion"]."',  '".$_GET["zona_mapa"]."',
               '".$_GET["tlf"]."', '".$_GET["observ"]."' )";


         $bd->ejecutar($inscli); 
      }

     //crea punto nuevo con tlf
  $ssql2 ="INSERT INTO puntos (nombre, zona, imagen, pos_x, pos_y, ocupada, 
    comensales, grupo_impresion, grupo_visor, observ, imagen_o) VALUES 
    ('".$_GET["tlf"]."', (SELECT id_zona FROM zonas WHERE tipo='REPARTO'),
        'no', 0, 0, 'N', 0, 0, (SELECT grupo_visor FROM zonas WHERE tipo='REPARTO'), 
        'n', 'n')";

 $bd->ejecutar($ssql2); 

  $hist = new _i_historial();
  $hist->ocupar_mesa($_GET["tlf"]);
  $hist->nuevo_historial($_GET["tlf"], "1");
  

  $hora = date("H:i");
    //Inserta linea con precio reparto en comanda
  $ssql3 = "INSERT INTO historial_puntos_descr (id_hist_punto, comensal, articulo,
       cantidad, pvp, usuario, hora, invitacion, enviado, anulado, llevar, mods) VALUES 
       ((SELECT id_hist FROM historial_puntos WHERE punto='".$_GET["tlf"]."' AND
           cobrada = 'N' AND anulado = 'N'), '1', 'REPARTO', 1,
               "._PRECIO_REPARTO_.",
                   '".$_SESSION["usuario"]."', '".$hora."', 'N', 'S', 'N','S' , '')";

   $bd->ejecutar($ssql3);
   
   $_SESSION["mesa"] = $_GET["tlf"];
   $_SESSION["comensal"] = "1";

   header("Location: comanda.php");
?>
