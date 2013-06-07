<?php
include ("seguridad.php");
header('Content-type: text/html; charset=iso-8859-1');
require 'clases/includes.php';
require_once("../pdf/dompdf/dompdf_config.inc.php"); 
include_once('clases/_comanda.php');
include_once('clases/conexion.php');
include_once('clases/_i_historial.php');
include 'lang/'.$_SESSION["lang"].'.php';
$bd=Db::getInstance();
$datos = new conexion();
$com = new _comanda();

$his = new _i_historial();

$mesa = $_SESSION["mesa"];
$nombre_zona = "";
$datos_cli = "";

$fecha = date("Y-n-j");
$hora = date("H:i");

//SI LA MESA ES REPARTO OBTENER LOS DATOS
$ssql_rep = "SELECT zonas.nombre FROM puntos INNER JOIN zonas ON 
    puntos.zona = zonas.id_zona WHERE puntos.nombre = '".$mesa."'";

$rs_rep = $bd->ejecutar($ssql_rep);
if ($rs_rep !== false && mysql_num_rows($rs_rep) > 0) {
            while ( $rep = $bd->obtener_fila($rs_rep,0)){
                if ($rep["nombre"]=="REPARTO"){
                    $nombre_zona = "REPARTO";
                    $ssql_cli = "SELECT clientes.nombre, clientes.direccion, clientes.tlf FROM puntos INNER JOIN clientes ON 
                        puntos.nombre = clientes.tlf WHERE puntos.nombre = '".$mesa."'";

                    $rs_cli = $bd->ejecutar($ssql_cli);
                    if ($rs_cli !== false && mysql_num_rows($rs_cli) > 0) {
                            while ( $cli = $bd->obtener_fila($rs_cli,0)){
                                $datoscli .="<tr><td><table>";
                                $datoscli .= "<tr><td>".TIKET.":</td><td>".$historial."</td></tr>";
                                $datoscli .= "<tr><td>".NOMBRE.":</td><td>".$cli["nombre"]."</td></tr>";
                                $datoscli .= "<tr><td>".DIRECCION.":</td><td>".$cli["direccion"]."</td></tr>";
                                $datoscli .= "<tr><td>".TELEFONO.":</td><td>".$cli["tlf"]."</td></tr>";
                                $datoscli .= "</td></tr></table><hr>";
                            }
                            
                     }
                    
                }
               
                
            }
            
           
 }



$html = 
  '<head></head><style media="all">
		
                @page {
                        margin-top: -20px;
                        margin-left: 0px;
                        margin-right: 0px;
                        
                      }

                body { font: 9px sans-serif,verdana, arial, helvetica;
                        padding: 0; 
                        margin: 0;
                     }
</style> <html><body><table style="width:190px; margin: 5px 10px 5px 5px;"><tr><td>
      '; 
  

//encabezado tiket
$ssql = "SELECT empresa.razon, empresa.domicilio, empresa.localidad, 
    empresa.provincia, empresa.tlf FROM empresa WHERE id_empresa = ". _EMPRESA_;

$rs = $bd->ejecutar($ssql);

 $html .="<table width=\"100%\">";

