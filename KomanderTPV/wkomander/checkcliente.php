<?php
session_start();
    session_name("loginUsuario");
    header('Content-type: text/html; charset=iso-8859-1');
    require 'clases/includes.php';
    include 'lang/'.$_SESSION["lang"].'.php';
?>
<html>

  <head>
        
    <title>KomanderTPV</title>
     
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link href="styles/checkcliente.css" rel="stylesheet" type="text/css">
     <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/keyboard.css" />
    
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
        
        
        function nuevoreparto(){
                location.href="nuevoreparto.php?tlf="+ttlf.value+"&nombre="+tnombre.value+"&direccion="+tdireccion.value+"&observ="+tobserv.value+"&zona_mapa="+tzona.value;
        }
        
        function volver(){
                location.href="mesas.php?zona='.$_SESSION["zona"].'";
        }
       
 </script>   '; 
 ?>
  </head>
  


  <body>
  	<div id="page-wrap">
          
           

<?php
      $bd=Db::getInstance(); 
      
        $nombre = "";
        $direccion = "";
        $observ = "";
        
     
        $ssql ="SELECT * FROM clientes WHERE tlf = '".$_GET["tlf"]."'";
    
        $rs = $bd->ejecutar($ssql);
        
         $clase = "";
        if ($_SESSION["teclado"]=="S"){
            $clase = 'class="qwerty"';
        }else{
            $clase = "";
        }
        
        
        echo '<table id="tabla_cliente">
            <tr><td>'.TELEFONO.':</td><td><input type="text" id="ttlf" '.$clase.' name="ttlf" value="'.$_GET["tlf"].'" required></td></tr>';

        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
           while ( $a = $bd->obtener_fila($rs,0)){
               
               $nombre= stripslashes($a["nombre"]);
               $direccion = stripslashes($a["direccion"]);
               $observ = stripslashes($a["observ"]);
               
                echo '<tr><td>'.NOMBRE.':</td><td><input type="text" id="tnombre" '.$clase.' name="tnombre" value="'.stripslashes($a["nombre"]).'" required></td></tr>';
                echo '<tr><td>'.DIRECCION.':</td><td><input type="text" id="tdireccion" '.$clase.' name="tdireccion" value="'.stripslashes($a["direccion"]).'" required></td></tr>';
                echo '<tr><td>'.ZONA.':</td><td><input type="textarea" id="tzona" '.$clase.' name="tzona" value="'.stripslashes($a["zona_mapa"]).'"></td></tr>';
                echo '<tr><td>'.OBSERV.':</td><td><input type="textarea" id="tobserv" '.$clase.' name="tobserv" value="'.stripslashes($a["observ"]).'"></td></tr>';
       
            }
            
           

            }else{
                echo '<tr><td>'.NOMBRE.':</td><td><input type="text" id="tnombre" '.$clase.' name="tnombre" value="" required></td></tr>';
                echo '<tr><td>'.DIRECCION.':</td><td><input type="text" id="tdireccion" '.$clase.' name="tdireccion" value="" required></td></tr>';
                echo '<tr><td>'.ZONA.':</td><td><input type="text" id="tzona" '.$clase.' name="tzona" value=""></td></tr>';
                echo '<tr><td>'.OBSERV.':</td><td><input type="textarea" id="tobserv" '.$clase.' name="tobserv" value=""></td></tr>';
                
          }
          
          echo '<tr><td><div id="bVolver" class="boton" onclick=volver()>'.VOLVER.'</div></td>';
          echo '<td><div id="bOk" class="boton" onclick=nuevoreparto()>OK</div></td></tr>';
        
        echo '</table>';
    
 ?>
  </div>
  </body>

</html>