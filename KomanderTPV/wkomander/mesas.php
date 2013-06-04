<?php
     
 include ("seguridad.php");
 include 'lang/'.$_SESSION["lang"].'.php';

 header('Content-type: text/html; charset=iso-8859-1');
    
 require 'clases/includes.php';
 include_once('clases/_mesas.php');

 $m = new _mesas();
    
    
?>

<html>

  <head>
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link href="styles/mesas.css" rel="stylesheet" type="text/css">
         <!-- styles needed by jScrollPane -->
    <link type="text/css" href="styles/jquery.jscrollpane.css" rel="stylesheet" media="all" />

   
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/keyboard.css" />
    
     <script type="text/javascript" src="js/jquery.timer.js"></script>
    
    <!-- the mousewheel plugin - optional to provide mousewheel support -->
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
    
    <script type="text/javascript" src="js/wk.js"></script>
    <script type="text/javascript" src="js/wk_mesas.js"></script>
    
  </head>
  
<body>
<!--      <span id="sonido"></span>-->
  <div id="sliderWrap">
            <div id="openCloseIdentifier"></div>
            <div id="slider">
                <div id="sliderContent">
                    <table>
                        <tr>
                            <td class="td_zonas_title">
                               <?php echo ZONAS; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php

                                    echo $m->g_zonas();

                                ?> 
                            </td>
                        </tr>
                        <tr>
                            <td class="td_zonas_title">
                               <?php echo UTILIDADES; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <div id="bCajon" onclick="location.href='abrecajon.php'"><?php echo CAJON; ?></div>   
                            </td>
                            
                        </tr>
                    </table>     
                       
                       
        </div>
        <div id="openCloseWrap">
<!--            <a href="#" class="topMenuAction" id="topMenuImage">-->
                <div id="b_menu_mesas" class="topMenuAction"></div>
<!--                <img src="open.png" alt="open" />-->
<!--            </a>-->
        </div>
        
    </div>
        
</div>
      
  	<div id="page-wrap">
        
             <div id="panel_botones_mesas">  
               <table id="tb_botones_mesas">
                 <tr>
                     <td id="td1">
                         <!--<div class="boton_fantasma"> </div>-->
                     </td>
                     <td id="td2">
                         <div id="bSelVisor" onclick="location.href='selvisor.php'"><?php echo VISOR; ?></div>
                        
                     </td>
                     <td id="td3">
                         <div id="bPteEntrega" onclick="location.href='pte_entrega.php'"><?php echo PTE_ENTREGA; ?></div>
                
                     </td>
                     <td id="td4">
                         
                     </td>
                        
                     <td id="td5">
                        <div id="bSalirMesa" onclick="salir('<?php echo $_SESSION["unico"]; ?>')" title="Salir a pantalla usuarios."></div>
                     </td>
                     
                        
                 </tr>
               </table> 


             </div>
            

<?php


    echo '<div id="dialogLlevar" title="'.NOMBRE.':">
		<p>'.INTRO_NOMBRE.':</p>
                <p><input class="'.$_SESSION["teclado"].'" type="text" id="nombre" size="8" maxlength="50" required></p>

      </div>';
    
    echo '<div id="dialogReparto" title="'.TELEFONO.':">
		<p>'.INTRO_TELEFONO.':</p>
                <p><input class="'.$_SESSION["teclado"].'" type="text" id="telefono" size="8" maxlength="50" required></p>

      </div>';

    echo $m->g_mesas($_SESSION['zona'], $_SESSION['tipo_zona']);
    
?>
            
            


            </div><!--pagewrap-->
  </body>

</html>
