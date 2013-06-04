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
        


       function venta(){
          if ((document.getElementById("tFecha1").value !="") && (document.getElementById("tFecha2").value !="")){
            location.href="meseros.php?fecha1="+document.getElementById("tFecha1").value+"&fecha2="+document.getElementById("tFecha2").value;
          }else{
            location.href="meseros.php";
          }
          
            
        }
        
        function nummesas(){
          if ((document.getElementById("tFecha1").value !="") && (document.getElementById("tFecha2").value !="")){
            location.href="meseros.php?mesas=S&fecha1="+document.getElementById("tFecha1").value+"&fecha2="+document.getElementById("tFecha2").value;
          }else{
            location.href="meseros.php?uds=S";
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
                  <td><div id="bVenta" class="boton_izq" onclick="venta()">VENTA</div></td>
                  <td><div id="bNumMesas" class="boton_izq" onclick="nummesas()">NUM MESAS</div></td>
                  
                  <td><div id="bVolver" class="boton_izq" onclick="location.href='../admin.php'">VOLVER</div></td>
              </tr>            
              
              
              
              
              
          </table>
      
      
<?php

    $bd=Db::getInstance(); 
    $c = new conexion();

    echo '<table id="tabla_info">';
    echo '<thead>
		<tr>
			<th scope="col">MESERO</th>
                        <th scope="col">MESAS</th>
                        <th scope="col">ATEN.</th>
			<th scope="col">SUBTOT</th>
                        <th scope="col">PROPINA</th>
                        <th scope="col">TOTAL</th>
                        
			
		</tr>
	 </thead>';
     
    
    
    $ssql = "SELECT nick FROM usuarios ORDER BY nick ASC";
    $rs = $bd->ejecutar($ssql);
     
    if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
        while ( $a = $bd->obtener_fila($rs,0)){
            $num_mesas = 0;
            $num_aten = 0;
            $avg_propina= 0;
            $avg_desc= 0;
            $propina = 0;
            $desc = 0;
            $suma = 0.00;
            $total = 0.00;
            
            $ssql2 = "SELECT id_hist, propina, descuento FROM historial_puntos WHERE 
                usuario = '".$a["nick"]."' AND
                 fecha BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
                 anulado = 'N'";
            $rs2 = $bd->ejecutar($ssql2);
            
            if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
                while ( $b = $bd->obtener_fila($rs2,0)){
                    $avg_propina= $b["propina"];
                    $avg_desc= $b["descuento"];
                    
                    $ssql3 = "SELECT pvp FROM historial_puntos_descr WHERE 
                        usuario = '".$a["nick"]."' AND id_hist_punto = ".$b["id_hist"]." 
                          AND 
                         anulado = 'N'";
                     $rs3 = $bd->ejecutar($ssql3);
                     
                     if ( $rs3 !== false && mysql_num_rows($rs3) > 0 ) {
                        while ( $d = $bd->obtener_fila($rs3,0)){
                          
                            $propina += ($d["pvp"]*$avg_propina)/100;
//                            $desc += ($d["pvp"]*$avg_desc)/100;
                            
                            $suma += $d["pvp"];
                            
                            $total = $suma + $propina;
                            
                            $num_aten++;
                        }
                       
                     }
                    
                    
                    $num_mesas++;
                }
           
            }
            
            echo '<tr>
              <td>'.$a['nick'].'</td>
              <td>'.$num_mesas.'</td>
              <td>'.$num_aten.'</td>
              <td>'.$c->knumber($suma).'</td>
              <td>'.$c->knumber($propina).'</td>
              <td>'.$c->knumber($total).'</td>
          </tr>  ';             
            
            
        }
    }
 
?>
          
  </body>
</html>