<?php
require_once('seguridad.php');
    require 'clases/includes.php';
    include_once('clases/_i_historial.php');
    include_once('clases/_pte.php');
    include 'lang/'.$_SESSION["lang"].'.php';
?>

<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link href="styles/trasp.css" rel="stylesheet" type="text/css">

     <script TYPE="text/javascript" src="js/jquery-1.7.1.js"></script>
     <script TYPE="text/javascript" src="js/jquery.scrollablecombo.js"></script>
   
    <script type="text/javascript" src="js/jquery.mousewheel.js"></script>

    <!-- the jScrollPane script -->
    <script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
    

<script TYPE="text/javascript">
        
         
        
        function gup( name )
        {
          name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
          var regexS = "[\\?&]"+name+"=([^&#]*)";
          var regex = new RegExp( regexS );
          var results = regex.exec( window.location.href );
          if( results == null )
            return "";
          else
            return results[1].replace('%20',' ');

        }
        

        </script>
        
    
     <?php
 echo '<script type="text/javascript">
     
        function setValue()
        {

            mesa_destino.value = gup(\'mdestino\');
            //comensal_destino.value = gup(\'cdestino\');
        }
         
        function set_m_destino(){
                location.href="trasp.php?mdestino="+ mesa_destino.value;
        }
         function set_c_destino(){
                location.href="trasp.php?mdestino="+ mesa_destino.value+"&cdestino="+comensal_destino.value;
        }
        
        function traspasar(){
                if (($("#comensal_destino").text()) == ""){
                    alert("Antes de traspasar debes seleccionar una mesa.");
                }else{
                    location.href="controltrasp.php?mdestino="+ mesa_destino.value+"&cdestino="+comensal_destino.value;
                }
        }
        
        function volver(){
                location.href="controltraspvolver.php";
        }
       
 </script>   '; 
 ?>
  </head>

  <body onload="setValue()">
  	<div id="page-wrap">
            <div id="datos_origen">
                    <table id="tabla_origen">
                        <tr><td><?php echo M1 ;?>:</td></tr>
                        <tr><td><input type="text" id="m_origen" name="mesaorigen" size="20" maxlength="30" value="<?php echo $_SESSION["mesa"]?>"/></td></tr>
                        <tr><td><?php echo C1 ;?>:</td></tr>
                        <tr><td><input type="text" id="c_origen" name="comensalorigen" size="20" maxlength="30" value="<?php echo $_SESSION["comensal"]?>"/></td></tr>
                        
                    </table>               
                </div>
           

            
<?php
  include_once('clases/_trasp.php');
  
  $tr = new _trasp();
  echo $tr->panel_destino();
  
  if (isset($_GET['cdestino'])){
      $tr->traspasar($_SESSION['mesa'], $_SESSION['comensal'], $_GET['mdestino'], $_GET['cdestino']);
  }
  
  if (isset($_GET['mdestino'])){
      //carga combo con comensales
      echo $tr->panel_com_destino($_GET['mdestino']);
  }


?>
      <div id="botones_trasp">
          <div id="bOKTrasp" class="b_trasp" onclick="traspasar()">
              OK
          </div>
          <div id="bVolverTrasp" class="b_trasp" onclick="volver()">
              <?php echo VOLVER ;?>
          </div>
      </div>
   </div>
  </body>

</html>
