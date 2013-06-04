<?php
include ("seguridad.php");

header('Content-/itype: text/html; charset=iso-8859-1');
require 'clases/conexion.php';
require 'clases/db/config.php';
include 'lang/'.$_SESSION["lang"].'.php';
$c = new conexion();
?>
<html>

  <head>
   
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link href="styles/cobro.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/keyboard.css" />
    <script type="text/javascript" src="js/wk.js"></script>
    <script type="text/javascript" src="js/wk_cobro.js"></script>
   
<?php

echo '<script type="text/javascript">';

$todo = "";

 if (isset($_GET['todo'])){
     $todo = "todo=S&";
 }  
 
 echo ' function cobrar(){
            location.href="controlcobro.php?'.$todo.'tipo="+tipo_cobro.value+"&total="+tTotal.value.replace(/,/g,"")+"&entregado="+tEntregado.value+"&efectivo="+tEfectivo.value+"&tarjeta="+tTarjeta.value;
        }';
   
 echo '</script>   '; 

?>
    </head>

  <body id="body_cobro">
      
          
      <input type="hidden" id="tipo_cobro" value="T" />
  	<div id="page-wrap">
            <div id="panel_tipo_cobro">  
                
                <div id="bEfectivo" class="b_cobro">
                   <?php echo EFECTIVO; ?>
                </div>
                <div id="bTarjeta" class="b_cobro">
                   <?php echo TARJETA; ?>
                </div>
                <div id="bParcial" class="b_cobro">
                   <?php echo PARCIAL; ?>
                </div>
            </div>
            
            <div id="panel_datos_cobro">  
                <table id="tabla_cobro">
                    <tr>
                        <td id="lTotal"><?php echo TOTAL; ?>:</td>
                        <td><input id="tTotal" type="text" name="total" size="15" maxlength="50" value="<?php echo $_GET["total"]?>"></td>
                    </tr>
                    <tr>
                        <td id="lEfectivo"><?php echo EFECTIVO; ?>:</td>
                        <td><input class="<?php  echo $_SESSION["teclado"]?>" id="tEfectivo" onchange="efectivo('<?php echo _DECIMALES_?>')" type="text" name="efectivo" size="15" maxlength="50" value="<?php echo $c->knumber(0)?>"></td>
                    </tr>
                    <tr>
                        <td id="lTarjeta"><?php echo TARJETA; ?>:</td>
                        <td><input class="<?php  echo $_SESSION["teclado"]?>" id="tTarjeta" type="text" name="tarjeta" size="15" maxlength="50" value="<?php echo $c->knumber(0)?>"></td>
                    </tr>
                    <tr>
                        <td id="lEntregado"><?php echo ENTREGADO; ?>:</td>
                        <td><input class="<?php  echo $_SESSION["teclado"]?>" id="tEntregado" onchange="entregado('<?php echo _DECIMALES_ ?>')" type="text" name="entregado" size="15" maxlength="50" value="<?php echo $c->knumber(0)?>"></td>
                    </tr>
                    <tr>
                        <td id="lCambio"><?php echo CAMBIO; ?>:</td>
                        <td><input id="tCambio" type="text" name="total" size="15" maxlength="50" value="<?php echo $c->knumber(0)?>"></td>
                    </tr>
                    
                </table>
            </div>
            
            <div id="panel_ok_cobro">  
                
                <div id="bOkcobro" class="b_cobro" onclick="cobrar()">
                    OK
                </div>
<!--                <div id="bTiket" class="boton" onclick="tiket()">
                    
                </div>-->
                <div id="bVcobro" class="b_cobro" onclick="volver()">
                    <?php echo VOLVER; ?>
                </div>                
            </div>
            
<?php
            



?>

       </div>
  </body>

</html>

