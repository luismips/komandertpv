<?php
 session_start();
 session_name("loginUsuario");
 require 'clases/includes.php';
 include 'lang/'.$_SESSION["lang"].'.php';
?>
<html>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/selvisor.css" />
    
   
  </head>

  <body>
  	<div id="page-wrap">
            <div id="selvisor_t"><?php echo SELEC_VISOR ?></div>
<?php
    include_once('clases/_visores.php');
   
    $vis = new _visores();
    echo $vis->g_visores();
?>

       </div>
  </body>

</html>