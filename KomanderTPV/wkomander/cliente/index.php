<?php
session_start();
session_name("cliente");



?>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <title>KomanderTPV</title>
        
    <link rel="stylesheet" type="text/css" href="../styles/style.css" />
    <link href="../styles/acceso.css" rel="stylesheet" type="text/css">
    
   
 
  </head>

  <body>
  	<div id="panel_titulo">KomanderTPV
          <table id="tabla_idiomas"><tr> 
          <td><div class="idiomacli" style="background-image: url('images/es.png');" onclick="location.href='index.php?lang=es'"></div></td>
          <td><div class="idiomacli" style="background-image: url('images/en.png');" onclick="location.href='index.php?lang=en'"></div></td>
          <td><div class="idiomacli" style="background-image: url('images/de.png');" onclick="location.href='index.php?lang=de'"></div></td>
          <td><div class="idiomacli" style="background-image: url('images/fr.png');" onclick="location.href='index.php?lang=fr'"></div></td>
              </tr></table>  
            
</div>
<?php    
      if (isset($_GET["lang"])){
          $_SESSION["lang"] = $_GET["lang"];
         include('lang/'.$_GET["lang"].'.php');   
          
      }else{
          $_SESSION["lang"] = "es";
          include('lang/es.php'); 
      }
      
 ?>     
    <form id="f_acceso" name="form_acceso" method="post" action="controlcli.php">
        <table id="tabla_datos">
        <tr>
            <td colspan="2" align="center">
            <?php
            if (isset($_GET["errorusuario"]))
            {
                if ($_GET["errorusuario"]=="si")
                {
                    echo "Datos incorrectos" ;
                }
                else
                {
                    echo INTRO_CLAVE;
                }
            }
            else
            {
            echo INTRO_CLAVE;
}
?>
</td>
        </tr>
       
        <tr>
            
            <td align="right"><?php echo CLIENTE_CLAVE; ?></td>
            <td><input type="password" id="tcontrasena" name="contrasena" value=""></td>
        </tr>
        

        
        <tr>
            <td colspan="2" align="center"><input type="submit" id="bok" value="<?php echo CLIENTE_ENTRAR; ?>"></td>
           
        </tr>
        
        
        </table> 
    </form>

  </body>

</html>
