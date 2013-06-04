<?php
session_start();
session_name("loginUsuario");
require 'clases/includes.php';
?>
<html>

  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/cajas.css" />
       
    <script type="text/javascript" src="js/jquery-1.7.1.js">
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
      <div id="bVolver" class="boton_izq" onclick="location.href='admin.php'">VOLVER</div>
          
      <div id="container_cajas">
          
        
      
      
      
<?php

    include_once('clases/conexion.php');
    $c = new conexion();

    $bd=Db::getInstance(); 
    
    $ssql = "SELECT * FROM caja WHERE abierta = 'N' ORDER BY id_caja DESC"; // LIMIT 30";

    $rs = $bd->ejecutar($ssql);

    echo '<table id="tabla_cajas">';
     echo '<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">FECHA</th>
			<th scope="col">HORA</th>
                        <th scope="col">PROPINA</th>
                        <th scope="col">DESC.</th>
                        <th scope="col">SUBTOTAL</th>
                        <th scope="col">EFECTIVO</th>
			<th scope="col">TARJETA</th>
			<th scope="col">TOTAL</th>
		</tr>
	 </thead>';
    
    if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
        
        while ( $a = $bd->obtener_fila($rs,0)){
            
            $propina = 0.00;
            $desc = 0.00;
            
            $ssql2 = "SELECT propina, descuento FROM movimientos WHERE id_caja = ".$a["id_caja"];
            $rs2 = $bd->ejecutar($ssql2);
          if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {  
            while ( $b = $bd->obtener_fila($rs2,0)){
                $propina += $b["propina"];
                $desc += $b["descuento"];
            }
            
          }
           
           $total_contado = $a['total_contado'];
           $total_visa = $a['total_visa'];
            
           $subtotal =  ($total_contado+$total_visa)-$propina;
           $total = $total_contado + $total_visa;
           
          echo '<tr id="fila_caja" onclick=movs('.$a['id_caja'].')>
              <td>'.$a['id_caja'].'</td>
              <td>'.$a['fecha_ini'].'</td>
              <td>'.$a['hora_ini'].'</td>
              <td>'.$c->knumber($propina).'</td>
                  <td>'.$c->knumber($desc).'</td>
              <td>'.$c->knumber($subtotal).'</td>
              <td>'.$c->knumber($a['total_contado']).'</td>
                  <td>'.$c->knumber($a['total_visa']).'</td>
              <td>'.$c->knumber($total).'</td>
          </tr> ';
          
        }        
    }

    echo '</table>';
        
?>
     </div>
          
  </body>
</html>