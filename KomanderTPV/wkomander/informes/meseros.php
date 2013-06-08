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
    <link rel="stylesheet" type="text/css" href="styles/meseros.css" />
       
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
              if ((document.getElementById("tFecha1").value !="") && (document.getElementById("tFecha2").value !="")) {
                location.href="meseros.php?fecha1="+document.getElementById("tFecha1").value+"&fecha2="+document.getElementById("tFecha2").value;
              }else{
                location.href="meseros.php";
              }
        }

       function venta(){
          if (document.getElementById("tFecha1").value !="") {
            location.href="meseros.php?fecha1="+document.getElementById("tFecha1").value;
          }else{
            location.href="meseros.php";
          }
          
            
        }
        
        function nummesas(){
          if (document.getElementById("tFecha1").value !=""){
            location.href="meseros.php?mesas=S&fecha1="+document.getElementById("tFecha1").value;
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
     $fecha1 = date("Y-n-j");//, strtotime('-1 day'));

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
                  <td><div id="bVolver" class="boton_izq" onclick="location.href='../admin.php'">VOLVER</div></td>
              </tr>            
         </table>
      
      
<?php

    $bd=Db::getInstance(); 
    $c = new conexion();
    
    $cajas = [];
    
    $mesas = [];//mesa[usuario] contara el numero de mesas atendidas
    $atenciones = [];//par el numero de anotaciones (atenciones)
    $propina = [];//propina ke le corresponde
    $subtotal = []; //suma del pvp por usuario

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

 //Obtener caja cuyo campo fecha_ini esten entre las 2 fechas
 $ssql = "SELECT id_caja FROM caja WHERE fecha_ini BETWEEN 
     '".$fecha1."' AND '".$fecha2."' 
         ORDER BY id_caja ASC";
 $rs = $bd->ejecutar($ssql);
 
 if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    while ( $a = $bd->obtener_fila($rs,0)){
       
       array_push($cajas, $a["id_caja"]); 
    }
 }else{
     echo "No se hizo caja en la fecha seleccionada";
 }
 
 //MOSTRAR CAJAS INVOLUCRADAS-----------------------------
 echo '<p id="cajas">'; 
 if (sizeof($cajas)>0){
        if (sizeof($cajas)>1){
             echo "CAJAS: ";
        }else{
             echo "CAJA: ";
        }
        
        foreach($cajas as $clave => $valor){
             echo $valor." ";
        }
 }
 echo '</p>';
//--------------------------------------------------------
 if (sizeof($cajas)>0){  
    //Obtener los historiales incluidos en cada caja
    $ssql2 = "SELECT historial_puntos.id_hist, historial_puntos.propina,
        historial_puntos.descuento, historial_puntos.usuario FROM historial_puntos 
            INNER JOIN movimientos ON historial_puntos.id_hist = movimientos.id_hist  
            WHERE movimientos.id_caja BETWEEN ".$cajas[0]." AND ".$cajas[sizeof($cajas)-1];


     $rs2 = $bd->ejecutar($ssql2);


     if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
        while ( $b = $bd->obtener_fila($rs2,0)){

            if (isset($mesas[$b["usuario"]])){
                $mesas[$b["usuario"]] += 1;
            }else{
                $mesas[$b["usuario"]] = 1;
            }            

            $ssql3 = " SELECT pvp, usuario FROM historial_puntos_descr 
                WHERE id_hist_punto = ".$b["id_hist"];//!!!!!!AÑADIR ANULADO = N
             $rs3 = $bd->ejecutar($ssql3);

             if ( $rs3 !== false && mysql_num_rows($rs3) > 0 ) {
                while ( $c = $bd->obtener_fila($rs3,0)){

                    if (isset($atenciones[$c["usuario"]])){
                        $atenciones[$c["usuario"]] += 1;
                    }else{
                        $atenciones[$c["usuario"]] = 1;
                    }

                    if (isset($subtotal[$c["usuario"]])){
                        $subtotal[$c["usuario"]] += $c["pvp"];
                    }else{
                        $subtotal[$c["usuario"]] = $c["pvp"];
                    }

                    $prop = ($c["pvp"] * $b["propina"])/100;

                    if(isset($propina[$c["usuario"]])){
                        $propina[$c["usuario"]] += $prop;
                    }else{
                        $propina[$c["usuario"]] = $prop;
                    }

                }
            }   
        }
     }

     $supersub = 0;//para los totales en el pie de la tabla
     $supertotal = 0;
     $superpropina = 0;
    
     foreach($atenciones as $user => $x){
                $m = 0;
                
                if (isset($mesas[$user])){
                    $m = $mesas[$user];
                }
         
                if (_DECIMALES_ == "S"){
                    $sub = number_format($subtotal[$user], 2,'.',',');
                    $pro = number_format($propina[$user], 2,'.',',');
                    $total = number_format($sub + $pro, 2,'.',',');
                    
                }else{
                    $sub = round($subtotal[$user], 0, PHP_ROUND_HALF_UP);
                    $pro = round($propina[$user], 0, PHP_ROUND_HALF_UP);
                    $total = $sub + $pro;
                    
                }
                
                $supersub += $sub;
                $supertotal += $total;
                $superpropina += $pro;

                
                echo '<tr>
                  <td>'.$user.'</td>
                  <td>'.$m.'</td>
                  <td>'.$atenciones[$user].'</td>
                  <td>'.$sub.'</td>
                  <td>'.$pro.'</td>
                  <td>'.$total.'</td>
              </tr>  '; 


     }
 }
//$supersub = (_DECIMALES_ == "S")?number_format($sub, 2,'.',','):round($sub, 0, PHP_ROUND_HALF_UP);
                
 echo '<tr>
      <td colspan="3">TOTALES</td>
      <td>'.$supersub.'</td>
      <td>'.$superpropina.'</td>
      <td>'.$supertotal.'</td>
  </tr>  '; 
 
 
 
  echo '</table>';
?>
          
  </body>
</html>