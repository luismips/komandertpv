<?php
include ("seguridad.php");
require 'clases/includes.php';

?>
<html>

  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/movimientos.css" />
       
    <script type="text/javascript" src="js/jquery-1.7.1.js">
    </script>
  </head>
  
     <?php
 echo '<script type="text/javascript">
        


//       function movs(idcaja){
//            location.href="movimientos.php?idcaja="+idcaja;
//        }
       
</script>    '; 
 ?>
  
  <body>
      <div id="container_movimientos">
          
         
      
      
      
<?php

    include_once('clases/conexion.php');
    $c = new conexion();

    $bd=Db::getInstance();
  
    $ssql = "SELECT * FROM movimientos WHERE id_caja = ".$_GET["idcaja"]." ORDER BY id_mov DESC";

    $rs = $bd->ejecutar($ssql);

    echo '<table id="tabla_movs">';
     echo '<thead>
		<tr>
			<th scope="col">HIST</th>
			<th scope="col">HORA</th>
                        <th scope="col">MESA</th>
                        <th scope="col">COMENSAL</th>
			<th scope="col">COBRO</th>
                        <th scope="col">EFECTIVO</th>
			<th scope="col">TARJETA</th>
                        <th scope="col">ENTREGADO</th>
			<th scope="col">TOTAL</th>
		</tr>
	 </thead>';
    
    if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
        
        while ( $a = $bd->obtener_fila($rs,0)){
            
            $cobro = "";
            
            if ($a['tipo_cobro']== 'T'){
                $cobro = "TARJETA";
                
            }else if ($a['tipo_cobro']== 'E'){
                $cobro = "EFECTIVO";
            }else if ($a['tipo_cobro']== 'P'){
                $cobro = "PARCIAL";
            }
            
          echo '<tr id="movimiento" onclick="location.href=\'tiket_cerrado.php?idhist='.$a['id_hist'].'\'">
              <td>'.$a['id_hist'].'</td>
              <td>'.$a['hora_ini'].'</td>
              <td>'.$a['punto'].'</td>
              <td>'.$a['comensal'].'</td>
              <td>'.$cobro.'</td>
             <td>'.$c->knumber($a['cobro_efectivo']).'</td>
              <td>'.$c->knumber($a['cobro_tarjeta']).'</td>
              <td>'.$c->knumber($a['entregado']).'</td>
              <td>'.$c->knumber($a['total']).'</td>


          </tr>  ';
          
        }
        
    }

    echo '</table>';
   
?>          
           <div id="bVolver" class="boton_izq" onclick="location.href='cajas.php'">VOLVER</div>
        </div>
  </body>
</html>