<?php
include ("seguridad.php");

header('Content-type: text/html; charset=iso-8859-1');

   include 'lang/'.$_SESSION["lang"].'.php';
    require 'clases/includes.php'; 
    include_once('clases/_comanda.php');
    include_once('clases/_articulos.php');   
    
//    
//    $arts = new _articulos(); 

    $com = new _comanda();
    
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
     
    <link href="styles/comanda.css" rel="stylesheet" type="text/css">
    <link type="text/css" href="styles/jquery.jscrollpane.css" rel="stylesheet" media="all" />
   
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.extension-typing.js"></script>
    
    
    <link rel="stylesheet" type="text/css" href="styles/keyboard.css" />
    <script type="text/javascript" src="js/wk.js"></script>
    <script type="text/javascript" src="js/wk_comanda.js"></script>

  </head>
 
  
<script type="text/javascript">

<?php       
    echo '    function borralinea(idlinea, enviado){
               $("#dialogBorraLinea").dialog({
                            autoOpen: false,
                            width: 600,
                            buttons: {
                                    "'.TEXTO_LIBRE.'": function() { 
                                   
                                   
                                   
                                                textolibre(idlinea);
                                                $(this).dialog("close"); 
                                    },';
  if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado"){
    echo '
                                    "'.INVITAR.'": function() { 
                                   
                                   
                                   
                                                invitalinea(idlinea);
                                                $(this).dialog("close"); 
                                    },';
  }
  
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

     
     
     function textolibre(id){
        gobservlinea(id);
        $("#dialogTexto").dialog({
                        autoOpen: false,
                        width: 600,
                        buttons: {

                                "OK": function() { 

                                        iobservlinea(id, texto_libre.value);
                                         $(this).dialog("close");    
                                }, 
                                "'.CANCELAR.'": function() { 
                                        $(this).dialog("close"); 
                                } 
                        }
                });
        $("#dialogTexto").dialog("open");

    }';
 ?>   
</script>    
  

  <body>
      
  
      
  <?php
        echo $_SESSION["mesa"]. " ". $_SESSION["comensal"];
       
        
        echo '<div id="dialogTexto" title="'.TEXTO_LIBRE.'">
                      <p><input class="'.$_SESSION["teclado"].'" type="text" id="texto_libre" size="10" maxlength="50" required></p>

            </div>';
        
        echo '<div id="dialog" title="'.BORRAR.'">
                        <p>'.$_SESSION["comensal"].'</p>

            </div>';
        
        echo '<div id="dialogNombre" title="'.CAMBIO_NOMBRE.'">
                        <p>'.COMENSAL.':'.$_SESSION["comensal"].'</p>
                        <p>'.INTRO_NOMBRE.':</p>
                        <p><input class="'.$_SESSION["teclado"].'" type="text" id="nuevonombre" size="8" maxlength="50" required></p>

            </div>';
        
        echo '<div id="dialogBorraLinea" title="'.CONTROL_LINEA.'">
		

      </div>';
  

     
     
  ?>
 
  	      
         <div id="panel_botones_comanda"> 
           
           <div id="VolverComanda" onclick="pte()">  
               OK
           </div> 
            <div id="sube1" onclick="sube1(<?php echo $_SESSION["padre"]?>)">  
               <?php echo ATRAS;?>
           </div>
           <div id="padre0" onclick="padre0()">  
                <?php echo INICIO;?>
           </div>

              <div id="sliderWrap">
    <div id="openCloseIdentifier"></div>
    <div id="slider">
        <div id="sliderContent">
            
<?php
    
   
   echo $com->boton_comensales();
 
?>
            <div id="bAbrir" class="boton_c" onclick="abrir_cliente()">  
                  <?php echo GENERAR; ?>  <p style="margin-top: 30px;"><?php echo $com->g_clave($_SESSION["mesa"], $_SESSION["comensal"]); ?></p> 
           </div> 
            <div id="bTiket" class="boton_c" onclick="tiket()">  
                   <?php echo TIKET; ?>
           </div>
           <div id="bTrasp" class="boton_c" onclick="trasp()">  
                   <?php echo TRASPASO; ?>
           </div>
           
 <?php           
    if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado"){ 
//        
//      
//        
      echo '<div id="acobro" class="boton_c" onclick="cobrar(ttotal.innerHTML)">  
                   '.COBRAR.'
           </div>';
      echo '<div id="bEliminar" class="boton_c" onclick="$(\'#dialog\').dialog(\'open\');">  
                   '.BORRAR.'
           </div>';
  
    }else{//si el comensal no tiene contenido ke lo pueda eliminar cualquiera
        if (!$com->c_contenido($_SESSION["mesa"], $_SESSION["comensal"])){
             echo '<div id="bEliminar" class="boton_c">  
                  '.BORRAR.'
           </div>';
          
        }
    } 
       echo '<div id="bNombre" class="boton_c">  
                    '.CAMBIO_NOMBRE.'
           </div>';
  ?>          
            
           


            
        </div>
        <div id="openCloseWrap">

                <div id="b_menu" class="topMenuAction"></div>
              

        </div>
    </div>
</div>
           
         
           
       </div> 
        
       
      <div id="container_info"></div>
<?php
   
 echo '<table id="tb_datos"><tr>';
// 
   echo '<td id="td_comanda">';
//      echo $com->g_comanda($_GET['mesa'], $_GET['comensal']);
   echo '</td>';
// 
   echo '<td id="td_articulos">';
    echo '<div id="articulos"><div>';
//      echo $arts->g_familias($_GET['mesa'], $_GET['comensal'], $_GET['padre']);
//      echo $arts->g_articulos($_GET['mesa'], $_GET['comensal'], $_GET['padre']);
   echo '</td>';
// 
 echo '</tr></table>';
    
//    echo $_SESSION['last_padre'];
?>




   
 
  </body>

</html>

