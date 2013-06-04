<?php

require_once('seguridad.php');
require 'clases/includes.php';
include 'lang/'.$_SESSION["lang"].'.php';

//session_start();
//session_name("loginUsuario");
?>
<html>

  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/usuarios.css" />
       
    <script type="text/javascript" src="js/jquery-1.7.1.js">
    </script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.extension-typing.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="styles/keyboard.css" />
    <script type="text/javascript" src="js/wk_usuarios.js"></script>
    
    <script>
        
        $(document).ready(function(){
             $("#dialogAcceso").hide();

             $(".qwerty").keyboard({
                    position:{
                        at: 'center bottom'
                    }
             });
            
        }); 
        

</script>
    
  </head>
 <script type="text/javascript">
       
                      
        function acceso(usuario, pantalla, nivel){
               
                $("#dialogAcceso").dialog({
                            autoOpen: false,
                            width: 600,
                            buttons: {
                                    "OK": function() { 
                                        comprueba(usuario, pantalla, nivel);

                                                
                                    }, 
                                  <?php echo CANCELAR ?>: function() { 
                                            $(this).dialog("close"); 
                                    } 
                            }
              });
               
                    $("#dialogAcceso").dialog("open");
         }
         
   
       
</script>  
  <body>
      
 <?php
 


     echo '<div id="dialogAcceso" title="'. ACCESO.'">
		
                <p>'. INTRO_CLAVE.':</p>
                <p><input class="'.$_SESSION["teclado"].'" type="password" id="contrasena" value="1111" size="8" maxlength="50" required></p>

      </div>';
 
       
 ?>
      
    
      
      
  	<div id="page-wrap">
            <div id="title_users"><p><?php echo SEL_USER; ?> </p></div>

<?php
    include_once('clases/_usuarios.php');
    $users = new _usuarios();
    
    echo $users->g_users();

?>

       </div>
  </body>

</html>
