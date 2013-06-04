<?php
include ("seguridad.php");
  header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
include_once('clases/_mesas.php');
//include_once('clases/_addcomensales.php');
include_once('clases/_i_historial.php');
include 'lang/'.$_SESSION["lang"].'.php';

//$comen = new _addcomensales();
$m = new _mesas();
?>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link href="styles/comensales.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/keyboard.css" />
    <script type="text/javascript" src="js/wk.js"></script>
    <script type="text/javascript" src="js/wk_comensales.js"></script> 
     
 
  </head>

  <body>
      
<div id="page-wrap">
  <div id="addcom_nombre">  
   <div id="sliderWrap">
    <div id="openCloseIdentifier"></div>
    <div id="slider">
        <div id="sliderContent">
            
             
            <div id="bTiket" class="b_slider" onclick="tiket()">  
                 <?php echo TIKET;?>
           </div>
            
         
           
 <?php           
    if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado"){ 
        
      
        
      echo '<div id="acobro" class="b_slider" onclick="cobrar('.$m->g_total_todos($_SESSION["mesa"]).')">  
                   '.COBRAR.'
           </div>';
     
     
    }      
  ?> 
            
            
  
                <table class="tb_add" align="left">
                    <tr>
                        <td><?php echo NOMBRE_NUEVO_COM;?></td>
                        
                    </tr>
                    <tr>
<?php    
  
         echo '<td><input id="nombre_com" class="'.$_SESSION["teclado"].' type="text" name="nombrecom" size="30" maxlength="45"></td>';               
   
?> 
                        <td rowspan="2"> <div class="b_add" onclick="add(num_com.value, nombre_com.value)">
                            +
                        </div></td>
                    </tr>
                     <tr>
                        <td><?php echo NUM_NUEVO_COM;?></td>
                        
                    </tr>
                    <tr>
<?php    
   
         echo '<td><input id="num_com" class="'.$_SESSION["teclado"].'" type="text" name="nombrecom" size="10" maxlength="5"></td>';               
    
?>                 
                    </tr>
                    
                </table>  
                
         <div id="openCloseWrap">

                <div id="b_menu_com" class="topMenuAction"></div>
         </div>
    </div>
          </div>
                
          </div>   
       <div id="addmesa" class="b_com" onclick="pte()">
                   OK
       </div>
    </div>

           
      
      
         

</div>
  </body>

</html>
