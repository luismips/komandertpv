<?php
session_start();
session_name("loginUsuario");

include_once('clases/db/config.php');
include_once('clases/_acceso.php');

if (isset($_GET["lg"])){
        $_SESSION["lang"] = $_GET["lg"];
    }else{
       if (!isset($_SESSION["lang"])){ 
            $_SESSION["lang"] = _IDIOMA_; 
       }
}

include 'lang/'.$_SESSION["lang"].'.php';
?>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <title>KomanderTPV</title>
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script src="js/jquery.screwdefaultbuttons.js" ></script>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link href="styles/acceso.css" rel="stylesheet" type="text/css">
    
    <script>
    $(document).ready(function(){ 

          $('input:checkbox').screwDefaultButtons({ 
             checked: "url(styles/images/checkbox_Checked.png)",
             unchecked:	"url(styles/images/checkbox_Unchecked.png)",
             width:	 90,
             height:	 94
          });
          
         
    });

    </script>
  </head>

  <body>
  	<div id="page-wrap">
 <?php
    
     $acc = new _acceso();
      echo $acc->panel_acceso();
   
  ?>
	</div>
  </body>

</html>
