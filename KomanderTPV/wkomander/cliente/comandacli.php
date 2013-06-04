<?php
include ("seguridadcli.php");
header('Content-type: text/html; charset=iso-8859-1');


if (isset($_SESSION["lang"])){
          
         include('lang/'.$_SESSION["lang"].'.php');   
          
 }  

include_once('clases/_comanda.php');
include_once('../clases/_i_historial.php');
include_once('../clases/_articulos.php');
    
    
   if (isset($_GET['c'])){
        if($_GET['c']==""){
            $_SESSION['comensal'] = "1";    
        }else{
            $_SESSION['comensal'] = $_GET['c'];
        }
    }
?>

<html>

  <head>
  
    <title>KomanderTPV</title>
     
    <link rel="stylesheet" type="text/css" href="../styles/style.css" />
    <link href="../styles/comanda.css" rel="stylesheet" type="text/css">
    
   
    <script type="text/javascript" src="../js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="../styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="../js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="../js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/keyboard.css" />
    <script type="text/javascript" src="../js/wk.js"></script>
    <script type="text/javascript" src="js/wk_cli.js"></script>

  </head>
 
  
   <?php
 echo '<script type="text/javascript">
              
     
        function borralinea(idlinea, enviado){
               $("#dialogBorraLinea").dialog({
                            autoOpen: false,
                            width: 600,
                            buttons: {
                                    "'.TEXTO_LIBRE.'": function() { 
                                   
                                   
                                   
                                                textolibre(idlinea);
                                                $(this).dialog("close"); 
                                    },';

 echo '                                   "'.BORRAR.'": function() { 
                                              borralinea2(idlinea, enviado);

                                                
                                    }, 
                                    "'.CANCELAR.'": function() { 
                                            $(this).dialog("close"); 
                                    } 
                            }
                    });
               
                    $("#dialogBorraLinea").dialog("open");
         }

</script>    '; 
 
 
 
 ?>
<script>
        function i_historial(mods, articulo, idarticulo){
           a_historial(mods, articulo, idarticulo, "<?php echo CLIM_CONFIRMAR ?>");
        }


   </script>

  <body>
      
  
      
  <?php
    
        echo '<div id="dialogTexto" title="'.TEXTO_LIBRE.'">
                      <p><input type="text" id="texto_libre" size="10" maxlength="50" required></p>

        </div>';
       
        
        echo '<div id="dialogBorraLinea" title="'.CONTROL_LINEA.'">
		

        </div>';
  
?>
        	      
       <div id="panel_botones_comanda"> 
           
           <div id="bInicio" class="boton_cli" onclick="padre0()">  
               <?php echo CLIM_INICIO; ?>
           </div>
           <div id="bAtras" class="boton_cli" onclick="sube1()">  
               <?php echo CLIM_ATRAS; ?>
           </div>
           <div id="bEnviar" class="boton_cli" onclick="pte()">  
               <?php echo CLIM_ENVIAR; ?>
           </div>
           <div id="bAyuda" class="boton_cli_help" onclick="location.href='ayuda.php'">  
               <?php echo CLIM_AYUDA; ?>
           </div>

       </div> 
        
       <div id="container_info"></div>
       
<?php
   
  echo '<table id="tb_datos"><tr>';
 
      echo '<td id="td_comanda">';
      echo '</td>';

      echo '<td id="td_articulos">';
        echo '<div id="articulos"><div>';
      echo '</td>';
 
  echo '</tr></table>';
    

?>
 </body>

</html>

