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
        
        function ver(){
              if ((document.getElementById("tFecha1").value !="") && (document.getElementById("tFecha2").value !="")){
                location.href="ventaarticulos.php?fecha1="+document.getElementById("tFecha1").value+"&fecha2="+document.getElementById("tFecha2").value;
              }else{
                location.href="ventaarticulos.php";
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
                          <tr><td><input type="text" id="tFecha1" class="datepicker" value="<?php echo $fecha1; ?>" onchange="ver()"/></td></tr>
                          <tr><td> Fecha 2:</td></tr>
                          <tr><td><input type="text" id="tFecha2" class="datepicker" value="<?php echo $fecha2; ?>" onchange="ver()"/></td></tr>
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
    
    $comienzo_html = '<table id="tabla_info">
                         <thead>
                            <tr>
                                    <th scope="col">ARTICULO</th>
                                    <th scope="col">STOCK</th>
                                    <th scope="col">UDS VENDIDAS</th>
                                    <th scope="col">PVP</th>

                            </tr>
                         </thead>';
    
    $suma = 0;
    
    $articulo = [];
    $cantidad =[];
    $pvp = [];
  


     if (isset($_GET['uds'])){
        $ssql= "SELECT  historial_puntos_descr.idarticulo,
                  historial_puntos_descr.articulo,
                  historial_puntos_descr.cantidad,
                  historial_puntos_descr.pvp                  
        FROM historial_puntos_descr INNER JOIN 
        historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
        WHERE historial_puntos.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
            historial_puntos.anulado = 'N' AND historial_puntos_descr.anulado = 'N' 
            ORDER BY historial_puntos_descr.cantidad DESC
        ";
   } else if (isset($_GET['pvp'])){  
            $ssql= "SELECT  historial_puntos_descr.idarticulo,
                  historial_puntos_descr.articulo,
                  historial_puntos_descr.cantidad,
                  historial_puntos_descr.pvp                  
        FROM historial_puntos_descr INNER JOIN 
        historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
        WHERE historial_puntos.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
            historial_puntos.anulado = 'N' AND historial_puntos_descr.anulado = 'N' 
            ORDER BY historial_puntos_descr.pvp DESC  
        ";
   }else{
       
       
         $ssql= "SELECT  historial_puntos_descr.idarticulo,
                  historial_puntos_descr.articulo,
                  historial_puntos_descr.cantidad,
                  historial_puntos_descr.pvp                  
        FROM historial_puntos_descr INNER JOIN 
        historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
        WHERE historial_puntos.fecha BETWEEN '".$fecha1."' AND '".$fecha2."' AND 
            historial_puntos.anulado = 'N' AND historial_puntos_descr.anulado = 'N' 
            ORDER BY historial_puntos_descr.articulo ASC
        ";
   }
   
   $rs = $bd->ejecutar($ssql);
        
   if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
        
        while ( $a = $bd->obtener_fila($rs,0)){

            $articulo[$a["idarticulo"]] = $a["articulo"];
            if (isset($cantidad[$a["idarticulo"]])){
                $cantidad[$a["idarticulo"]] += $a["cantidad"];
            }else{
                $cantidad[$a["idarticulo"]] = $a["cantidad"];
            }
            
            if (isset($pvp[$a["idarticulo"]])){
                 $pvp[$a["idarticulo"]] += $a["pvp"];
            }else{
                 $pvp[$a["idarticulo"]] = $a["pvp"];
            }
        }
     }
   
     echo $comienzo_html;
     

       foreach ($articulo as $clave => $valor) {
           $stock = 0;
           $sstock = "SELECT uds_stock FROM articulos WHERE id_articulo = ".$clave;
           $rs2 = $bd->ejecutar($sstock);
           if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
                while ( $b = $bd->obtener_fila($rs2,0)){
                    $stock = $b["uds_stock"];
                }
           }
           
          echo '<tr onclick="location.href=\'../admin/articulos.php?mod_art='.$clave.'\'">
              <td>'.$valor.'</td>
              <td>'.preg_replace('/^(-?\d+).0+$/', '$1', $stock).'</td>
              <td>'.preg_replace('/^(\d+)\.0+$/', '$1',$c->knumber($cantidad[$clave])).'</td>
              <td>'.$pvp[$clave].'</td>
          </tr>  ';
          $suma += $pvp[$clave];
      }
     
    if (_DECIMALES_ !="S"){
        
        $suma = round($suma, 0, PHP_ROUND_HALF_UP);
           
    }  
     
    echo '<tr id="trTotal"><td colspan="3">TOTAL VENTA</td><td id="tdTotal" colspan="2">'.$c->knumber($suma).'</td>
        </tr>';
    echo '</table>';
    
  
   
?>
          
  </body>
</html>