<?php

/**
 * Description of _pte
 *
 * @author luismips
 */
class _pte {
    
  public function i_cola($mesa) {

       include_once('_articulos.php');
       
       $bd=Db::getInstance(); 
       $arts = new _articulos();
       
       $hora = date("H:i");

       
      $consulta = "SELECT historial_puntos_descr.idarticulo, historial_puntos_descr.usuario, historial_puntos_descr.id_hist_descr, 
               historial_puntos_descr.articulo, historial_puntos_descr.cantidad, 
               historial_puntos_descr.comensal, historial_puntos_descr.mods_lang, 
               historial_puntos_descr.llevar, historial_puntos_descr.observ 
               
               FROM historial_puntos_descr 
               
               INNER JOIN historial_puntos ON historial_puntos.id_hist =
               historial_puntos_descr.id_hist_punto
               
               INNER JOIN articulos ON historial_puntos_descr.idarticulo = articulos.id_articulo
               
               INNER JOIN familias ON articulos.id_familia = familias.id_familia

               WHERE historial_puntos_descr.enviado = 'N' 

               AND historial_puntos.punto = '".$mesa."' AND historial_puntos.cobrada='N' 
                   AND historial_puntos.anulado = 'N'  
                   ORDER BY familias.preferencia ASC
               ";
//       }

$old_comensal = "";
       $idvisor = 0;
       $oldvisor = 0;
       $i = 0;
       $titulo = "";
       
       $principio= "<html><style media=\"all\">
		
                @page {
                        margin-top: -20px;
                        margin-left: 0px;
                        margin-right: 0px;
                        
                      }</style><body>";
       $fin = "</body></html>";
       
      $stmt=$bd->ejecutar($consulta);
      
         if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            while ($a=$bd->obtener_fila($stmt,0)){
                
                $orden = $this->g_orden();
                
                $ssql = "INSERT INTO cola (id_hist_descr, hora_recibo, orden, usuario, 
                 articulo, uds, servido, entregado, anulado, traspaso, punto_anterior, mesa, comensal, 
                 mods, llevar, listo, observ)
                 VALUES
                 (".$a['id_hist_descr'].", '".$hora."',
                 ".$orden.", '".$a['usuario']."', '".$a['idarticulo']."', 
                 ".$a['cantidad'].", 'N', 'N', 'N', 'N', '', '".$mesa."', 
                     '".$a['comensal']."','".$a['mods_lang']."', 
                        '".$a['llevar']."', 'N', '".$a['observ']."' )";
                
                
                $bd->insertar($ssql);
                
                
               
                $idvisor = $this->relacion_visores_cola($a['idarticulo'], $mesa, $a['id_hist_descr']);
                
                if(_IMPRESORAS_=="S"){
                    if($oldvisor!=$idvisor){



                       $oldvisor=$idvisor;
                       $hora = date("H:i");
                       $html[$idvisor] = "<table width=\"250\"><tr><td>HORA:".date("H:i")."</td></tr></table>";
                       $html[$idvisor] .= "<table width=\"250\"><tr><td>MESA: ".$mesa."</td></tr></table>";
    //                             
                    }

				if ($old_comensal != $a["comensal"]){
                        $html[$idvisor] .= "<table width=\"250\"><tr><td>COMENSAL:".$a["comensal"]."</td></tr></table>";
                    }

                    $html[$idvisor] .= "<table width=\"250\"><tr><td>".preg_replace('/^(\d+)\.0+$/', '$1',$a["cantidad"])."  ".$a['articulo']."</td></tr></table>";
                    if ($a["mods"]!=""){
                      $html[$idvisor] .= "<table width=\"250\"><tr><td>-</td><td>".$a['mods']."</td></tr></table>";  
                    }

				$old_comensal = $a["comensal"];
                }
                
                $upd = "UPDATE historial_puntos_descr SET enviado = 'S' 
                    WHERE id_hist_descr = ".$a['id_hist_descr'];
                $bd->actualizar($upd); 
                
                //resta del stock
               $arts->resta_stock($a["idarticulo"], $a["cantidad"]);
            }
            
           
            
         }
         
         if(_IMPRESORAS_=="S"){
            if (isset($html)) {
             foreach ($html as $clave => $valor) {
               $dompdf = new DOMPDF(); 
               $dompdf->load_html($principio.$valor.$fin); 
               $dompdf->render();
               
               $stamp =  $_SESSION["usuario"].date("His");
               
               file_put_contents('c:\dom'.$clave.$stamp.'.pdf', $dompdf->output()); 

               $impresoras = "SELECT nombre FROM impresoras WHERE visor = ".$clave;
               $stmt=$bd->ejecutar($impresoras);
      
             if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($h=$bd->obtener_fila($stmt,0)){
                        $cmd = _GSPRINT_ . ' -printer "'.$h["nombre"].'" "c:\dom'.$clave.$stamp.'.pdf"';
//                        $cmd ="lpr -Slocalhost -P".$d["nombre"]." c:\domprueba".$clave.".pdf";
                        exec($cmd);
                        
//                        $cmd = 'del c:\dom'.$clave.$stamp.'.pdf';
//                        exec($cmd);

                    }
                  
                    
                }
              }
            }
            
         }


        
    }
    

   public function g_orden() {
         $bd=Db::getInstance(); 
//        $hora = date("H:i");
        $sql = "";
        $ssql = "SELECT orden FROM cola ORDER BY orden DESC LIMIT 1";
        
         $stmt=$bd->ejecutar($ssql);
      
             if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
                
                $sql = $a['orden'];
                       
                 }
             }else{
                $sql = 1;
             }
       
        return $sql;
    }
    
    
     public function relacion_visores_cola($idarticulo, $mesa, $id_hist_descr) {
         $bd=Db::getInstance();
           
         $sql = "";

        $ssql = "SELECT visores.clave, grupos_visores.id_grupo, 
        grupos_visores.nombre, relacion_visores.id_visor,
        visores.nombre FROM grupos_visores, relacion_visores INNER JOIN visores ON
        relacion_visores.id_visor=visores.id_visor
        WHERE grupos_visores.id_grupo=
        (SELECT familias.grupo_visor FROM familias 
            INNER JOIN articulos ON familias.id_familia = articulos.id_familia 
            WHERE articulos.id_articulo = '".$idarticulo."') AND 
        relacion_visores.id_grupo= 
        (SELECT familias.grupo_visor FROM familias 
            INNER JOIN articulos ON familias.id_familia = articulos.id_familia 
            WHERE articulos.id_articulo = '".$idarticulo."')
        ";
        
        $ssqlpunto = "SELECT visores.clave, grupos_visores.id_grupo, 
        grupos_visores.nombre, relacion_visores.id_visor,
        visores.nombre FROM grupos_visores, relacion_visores INNER JOIN visores ON
        relacion_visores.id_visor=visores.id_visor
        WHERE grupos_visores.id_grupo=
        (SELECT grupo_visor FROM puntos WHERE nombre = '".$mesa."') AND 
        relacion_visores.id_grupo= (SELECT grupo_visor FROM puntos WHERE nombre = '".$mesa."')";
        
        $idvisor = "";
        
        $stmt=$bd->ejecutar($ssql);
        
          if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($familia=$bd->obtener_fila($stmt,0)){
                
                $stmtpunto=$bd->ejecutar($ssqlpunto);
                
                 if ($stmtpunto !== false && mysql_num_rows($stmtpunto) > 0) {
                    while ($punto=$bd->obtener_fila($stmtpunto,0)){
                       
                        if ($familia['clave'] == $punto['clave']){
                            if ($familia['nombre'] == $punto['nombre']){
                            
                                 $insert = "INSERT INTO relacion_visores_cola 
                                     (id_cola, id_visor) VALUES (
                                     (SELECT id_cola FROM cola WHERE
                                     id_hist_descr = ".$id_hist_descr."),
                                         ".$punto['id_visor'].")";
                                 
                                 $idvisor = $punto['id_visor'];
                                 
                            
                                 
                            
                            }else{
                                
                                $insert = "INSERT INTO relacion_visores_cola 
                                     (id_cola, id_visor) VALUES (
                                     (SELECT id_cola FROM cola WHERE
                                     id_hist_descr = ".$id_hist_descr."),
                                         ".$punto['id_visor'].")";
                                
                                 $idvisor = $punto['id_visor'];
                            }
                            
                           $bd->insertar($insert);
                        }
                        
                    }
                }
           }
         }
       
        return $idvisor;

    }
    

    
}

?>
