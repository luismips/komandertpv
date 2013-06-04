<?php
 session_start();
 session_name("loginUsuario");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
include 'lang/'.$_SESSION["lang"].'.php';
$bd=Db::getInstance(); 

$zona = "";

$ssql="UPDATE cola SET servido=IF(servido='N','S','N') WHERE id_cola=".$_GET["idcola"];

$bd->actualizar($ssql);

//comprueba si todo el pedido esta listo
$check = "SELECT cola.id_cola FROM cola 
    INNER JOIN historial_puntos_descr ON historial_puntos_descr.id_hist_descr = cola.id_hist_descr 
    INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
    WHERE historial_puntos.id_hist = 
    (SELECT id_hist FROM historial_puntos INNER JOIN historial_puntos_descr ON 
    historial_puntos.id_hist = historial_puntos_descr.id_hist_punto 
    INNER JOIN cola ON historial_puntos_descr.id_hist_descr = cola.id_hist_descr 
    WHERE cola.id_cola = ".$_GET["idcola"].") AND cola.servido = 'N' AND 
        cola.anulado = 'N'";

$rs = $bd->ejecutar($check);

if ( $rs !== false && mysql_num_rows($rs) > 0 ) {    
           
    echo 'NO';
}
else{
    
    $getzona = "SELECT zonas.nombre FROM zonas INNER JOIN puntos ON 
        zonas.id_zona = puntos.zona 
               WHERE puntos.nombre = (SELECT mesa FROM cola WHERE id_cola = ".$_GET["idcola"].")";
        
     $rs2 = $bd->ejecutar($getzona);
     
    if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
       while ( $b = $bd->obtener_fila($rs2,0)){
               
              $zona = $b["nombre"];
            }
    
       
    
      }
    
    if ($_SESSION["tipo_zona"]=="LLEVAR"){
        echo "<p>PEDIDO RECOGER EN LOCAL LISTO</p>";
        
            $pedido = "SELECT * FROM historial_puntos INNER JOIN historial_puntos_descr ON 
        historial_puntos.id_hist = historial_puntos_descr.id_hist_punto 
        INNER JOIN cola ON historial_puntos_descr.id_hist_descr = cola.id_hist_descr 
        WHERE cola.id_cola = ".$_GET["idcola"];

        $rs = $bd->ejecutar($pedido);
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
        while ( $a = $bd->obtener_fila($rs,0)){

                echo "<p>".TIKET.": ".$a["id_hist"]."</p>";
                echo "<p>".NOMBRE.": ".$a["punto"]."</p>";
                echo '<a href="tiket.php?mesa='.$a["punto"].'&comensal='.$a["comensal"].'"><div style="color: #000; background: #aaffaa; width:200px; height:90px; margin: auto; border: 1px solid #55FF55;">'.TIKET.'</div></a>';
                $upd = "UPDATE puntos SET ocupada = 'N' WHERE nombre = '".$a["punto"]."'";
                $bd->actualizar($upd);
                }
        }
    }else if ($_SESSION["tipo_zona"]=="REPARTO"){
        echo "<p>".REPARTO."</p>";
        
            $pedido = "SELECT * FROM historial_puntos INNER JOIN historial_puntos_descr ON 
        historial_puntos.id_hist = historial_puntos_descr.id_hist_punto 
        INNER JOIN cola ON historial_puntos_descr.id_hist_descr = cola.id_hist_descr 
        INNER JOIN clientes ON cola.mesa = clientes.tlf
        WHERE cola.id_cola = ".$_GET["idcola"];

        $rs = $bd->ejecutar($pedido);
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
        while ( $a = $bd->obtener_fila($rs,0)){

                echo "<p>".TIKET.": ".$a["id_hist"]."</p>";
                echo "<p>REF.: ".$a["punto"]."</p>";
                
                echo "<p>".DIRECCION.":\r".$a["direccion"]."</p>";
                echo "<p>".ZONA.": ".$a["zona_mapa"]."</p>";
                echo '<a href="tiket.php?mesa='.$a["punto"].'&comensal='.$a["comensal"].'"><div style="color: #000; background: #aaffaa; width:200px; height:90px; margin: auto; border: 1px solid #55FF55;">'.TIKET.'</div></a>';
                $upd = "UPDATE puntos SET ocupada = 'N' WHERE nombre = '".$a["punto"]."'";
                $bd->actualizar($upd);
                }
               
                
        }
        
        
    }else{
        echo "NO";
    }
    
    
}

?> 
