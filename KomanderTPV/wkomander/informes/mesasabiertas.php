<?php
session_start();
session_name("loginUsuario");
if ($_SESSION["nivel"] != "administrador") {
    header("Location: ../usuarios.php");
}
include_once('../clases/conexion.php');
require '../clases/includes.php';
?>
<html>

  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="../styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/mesasabiertas.css" />
       
    
    </script>
  </head>
  
     <?php
 echo '<script type="text/javascript">
        


       function movs(idcaja){
            location.href="movimientos.php?idcaja="+idcaja;
        }
       
</script>    '; 
 ?>
  
  <body>
      <div id="container">       
      
      
      
<?php

    
    $c = new conexion();

    $bd=Db::getInstance(); 
    
    $ssql = "SELECT SUM(historial_puntos_descr.pvp) AS pvp, historial_puntos.hora_apertura, historial_puntos.punto, 
        historial_puntos.comensal, historial_puntos.propina, historial_puntos.descuento FROM historial_puntos_descr INNER JOIN 
        historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
        WHERE historial_puntos.cobrada = 'N' AND historial_puntos.anulado = 'N' 
        GROUP BY historial_puntos.id_hist";

    $rs = $bd->ejecutar($ssql);

    echo '<table id="tabla_info">';
     echo '<thead>
		<tr>
			<th scope="col">HORA</th>
                        <th scope="col">MESA</th>
			<th scope="col">COMENSAL</th>
			<th scope="col">SUMA</th>
                        <th scope="col">PROPINA</th>
                        <th scope="col">DESCUENTO</th>
                        <th scope="col">TOTAL</th>
		</tr>
	 </thead>';
     $suma = 0.00;
           $total = 0.00;
           $suma_propina = 0.00;
           $suma_descuento = 0.00;
           $propina = 0.00;
           $descuento = 0.00;
     
    if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
        
        while ( $a = $bd->obtener_fila($rs,0)){
            
          echo '<tr onclick="location.href=\'../comanda.php?mesa='.$a['punto'].'&comensal='.$a['comensal'].'&padre=0\'">
              <td>'.$a['hora_apertura'].'</td>
              <td>'.$a['punto'].'</td>
              <td>'.$a['comensal'].'</td>
              <td id="tsuma">'.$c->knumber($a['pvp']).'</td>
              <td>'.$c->knumber(($a['pvp']*$a['propina'])/100).'</td>
              <td>'.$c->knumber(($a['pvp']*$a['descuento'])/100).'</td>
              <td>'.$c->knumber($a['pvp']+ (($a['pvp']*$a['propina'])/100)-(($a['pvp']*$a['descuento'])/100)).'</td>
          </tr>  ';
          
          $suma = $suma + $a['pvp'];  
          $suma_propina = $suma_propina + ($a['pvp']*$a['propina'])/100;
          $suma_descuento = $suma_descuento + ($a['pvp']*$a['descuento'])/100;
          $total = $suma + ($a['pvp']*$a['propina'])/100 - ($a['pvp']*$a['descuento'])/100;
        }           
            
        
    }
    echo '<tr id="trTotal"><td colspan="2">SUMA</td><td id="tdTotal" colspan="2">'.$c->knumber($suma).'</td>
        <td>'.$c->knumber($suma_propina).'</td><td>'.$c->knumber($suma_descuento).'</td><td>'.$c->knumber($total).'</td></tr>';
    echo '</table>';
    
?>
            <div id="bVolver" class="boton_izq" onclick="location.href='../admin.php'">VOLVER</div>
          </div>
  </body>
</html>
