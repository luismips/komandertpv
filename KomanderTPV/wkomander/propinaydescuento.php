<?php
include ("seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
require 'clases/db/config.php';
include_once('clases/conexion.php');
$datos = new conexion();
?>

<html>

  <head>
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link href="styles/propinaydescuento.css" rel="stylesheet" type="text/css">
         <!-- styles needed by jScrollPane -->
      <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/keyboard.css" />
    <script>
        $(document).ready(function(){
            $(".qwerty").keyboard({
                    position:{
                        at: 'center bottom'
                    }
                });
            
           
           
           $("#tAvgProp").change(function(evento){
               
               var suma = parseFloat(tCantidad.value.replace(/,/g,""));
               var avgprop = parseFloat(tAvgProp.value.replace(/,/g,""));
                var avgdesc = parseFloat(tAvgDesc.value.replace(/,/g,""));
                var total = 0.00;
                
                var prop = 0.00;
                var desc = 0.00;
                
               
                prop = parseFloat((suma * avgprop) /100);
                desc = parseFloat((suma * avgdesc) /100);
                
                total = suma + prop - desc;
                
                
               
              tProp.value = prop.toFixed(2);//.replace(".",","); 
              tTotal.value = total.toFixed(2);//.replace(".",",");
              
           });
           
           $("#tAvgDesc").change(function(evento){
               
               var suma = parseFloat(tCantidad.value.replace(/,/g,""));
               var avgprop = parseFloat(tAvgProp.value.replace(/,/g,""));
                var avgdesc = parseFloat(tAvgDesc.value.replace(/,/g,""));
                var total = 0.00;
                
                var prop = 0.00;
                var desc = 0.00;
                
               
                prop = parseFloat((suma * avgprop) /100);
                desc = parseFloat((suma * avgdesc) /100);
                
                total = suma + prop - desc;
                
                
               
              tDesc.value = desc.toFixed(2);//.replace(".",","); 
              tTotal.value = total.toFixed(2);//.replace(".",",");
              
           });
        });
</script>

    <?php
 echo '<script type="text/javascript">
         
        function guarda(){
                location.href="guardaavg.php?mesa='.$_GET['mesa'].'&comensal='.$_GET['comensal'].'&propina="+tAvgProp.value+"&descuento="+tAvgDesc.value;
        }

        function volver(){
                location.href="comanda.php?mesa='.$_GET['mesa'].'&comensal='.$_GET['comensal'].'&padre=0";
        }
       
       
 </script>   '; 
 ?>

   
  </head>
 <?php
        $clase = "";
        if ($_SESSION["teclado"]=="S"){
            $clase = 'class="qwerty"';
        }else{
            $clase = "";
        }
 ?>
  <body>
      
      <div id="page-wrap">
          
          <table id="tabla_avg">
              
              <tr>
                  <td>SUMA</td>
                  <td><input type="text" id="tCantidad"  value="<?php echo $datos->knumber($_GET['suma']);?>"></td>                  
              </tr>
              <tr>
                  <td>%</td>
                  <td>CANTIDAD</td>                  
              </tr>
              <tr>
                  <td>PROPINA<input type="text" id="tAvgProp" class="<?php echo $clase; ?>" value="<?php echo $datos->knumber($_GET['avgpropina']);?>"></td>
                  <td><input type="text" id="tProp" value="<?php echo $datos->knumber(($_GET['suma']*$_GET['avgpropina'])/100);?>"></td>                  
              </tr>
              
              <tr>
                  <td>DESCUENTO<input type="text" id="tAvgDesc" class="<?php echo $clase; ?>" value="<?php echo $datos->knumber($_GET['avgdescuento']);?>"></td>
                  <td><input type="text" id="tDesc" value="<?php echo $datos->knumber(($_GET['suma']*$_GET['avgdescuento'])/100);?>"></td>                  
              </tr>
               <tr>
                  <td>TOTAL</td>
                  <td><input type="text" id="tTotal" value="<?php echo $_GET['total'];?>"></td>                  
              </tr>
              <tr>
                  <td><div class="boton" onclick="guarda()">OK</div></td>
                  <td><div class="boton" onclick="volver()">VOLVER</div></td>                  
              </tr>
              
              
          </table>
          
          
      </div>
      
      
  </body>
  
</html>