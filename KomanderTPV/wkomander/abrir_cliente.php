<?php
require_once('seguridad.php');
header('Content-type: text/html; charset=iso-8859-1');

  require 'clases/includes.php';
  include_once('clases/conexion.php');
  include_once('clases/_i_historial.php');
  require_once("../pdf/dompdf/dompdf_config.inc.php");
  
  $bd=Db::getInstance(); 
  
  $datos = new conexion();

  $pass = $datos->rand_string(4);

    //borra claves acceso de la mesa por si ya las tenia
    //OJO... NO ACTIVAR EN LA DEMO
//   $delclave = "DELETE FROM cliente_mesa 
//       WHERE id_mesa = (SELECT id_punto FROM puntos WHERE nombre ='".$_GET['mesa']."') 
//           AND comensal ='".$_GET['comensal']."'";
//   $bd->borrar($delclave);
           
    
  
    $ssql ="INSERT INTO cliente_mesa (id_mesa, nick, pass, comensal, usuario) VALUES
        ((SELECT id_punto FROM puntos WHERE nombre = '".$_SESSION['mesa']."'), '', 
        '".$pass."', '".$_SESSION['comensal']."', '".$_SESSION['usuario']."')";

    $hist = new _i_historial();

if (!$hist->c_ocupado($_SESSION['mesa'])){
    $hist->nuevo_historial($_SESSION['mesa'], $_SESSION['comensal']);
    $hist->ocupar_mesa($_SESSION['mesa']);
}

   $bd->insertar($ssql);

     $principio= "<html><style media=\"all\">

            @page {
                    margin-top: -40px;
                    margin-left: 0px;
                    margin-right: 0px;

                  }
                body { font: 10px helvetica, sans-serif, verdana, arial ;
                    padding: 0; 
                    margin: 0;
                 }  

                </style><body>";
   $fin = "</body></html>";

  
   $contrasena = $pass;

 

   $ssql = "SELECT empresa.razon, empresa.domicilio, empresa.localidad, 
empresa.provincia, empresa.tlf FROM empresa WHERE id_empresa = 
(SELECT valor FROM vars WHERE variable = 'empresa')";

$rs =$bd->ejecutar($ssql);

$html ='<table style="width:210px;font: 11px helvetica;">';

if ($rs !== false && mysql_num_rows($rs) > 0) {
        while ( $a = $bd->obtener_fila($rs,0)){

            $html .= '<tr><td align="center"><h3>'.$a["razon"].'</h3></td></tr>';
            $html .= '<tr style="height: 5px;"><td align="center">'.$a["domicilio"].'</td></tr>';
            $html .= '<tr style="height: 5px;"><td align="center">'.$a["localidad"].', '.$a["provincia"].'</td></tr>';
            $html .= '<tr style="height: 5px;"><td align="center">'.$a["tlf"].'</td></tr>';
        }
}

$html .="</td></tr></table>";



   $html .= '<table style="width:210px;font: 10px helvetica;">';
   $html .= "<tr><td colspan=\"2\"><hr></td></tr>";
   $html .= "<tr><td colspan=\"2\"> 1. - Acceda la red WiFi:</td></tr>";
   $html .= "<tr><td align=\"right\">SSID:</td><td align=\"left\">"._NOMBRE_WIFI_."</td></tr>";
   $html .= "<tr><td align=\"right\">CLAVE:</td><td align=\"left\">"._CLAVE_WIFI_."</td></tr>";
   $html .= "<tr><td colspan=\"2\"><font face=\"helvetica\">2. - Entrar a la siguiente direccion:</font></td></tr>";
   $html .= "<tr><td colspan=\"2\" align=\"center\">"._WEB_CLIENTE_."</td></tr>"; 
//       $html .= "<tr><td colspan=\"2\"><font face=\"helvetica\">3. - CLAVE A:</font></td></tr>";

   $html .= "<tr><td colspan=\"2\"><hr></td></tr>";
   $html .= "<tr><td align=\"right\">CLAVE:</td><td align=\"center\">".$contrasena."</td></tr>";
   $html .= "<tr><td colspan=\"2\"></td></tr>";
   $html .= "</table>";




   $dompdf = new DOMPDF(); 

   $dompdf->load_html($principio.$html.$fin); 
   $dompdf->render();

   $stamp =  $_SESSION["usuario"].date("His");

   file_put_contents('c:\abre'.$stamp.'.pdf', $dompdf->output()); 


    $cmd = _GSPRINT_ . ' -printer "tiket" "c:\abre'.$stamp.'.pdf"';
    exec($cmd);

    $cmd = 'del c:\abre'.$stamp.'.pdf';
    exec($cmd);

    header("Location: comanda.php");
?>
