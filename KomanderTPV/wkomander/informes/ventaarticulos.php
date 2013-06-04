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
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
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

         $fecha1 = $_GET['fecha1'];// "2012-01-01";
        $fecha2 = $_GET['fecha2'];//"2012-12-31";

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
                          <tr><td><input type="text" id="tFecha1" class="datepicker" value="<?php echo $fecha1; ?>"/></td></tr>
                          <tr><td> Fecha 2:</td></tr>
                          <tr><td><input type="text" id="tFecha2" class="datepicker" value="<?php echo $fecha2; ?>"/></td></tr>
                      </table>
                  </td>
                  <td><div id="bAlf" class="boton_izq" onclick="alf()">ALF</div></td>
                  <td><div id="bUds" class="boton_izq" onclick="uds()">UDS</div></td>
                  <td><div id="bPvp" class="boton_izq" onclick="pvp()">PVP</div></td>
                  <td><div id="bVolver" class="boton_izq" onclick="location.href='../admin.php'">VOLVER</div></td>
              </tr>            
              
              
              
              
              
          </table>
      
      
<?php
    
    $bd=Db::getInstance();
    $c = new conexion();


   if (isset($_GET['uds'])){
     $ssql = "SELECT articulos.uds_stock, historial_puntos_descr.idarticulo, historial_puntos_descr.articulo, SUM(historial_puntos_descr.cantidad) AS cantidad, 
           SUM(historial_puntos_descr.pvp) AS pvp FROM historial_puntos_descr INNER JOIN 
        historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
        INNER JOIN articulos ON historial_puntos_descr.idarticulo = articulos.id_articulo 
        WHERE historial_puntos.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
            historial_puntos.anulado = 'N' AND historial_puntos_descr.anulado = 'N'
            
        GROUP BY historial_puntos_descr.articulo ORDER BY SUM(historial_puntos_descr.cantidad) DESC";
   
   } else if (isset($_GET['pvp'])){  
          $ssql = "SELECT articulos.uds_stock, historial_puntos_descr.idarticulo, historial_puntos_descr.articulo, SUM(historial_puntos_descr.cantidad) AS cantidad, 
           SUM(historial_puntos_descr.pvp) AS pvp FROM historial_puntos_descr INNER JOIN 
        historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
         INNER JOIN articulos ON historial_puntos_descr.idarticulo = articulos.id_articulo 
        WHERE historial_puntos.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
            historial_puntos.anulado = 'N'  AND historial_puntos_descr.anulado = 'N'
        GROUP BY historial_puntos_descr.articulo ORDER BY SUM(historial_puntos_descr.pvp) DESC";  
   }else{
       $ssql = "SELECT articulos.uds_stock, historial_puntos_descr.idarticulo, historial_puntos_descr.articulo, SUM(historial_puntos_descr.cantidad) AS cantidad, 
           SUM(historial_puntos_descr.pvp) AS pvp FROM historial_puntos_descr INNER JOIN 
        historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
         INNER JOIN articulos ON historial_puntos_descr.idarticulo = articulos.id_articulo 
        WHERE historial_puntos.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
            historial_puntos.anulado = 'N'  AND historial_puntos_descr.anulado = 'N'
        GROUP BY historial_puntos_descr.articulo";
   }
    $rs = $bd->ejecutar($ssql);

    echo '<table id="tabla_info">';
     echo '<thead>
		<tr>
			<th scope="col">ARTICULO</th>
                        <th scope="col">STOCK</th>
                        <th scope="col">UDS VENDIDAS</th>
			<th scope="col">PVP</th>
			
		</tr>
	 </thead>';
     $suma = 0;

    if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
        
        while ( $a = $bd->obtener_fila($rs,0)){
            
          echo '<tr>
              <td>'.$a['articulo'].'</td>
              <td>'.preg_replace('/^(-?\d+).0+$/', '$1', $a['uds_stock']).'</td>
              <td>'.preg_replace('/^(\d+)\.0+$/', '$1',$c->knumber($a['cantidad'])).'</td>
              <td>'.$c->knumber($a['pvp']).'</td>
          </tr>  ';
          
          $suma = $suma + $a['pvp'];  
        }           
        
    
        
    }
    echo '<tr id="trTotal"><td colspan="3">TOTAL VENTA</td><td id="tdTotal" colspan="2">'.$c->knumber($suma).'</td>
        </tr>';
    echo '</table>';
   
?>
          
  </body>
</html>