<?php
include ("seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
?>
<html>

  <head>
    
    <title>KomanderTPV</title>
     
    <!--<link rel="stylesheet" type="text/css" href="styles/style.css" />-->
    <link href="styles/caja.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/keyboard.css" />
  </head>
  
   <script>
        $(document).ready(function(){
            $(".qwerty").keyboard({
                    position:{
                        at: 'center bottom'
                    }
                });
        });
   </script>
  
 <?php
 echo '<script type="text/javascript">';
        

echo 'function cierracaja(){
                location.href="cierracaja.php?idcaja="+tIdCaja.value+"&efectivo="+tEfectivo.value.replace(/,/g,"")+"&tarjeta="+tTarjeta.value.replace(/,/g,"");
            }';
 
        
 echo ' function abrecaja(){
    
            location.href="abrecaja.php?cambio="+tCambio.value;
        }
        
        function volver(){
            location.href="admin.php";
        }
        
        function conf_cierre(){
            if (confirm("Seguro que desea cerrar la caja?")){
                cierracaja();
            }
        }
       
</script>    '; 
 
 
 
 ?>
<body>
    
<?php
include_once('clases/_caja.php');
    
    $caja = new _caja();
    echo $caja->g_caja_abierta($_SESSION["teclado"]);


?>
</body>
</html>