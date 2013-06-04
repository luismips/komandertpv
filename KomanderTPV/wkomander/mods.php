<?php
session_start();
session_name("loginUsuario");

    require 'clases/includes.php';
    $_SESSION["ids_mods"] = "";
    $_SESSION["mods"] = "";
    $_SESSION['uds'] = 1;
    if (isset($_GET['i'])){
        $_SESSION['idarticulo'] = $_GET['i'];
        $_SESSION['articulo'] = $_GET['a'];
    }
?>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
     
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link href="styles/mods.css" rel="stylesheet" type="text/css">
     <!-- latest jQuery direct from google's CDN -->
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/keyboard.css" />

    
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" src="js/wk.js"></script>
    <script type="text/javascript" src="js/wk_mods.js"></script>
    
<script>
        function volver(){
            location.href="comanda.php";
         }    
       
    </script>




  </head>

  <body>
      
    	
         <div id="articulo_mods">   
             
                <table id="tabla_articulo">
                    <thead>
                        <tr>
                            <th scope="col">UDS</th>
                            <th scope="col">ARTICULO</th>
                            
                        </tr>
                    </thead>
                     <tr>
                         <td><input class="<?php  $_SESSION["teclado"] ?>" type="text"  id="mods_uds" name="uds" value="<?php echo $_SESSION["uds"]?>"></td>
                         <td><input type="text" id ="mods_art" name="articulo" value="<?php echo $_SESSION["articulo"]?>"></td>
                         
                     </tr>
                     <tr>
                         <td colspan="2"><input type="Text"  id="mods_mods" name="mods_mods"></td>
                     
                     </tr>
                     <tr>
                         <td colspan="2"><input class="<?php  $_SESSION["teclado"] ?>" type="text" id="mods_libre" name="libre"></td>
                     
                     </tr>
                     
                 </table>
            
             <div id="bMods_ok" class="boton_m" onclick="i_historial('<?php echo $_SESSION['articulo']; ?>', <?php echo $_SESSION['idarticulo']; ?>)">
                 OK
             </div> 
             <div id="bMods_back" class="boton_m" onclick="volver()">
                 VOLVER
             </div>
         
         </div>   

   

  </body>

</html>