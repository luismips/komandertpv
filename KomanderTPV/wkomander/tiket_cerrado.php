<?php
session_start();
session_name("loginUsuario");
header('Content-type: text/html; charset=UTF-8');
require 'clases/includes.php';  
require_once("../pdf/dompdf/dompdf_config.inc.php"); 
include_once('clases/_i_historial.php');

$bd=Db::getInstance(); 

$his = new _i_historial();

$historial = $_GET["idhist"];
$nombre_zona = "";
$datos_cli = "";

$html =  '<html>';
$html .= '  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/tiket_cerrado.css" />
       
    <script type="text/javascript" src="js/jquery-1.7.1.js">
    </script>
  </head>';

$html .= 
  '<body><div id="page-wrap"><div id="bVolver" class="boton_izq" onclick="javascript:history.back()">VOLVER</div>
      <table id="tabla_tiket">
      '; 
  
  $ssql2 = "SELECT SUM(historial_puntos_descr.cantidad) AS cantidad, SUM(historial_puntos_descr.pvp) AS pvp, historial_puntos_descr.articulo, historial_puntos_descr.mods, historial_puntos.propina, historial_puntos.descuento FROM historial_puntos_descr INNER JOIN historial_puntos 
                ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
                WHERE historial_puntos.id_hist = ".$historial."  AND 
                     historial_puntos_descr.anulado = 'N' GROUP BY historial_puntos_descr.articulo ORDER BY historial_puntos_descr.id_hist_descr DESC";

  $rs2 = $bd->ejecutar($ssql2);

        $sql = "";
        $info = "";
        
        if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {
    
          
           
           if ($nombre_zona == "REPARTO"){
               $html .= $datoscli;
           }else{
           
                $html .="<tr><table id=\"tabla_datos_hist\">";
                $html .= "<tr><td>TIKET:</td><td>".$historial."</td></tr>";
//                $html .= "<tr><td>MESA:</td><td>".$mesa."</td></tr>";
//                $html .= "<tr><td>COMENSAL:</td><td>".$comensal."</td></tr>";
                $html .= "</tr></table><hr>";
           }
           
           $html .= "<tr><td><table id=\"tabla_comanda\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";
           $html .= '<thead>
		<tr>
			<th scope="col">UDS</th>
			<th scope="col" align="left">ARTICULO</th>
			<th scope="col">SUMA</th>
		</tr>
	 </thead>';
           
           $suma = 0.00;
           $total = 0.00;
           $avg_propina = 0.00;
           $avg_descuento = 0.00;
           $propina = 0.00;
           $descuento = 0.00;
           
            while ( $a = $bd->obtener_fila($rs2,0)){
                
                $html .= "<tr onclick=alert('ok')><td style=\"width: 20px; text-align:right; padding-right: 5px;\">".preg_replace('/^(\d+)\.0+$/', '$1',$a['cantidad'])."</td>";
                $html .= "<td>".stripslashes($a['articulo'])."</td>";//.stripslashes($a['mods'])."</td>";
                $html .= "<td align=\"right\">".(_DECIMALES_=="S"?number_format($a['pvp'], 2, ',', '.'):number_format($a['pvp'], 0, ',', '.'))."</td></tr>";
                $suma = $suma + (stripslashes($a['pvp']));
               $avg_propina = $a['propina'];
               $avg_descuento = $a['descuento'];
            }
            
            $propina = ($suma * $avg_propina)/100;
            $descuento = ($suma * $avg_descuento)/100;
            
            
            $total = $suma + (($suma * $avg_propina)/100) - (($suma * $avg_descuento)/100);
            
            $html .= '</table><hr>';
            $html .= '<table width="100%">';
            $html .= '<tr><td>PROPINA: '.number_format($avg_propina, 0, ',', '.').'%</td><td align="right">'.(_DECIMALES_=="S"?number_format($propina, 2, ',', '.'):number_format($propina, 0, ',', '.')).'</td></tr>';
            $html .= '<tr><td>DESCUENTO: '.number_format($avg_descuento, 0, ',', '.').'%</td><td align="right">'.(_DECIMALES_=="S"?number_format($descuento, 2, ',', '.'):number_format($descuento, 0, ',', '.')).'</td></tr><hr>';
            $html .= '<tr><td>TOTAL:</td><td align="right">'.(_DECIMALES_=="S"?number_format($total, 2, ',', '.'):number_format($total, 0, ',', '.')).' <small>'._MONEDA_.'</small>';
            
//            $html .= '<tr><td colspan="2" align="center">GRACIAS POR SU VISITA</td></tr></table></td></tr>';
           
            

        }
 
$html .= 
  '</table></div></body></html>';

echo $html;
?>  