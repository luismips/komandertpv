<?php
session_start();
session_name("loginUsuario");

if ($_SESSION["nivel"] != "administrador") {
    header("Location: usuarios.php");
}

?>
<html>

  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/admin.css" />
       
    <script type="text/javascript" src="js/jquery-1.7.1.js">
    </script>
  </head>
  
 <?php
 echo '<script type="text/javascript">
              
        function salir(){
            
                location.href="salir.php";
        }
        
        function conf_forzar(){
            if (confirm("Seguro que desea forzar el reinicio de las mesas?")){
                location.href="cierracaja.php?forzar=S";
            }
        }
        
       
       
</script>'; 
 
 ?>
 
  
  <body>
      <div id="container_admin">
          <p>CONFIGURACION<p>
          <ul >
              <li onclick="location.href='caja.php'">CAJA</li>
              <li onclick="location.href='admin/articulos.php'">ARTICULOS</li>
              <li onclick="location.href='admin/familias.php'">FAMILIAS</li>
              <li onclick="location.href='admin/modificadores.php'">MODIFICADORES</li>
              <li onclick="location.href='admin/posicion_mesas.php'">POSICION MESAS</li>
          </ul>
          
          <p>INFORMES</p>
          <ul>
              <li onclick="location.href='informes/mesasabiertas.php'">MESAS ABIERTAS</li>
              <li onclick="location.href='informes/ventaarticulos.php'">VENTAS</li>
              <li onclick="location.href='informes/meseros.php'">CAMAREROS</li>
              <li onclick="location.href='informes/stock.php'">STOCK</li>
              <li onclick="location.href='cajas.php'">CAJAS CERRADAS</li>
          </ul>
          
          <p>VOLVER</p>
          <ul>
              <li onclick="location.href='mesas.php'">TOMAR COMANDAS</li>
              <li onclick="location.href='usuarios.php'">PANTALLA USUARIOS</li>
              <li onclick="location.href='salir.php'">CERRAR SISTEMA</li>
          </ul>
          <br/>
          <p>UTILIDADES</p>
          <ul>
              <li onclick="conf_forzar()">FORZAR REINICIO</li>
          </ul>
         
      </div>
      
      
<?php


?>

  </body>
</html>

