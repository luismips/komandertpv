<?php
session_start();
session_name("loginUsuario");
if ($_SESSION["nivel"] != "administrador") {
    header("Location: ../usuarios.php");
}
require '../clases/includes.php';
include_once('../clases/conexion.php');
?>
<html>

  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="../styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/ventaarticulos.css" />
       
    <script type="text/javascript" src="../js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="../styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
    	<script type="text/javascript">
                $(function(){


                        // Datepicker
                        $('.datepicker').datepicker({
                                inline: true,
                                dateFormat: "yy-mm-dd"
                        });



                });
        </script>
  </head>
  
     <?php
 echo '<script type="text/javascript">
        
        function ver(){
          if ((document.getElementById("tFecha1").value !="") && (document.getElementById("tFecha2").value !="")){
            location.href="stock.php?fecha1="+document.getElementById("tFecha1").value+"&fecha2="+document.getElementById("tFecha2").value;
          }else{
            location.href="stock.php";
          }
          
            
        }

       function alf(){
          if ((document.getElementById("tFecha1").value !="") && (document.getElementById("tFecha2").value !="")){
            location.href="ventaarticulos.php?fecha1="+document.getElementById("tFecha1").value+"&fecha2="+document.getElementById("tFecha2").value;
          }else{
            location.href="ventaarticulos.php";
          }
          
            
        }
        
        function uds(){
          if ((document.getElementById("tFecha1").value !="") && (document.getElementById("tFecha2").value !="")){
            location.href="ventaarticulos.php?uds=S&fecha1="+document.getElementById("tFecha1").value+"&fecha2="+document.getElementById("tFecha2").value;
          }else{
            location.href="ventaarticulos.php?uds=S";
          }
          
            
        }
        
        function pvp(){
          if ((document.getElementById("tFecha1").value !="") && (document.getElementById("tFecha2").value !="")){
            location.href="ventaarticulos.php?pvp=S&fecha1="+document.getElementById("tFecha1").value+"&fecha2="+document.getElementById("tFecha2").value;
          }else{
            location.href="ventaarticulos.php?pvp=S";
          }
          
            
        }
       
</script>    '; 
 
 $fecha1 = "";
     $fecha2 = "";
    
     if (isset($_GET['fecha1']) && isset($_GET['fecha2'])){

         $fecha1 = $_GET['fecha1'];
        $fecha2 = $_GET['fecha2'];

     }else{
         $fecha1 = date("Y-n-j", strtotime('-1 day'));
         
         $fecha2 = date("Y-n-j");

     }
 ?>
  
  <body>
      <div id="page-wrap">       
      
          <table id="tabla_bot">
              <tr>
                  <td>
                      <table>
                          <tr><td> Fecha 1:</td></tr>
                          <tr><td><input type="text" id="tFecha1" class="datepicker" value="<?php echo $fecha1; ?>" onchange="ver()"/></td></tr>
                          <tr><td> Fecha 2:</td></tr>
                          <tr><td><input type="text" id="tFecha2" class="datepicker" value="<?php echo $fecha2; ?>" onchange="ver()"/></td></tr>
                      </table>
                  </td>
<!--                  <td><div id="bAlf" class="boton_izq" onclick="alf()">ALF</div></td>
                  <td><div id="bUds" class="boton_izq" onclick="uds()">UDS</div></td>
                  <td><div id="bPvp" class="boton_izq" onclick="pvp()">PVP</div></td>-->
                  <td><div id="bVolver" class="boton_izq" onclick="location.href='../admin.php'">VOLVER</div></td>
              </tr>            
              
              
              
              
              
          </table>
      
      
<?php

    $bd=Db::getInstance();
    $c = new conexion();

    $ssql = "SELECT id_articulo, nombre, uds_stock FROM articulos ORDER BY id_familia, nombre ASC";
    
    $rs = $bd->ejecutar($ssql);
    
     echo '<table id="tabla_info">';
     echo '<thead>
		<tr>
			<th scope="col">ARTICULO</th>
                        <th scope="col">COMPRAS</th>
                        <th scope="col">UDS VENDIDAS</th>
                        <th scope="col">STOCK</th>
                        
			
			
		</tr>
	 </thead>';
    
    if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
        
        while ( $a = $bd->obtener_fila($rs,0)){
            
            $uds_vendidas = 0;
            $uds_compradas = 0;
            
            $ssql2 = "SELECT cantidad FROM historial_puntos_descr INNER JOIN 
                historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
                WHERE historial_puntos_descr.idarticulo = ".$a['id_articulo']." AND historial_puntos.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
                    historial_puntos.anulado = 'N' AND historial_puntos_descr.anulado = 'N'";
             $rs2 = $bd->ejecutar($ssql2);
              if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
        
                    while ( $b = $bd->obtener_fila($rs2,0)){
                        $uds_vendidas += $b['cantidad'];
                    }
                       
              }
              
               $ssql3 = "SELECT uds FROM hist_stock 
                WHERE hist_stock.idart = ".$a['id_articulo']." AND hist_stock.fecha BETWEEN '".$fecha1."' AND '".$fecha2."'";
             $rs3 = $bd->ejecutar($ssql3);
              if ( $rs3 !== false && mysql_num_rows($rs3) > 0 ) {
        
                    while ( $d = $bd->obtener_fila($rs3,0)){
                        $uds_compradas += $d['uds'];
                    }
                     
              }
             
              echo '<tr>
                  <td>'.$a['nombre'].'</td>
                  <td>'.preg_replace('/^(\d+)\.0+$/', '$1', $uds_compradas).'</td>
                   <td>'.preg_replace('/^(\d+)\.0+$/', '$1', $uds_vendidas).'</td>
                    <td>'.preg_replace('/^(-?\d+).0+$/', '$1', $a['uds_stock']).'</td>
                 
                  

              </tr>  ';
          

        }           
   }
    
?>
          
  </body>
</html>