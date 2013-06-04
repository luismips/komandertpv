<?php
session_start();
session_name("loginUsuario");
if ($_SESSION["nivel"] != "administrador") {
    header("Location: ../usuarios.php");
}
header('Content-type: text/html; charset=iso-8859-1');

require '../clases/includes.php';
include_once('clases/_modificadores.php');
$mods = new _modificadores();
?>
<html>

  <head>
   
    
    <title>KomanderTPV</title>
    
<!--    <script type="text/javascript" src="../js/mktree.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/mktree.css" />-->
   
    <script type="text/javascript" src="../js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
    <script type="text/javascript" src="../js/jscolor.js"></script>
    <link type="text/css" href="../styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="../js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="../js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/keyboard.css" />
    <link rel="stylesheet" type="text/css" href="../styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/modificadores.css" />
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
 echo '<script type="text/javascript">
        
              
        function nuevo_grupo(){

            if (document.getElementById("nuevo_grupo").value != ""){
                location.href="modificadores.php?nuevo_grupo="+document.getElementById("nuevo_grupo").value;
            }
        }
        
        function nuevo_mod(){

            if (document.getElementById("nombre_mod").value != ""){
                location.href="modificadores.php?nuevo_mod="+document.getElementById("nombre_mod").value+"&precio="+document.getElementById("precio_mod").value+"&grupo="+document.getElementById("nombre_grupo").value;
            }
        }
        
        function del_mod(mod){
            var temp = confirm("Seguro que desea eliminar el modificador?");
            if (temp){
                location.href="modificadores.php?del_mod="+mod+"&grupo="+document.getElementById("nombre_grupo").value;
            
            }
            
             
        }

        function infogrupo(){

            if (document.getElementById("nombre_grupo").value != ""){
                location.href="modificadores.php?grupo="+document.getElementById("nombre_grupo").value;
            }
        }
        
        
        
        function del(){

            if (document.getElementById("nombre_grupo").value != ""){
                var temp = confirm("Seguro que desea eliminar el grupo de modificadores?");
                if (temp){
                           location.href="modificadores.php?del=S&grupo="+document.getElementById("nombre_grupo").value;

                }
            }
         }

      
       
 </script>   '; 

 
 
 

?>
    </head>

  <body>
      
      <div id="page-wrap">
          
      
    
      
<?php
if (isset($_GET['del_mod'])){
    $mods->del_mod($_GET['del_mod'], $_GET['grupo']);
} 

if (isset($_GET['del'])){
    $mods->d_grupo($_GET['grupo']);
} 


if (isset($_GET['nuevo_grupo'])){
    $mods->i_grupo($_GET['nuevo_grupo']);
    
} 

if (isset($_GET['nuevo_mod'])){
    $mods->i_mod($_GET['nuevo_mod'], $_GET['precio'], $_GET['grupo']);
    
} 
//
//if (isset($_GET['mod'])){
//    $fam->m_familia($_GET['nombre'], $_GET['padre'], $_GET['grupo'], $_GET['preferencia'], $_GET['color']);
//}
//
if (isset($_GET['grupo'])){
    echo $mods->g_grupomods($_GET['grupo']);
} else{
    echo $mods->panel();
}




?>

      </div>
  </body>

</html>
