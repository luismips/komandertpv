<?php
header('Content-type: text/html; charset=iso-8859-1');

session_start();
session_name("loginUsuario");

if ($_SESSION["nivel"] != "administrador") {
    header("Location: ../usuarios.php");
}

require '../clases/includes.php';



include_once('clases/_articulos.php');
$arts = new _articulos();

?>
<html>

  <head>
   
    
    <title>KomanderTPV</title>
    
<!--    <script type="text/javascript" src="../js/mktree.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/mktree.css" />-->
   
    <script type="text/javascript" src="../js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
    <script type="text/javascript" src="../js/jscolor.js"></script>
    <script src="../js/jquery.screwdefaultbuttons.js" ></script>
    <link type="text/css" href="../styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="../js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="../js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/keyboard.css" />
    <!--<link rel="stylesheet" type="text/css" href="../styles/style.css" />-->
    <link rel="stylesheet" type="text/css" href="styles/articulos.css" />
    <script>
        $(document).ready(function(){
            $(".qwerty").keyboard({
                    position:{
                        at: 'center bottom'
                    }
                });
                
             $('input:checkbox').screwDefaultButtons({ 
             checked: "url(../styles/images/checkbox_Checked.jpg)",
             unchecked:	"url(../styles/images/checkbox_Unchecked_Dis.jpg)",
             width:	 85,
             height:	 85
          });
            
         
          
        });
</script>

   
    
<?php
 echo '<script type="text/javascript">
        


        function articulos(){

            if (document.getElementById("familia").value != ""){
                location.href="articulos.php?familia="+document.getElementById("familia").value;
            }
        }
        
        function nuevo(){

            if (document.getElementById("familia").value != ""){
                location.href="articulos.php?nuevo=S&familia="+document.getElementById("familia").value;
            }
        }
        
        function i_articulo(){
              var tarifa = "N";
              var stock = "N";
              
              if (document.getElementById("tarifa").checked){
                    tarifa = "S";
              }else{
                    tarifa = "N";
              }
              
              if (document.getElementById("stock").checked){
                    stock = "1";
              }else{
                    stock = "0";
              }
              

            if (document.getElementById("nombre").value != ""){
                location.href="articulos.php?i_articulo=S&nombre="+document.getElementById("nombre").value+"&familia="+document.getElementById("familia").value+"&pvp="+document.getElementById("pvp").value+"&tarifa="+tarifa+"&stock="+stock+"&color="+document.getElementById("tcolor").value;
            }
        }
        
         function del_art(art){
            var temp = confirm("Seguro que desea eliminar el articulo?");
            if (temp){
               location.href="articulos.php?del_art="+art+"&familia="+document.getElementById("familia").value;
            }
         }
         
        function mod_art(art){
            location.href="articulos.php?mod_art="+art;//+"&familia="+document.getElementById("familia").value;
         }
         
         function upd_art(id){
              var tarifa = "N";
              var stock = "N";
              
              if (document.getElementById("tarifa").checked){
                    tarifa = "S";
              }else{
                    tarifa = "N";
              }
              
              if (document.getElementById("stock").checked){
                    stock = "1";
              }else{
                    stock = "0";
              }
 
            location.href="articulos.php?upd_art="+id+"&nombre="+document.getElementById("nombre").value+"&familia="+document.getElementById("familia").value+"&pvp="+document.getElementById("pvp").value+"&tarifa="+tarifa+"&stock="+stock+"&color="+document.getElementById("tcolor").value+"&orden="+document.getElementById("torden").value+"&imagen="+document.getElementById("timagen").value;
         }
        
          function del_grupo(idgrupo, idart){
            location.href="articulos.php?del_grupo="+idgrupo+"&mod_art="+idart;
         }
         
          function add_relacion(idart){
            location.href="articulos.php?add_relacion=S&idart="+idart+"&mod_art="+idart+"&idgrupo="+document.getElementById("grupo").value;
         }
        
         function add_uds(idart){
          if (document.getElementById("tAddUds").value != ""){
            location.href="articulos.php?add_uds=S&idart="+idart+"&uds="+document.getElementById("tAddUds").value+"&familia="+document.getElementById("familia").value;
          }
         }
        
      

      
       
 </script>   '; 

 
 
 

?>
    </head>

  <body>
      
      <div id="page-wrap">
          
      
    
      
<?php

if (isset($_GET['add_uds'])){
   $arts->add_uds($_GET['idart'],$_GET['uds']);
   header("Location: articulos.php?mod_art=".$_GET['idart']);
    
}

if (isset($_GET['add_relacion'])){
   $arts->add_relacion($_GET['idart'],$_GET['idgrupo']);
    
}

if (isset($_GET['i_articulo'])){
    $arts->i_articulo($_GET['nombre'], $_GET['familia'], $_GET['pvp'], 
            $_GET['tarifa'], $_GET['stock'], $_GET['color']);
     
}

if (isset($_GET['del_art'])){
   $arts->del_art($_GET['del_art']);
    
}

if (isset($_GET['del_grupo'])){
   $arts->del_grupo($_GET['del_grupo'],$_GET['mod_art'] );
    
}

if (isset($_GET['upd_art'])){
   $arts->upd_articulo($_GET['upd_art'], $_GET['nombre'], $_GET['familia'], $_GET['pvp'], 
             $_GET['orden'], $_GET['tarifa'], $_GET['stock'], $_GET['color'], $_GET["imagen"]);
    
}


if (isset($_GET['nuevo'])){
   echo $arts->nuevo($_GET['familia']);
    
} else if (isset($_GET['mod_art'])){
   echo $arts->mod_art($_GET['mod_art']);
    


}else {
    if (isset($_GET['familia'])){
        echo $arts->g_articulos($_GET['familia']);
    } else{
        echo $arts->listado();
    }
}





?>

      </div>
  </body>

</html>