if ($rs !== false && mysql_num_rows($rs) > 0) {
            while ( $a = $bd->obtener_fila($rs,0)){
                
                $html .= '<tr><td align="center"><h3>'.$a["razon"].'</h3></td></tr>';
                $html .= '<tr style="height: 5px;"><td align="center">'.$a["domicilio"].'</td></tr>';
                $html .= '<tr style="height: 5px;"><td align="center">'.$a["localidad"].', '.$a["provincia"].'</td></tr>';
                $html .= '<tr style="height: 5px;"><td align="center">'.$a["tlf"].'</td></tr>';
            }
           
 }
 
  $html .="</td></tr></table><hr>";

  
  $ssql2 = "SELECT SUM(historial_puntos_descr.cantidad) AS cantidad, 
      SUM(historial_puntos_descr.pvp) AS pvp,
      articulos.nombre_".$_SESSION["lang"]." AS articulo,
      historial_puntos_descr.mods, historial_puntos.propina, 
      historial_puntos.descuento FROM historial_puntos_descr 
      INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
      INNER JOIN articulos ON historial_puntos_descr.idarticulo = articulos.id_articulo
      
        WHERE historial_puntos.punto = '".$mesa."' AND historial_puntos.cobrada= 'N' 
                    AND historial_puntos.anulado = 'N' AND 
                    historial_puntos_descr.anulado = 'N' GROUP BY historial_puntos_descr.articulo ORDER BY historial_puntos_descr.id_hist_descr DESC";

  $rs2 = $bd->ejecutar($ssql2);

        $sql = "";
        $info = "";
        
        if ( $rs2 !== false && mysql_num_rows($rs) > 0 ) {
    
          
           
           if ($nombre_zona == "REPARTO"){
               $html .= $datoscli;
           }else{
           
                $html .="<tr><td><table id=\"tabla_datos_hist\">";
//                $html .= "<tr><td>TIKET:</td><td>".$historial."</td></tr>";
                $html .= "<tr><td>".MESA.":</td><td>".$mesa."</td></tr>";
                $html .= "<tr><td>".FECHA.":</td><td>".$fecha." ".$hora."</td></tr>";
//                $html .= "<tr><td>COMENSAL:</td><td>".$comensal."</td></tr>";
                $html .= "</td></tr></table><hr>";
           }
           
           $html .= "<tr><td><table id=\"tabla_comanda\" align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">";
           $html .= '<thead>
		<tr>
			<th scope="col">'.UDS.'</th>
			<th scope="col" align="left">'.ARTICULO.'</th>
			<th scope="col">'.SUMA.'</th>
		</tr>
	 </thead>';
           
           $suma = 0.00;
           $total = 0.00;
           $avg_propina = 0.00;
           $avg_descuento = 0.00;
           $propina = 0.00;
           $descuento = 0.00;
           
            while ( $a = $bd->obtener_fila($rs2,0)){
                
           
                //comprobar si es reparto para mostrarlo y sumarlo
              if ($com->hay0($historial)){
                  $html .= '<tr>
                            
                            <td style="width: 20px; text-align:right; padding-right: 5px;">1</td>
                            <td>'.REPARTO.'</td>
                            <td style="text-align:right;">'.$datos->knumber(_PRECIO_REPARTO_).'</td>
                    </tr>';
                  
                  $suma = $suma + _PRECIO_REPARTO_;
              }
                
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
            
            $html .= '</td></tr><tr><td></table><hr>';
            $html .= '<table width="100%">';
		$html .= '<tr><td>'.SUMA.': </td><td align="right">'.(_DECIMALES_=="S"?number_format($suma, 2, ',', '.'):number_format($suma, 0, ',', '.')).'</td></tr>';
            $html .= '<tr><td>'.PROPINA.': '.number_format($avg_propina, 0, ',', '.').'%</td><td align="right">'.(_DECIMALES_=="S"?number_format($propina, 2, ',', '.'):number_format($propina, 0, ',', '.')).'</td></tr>';
            $html .= '<tr><td>'.DESCUENTO.': '.number_format($avg_descuento, 0, ',', '.').'%</td><td align="right">'.(_DECIMALES_=="S"?number_format($descuento, 2, ',', '.'):number_format($descuento, 0, ',', '.')).'</td></tr><hr>';
            $html .= '<tr><td>'.TOTAL.':</td><td align="right">'.(_DECIMALES_=="S"?number_format($total, 2, ',', '.'):number_format($total, 0, ',', '.')).' <small>'._MONEDA_.'</small></td></tr>';
            
            $html .= '<tr><td colspan="2" align="center">'.GRACIAS_VISITA.'</td></tr></table></td></tr>';
           
            

        }


$html .= 
  '</table></body></html>';

$dompdf = new DOMPDF(); 
$dompdf->load_html($html); 
$dompdf->render(); 

//$dompdf->stream("pruebatiket.pdf"); //COMENTAR PARA QUE NO LO GENERE para descargar , 
//SI DESCOMENTA, lo ke hace es enviar el pdf al navegador del cliente y se descarga

$stamp =  $mesa.$_SESSION["usuario"].date("His");


//WIN------------------------------------------------------
file_put_contents('c:\T_'.$stamp.'.pdf', $dompdf->output()); 
$cmd = _GSPRINT_ . ' -printer "tiket" "c:\T_'.$stamp.'.pdf';
//$cmd ="lpr -Slocalhost -Ptiket c:\domprueba.pdf";
exec($cmd);

$cmd = 'del c:\T_'.$stamp.'.pdf';
exec($cmd);
//------------------------------------------------------------

//LINUX------------------------------------------------------
//file_put_contents('/tmp/domprueba.pdf', $dompdf->output()); 
//$cmd ="lpr -P 'tiket' -r '/tmp/luismi2.pdf'";
//exec($cmd);



header("Location: mesas.php?zona=".$_SESSION["zona"]."&tipo=".$_SESSION["tipo_zona"]);
?>  