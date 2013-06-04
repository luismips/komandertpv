<?php

/**
 * Description of articulos
 *
 * @author luismips
 */
// require  'includes.php';

class _articulos {
    
    public function g_familias($padre) {
       
        $bd=Db::getInstance(); 
        $ruta_comanda = "";
               
        $ssql = "SELECT nombre_".$_SESSION["lang"]." AS nombre, id_familia, color, imagen FROM familias 
            WHERE id_padre =  " . $padre . " ORDER BY orden ASC";


       $stmt=$bd->ejecutar($ssql); 


        $sql = "";
       
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            while ($a=$bd->obtener_fila($stmt,0)){
               if ($a["imagen"] != ""){
                 $sql .= "<div class=\"familia\" style=\"background-image: url('http://".$_SERVER['SERVER_NAME']."/"._APP_FOLDER_."/images/wkomander/familias/".$a["imagen"]."');background-repeat: no-repeat;background-size: 100% 100%;\" onclick=g_familias_comanda(".($a['id_familia']).")>".stripslashes($a['nombre'])."</div>";  
               }else{ 
                $sql .= "<div class=\"familia\" style=\"background:#".$a['color']."\" onclick=g_familias_comanda(".($a['id_familia']).")>".stripslashes($a['nombre'])."</div>";
               }
            }
            

        }

        return $sql;
    }
    
   
    
     public function g_padre($id_familia) {

        $bd=Db::getInstance();  
        
        $ssql = "SELECT id_padre FROM familias WHERE id_familia = ".$id_familia;

        $stmt=$bd->ejecutar($ssql); 
    
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            while ($a=$bd->obtener_fila($stmt,0)){
                
                $sql = $a['id_padre']; 
                
            }
         }else{
            $sql = "0";
        }

        return $sql;
    }
    
   public function g_articulos($padre) {
         
        include_once('conexion.php');
        $c = new conexion();
        $ruta_comanda = "";
        $bd=Db::getInstance(); 
        
        $ssql = "SELECT articulos.en_stock, articulos.color, articulos.imagen, 
            articulos.familia_hija, articulos.id_articulo,articulos.pvp, 
            articulos.nombre_".$_SESSION["lang"]." as nombre 
                FROM articulos INNER JOIN familias ON
                articulos.id_familia = familias.id_familia
                WHERE familias.id_familia = '" . $padre . "' 
                    ORDER BY articulos.orden ASC";
             
        $stmt=$bd->ejecutar($ssql);

        $sql = "";

         if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            while ($a=$bd->obtener_fila($stmt,0)){
                
                if ($this->c_mods($a['id_articulo'])){
                    $mods = "S";
                }else{
                    $mods = "N";
                }
                
                
                
                $nombre_precio ='<table style="width:100%;  border: none; -webkit-border-radius: 20px;-moz-border-radius: 20px;	border-radius: 20px;">
                    <tr style="height:110px;"><td style="height:90px; text-align:center; vertical-align: top;"><p>'.stripslashes($a['nombre']).'</p></td></tr>
                        <tr style="height:20px;"><td style="vertical-align: bottom;"><p class="pvp">'.$c->knumber(stripslashes($a['pvp'])).' '._MONEDA_.'</p></td>
                            </tr></table>';
                
                if ($a['en_stock'] == "1"){
                     if ($a["imagen"] != ""){
                          $sql .= '<div id="articulo" style="background-image: url(\'http://'.$_SERVER['SERVER_NAME'].'/'._APP_FOLDER_.'/images/wkomander/articulos/'.$a["imagen"].'\');background-repeat: no-repeat;background-size: 100% 100%;" onclick=i_historial("'.$mods.'","'.str_replace(" ", "%20", $a['nombre']).'",'.$a['id_articulo'].') >'.$nombre_precio.'</div>';
                                             
                        }else{
                         $sql .= '<div id="articulo" style="background:#'.$a['color'].'" onclick=i_historial("'.$mods.'","'.str_replace(" ", "%20", $a['nombre']).'",'.$a['id_articulo'].') >'.$nombre_precio.'</div>';
                     
                     }
                    
                }else{
                     if ($a["imagen"] != ""){
                         $sql .= '<div id="articulo" style="background-image: url(\'http://'.$_SERVER['SERVER_NAME'].'/'._APP_FOLDER_.'/images/wkomander/articulos/'.$a["imagen"].'\');background-repeat: no-repeat;background-size: 100% 100%;" onclick=sin_stock("'.str_replace(" ", "%20", $a['nombre']).'")>'.$nombre_precio.'</div>';
                                   
                        }else{
                    $sql .= '<div id="articulo" style="background:#'.$a['color'].'" onclick=sin_stock("'.str_replace(" ", "%20", $a['nombre']).'")>'.$nombre_precio.'</div>';
                
                     }
                }


             }
         
        }
        
      

        return $sql;
    }
    
   public function c_mods($idarticulo) {
        $bd=Db::getInstance();
        
       $ssql = "SELECT arts_grupomods.id_grupo FROM arts_grupomods
           INNER JOIN articulos ON arts_grupomods.id_art = articulos.id_articulo
            WHERE articulos.id_articulo = ". $idarticulo;
 

        $stmt=$bd->ejecutar($ssql); 

        $sql = false;
        

        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
           
                    $sql = true;
              
        }
      
        return $sql;
    }
    
    
    public function resta_stock($idarticulo, $uds) {
        $bd=Db::getInstance();  
        
        $ssql = "UPDATE articulos SET uds_stock = uds_stock - ".$uds." 
            WHERE id_articulo = ".$idarticulo;
        
        $bd->actualizar($ssql);

    }
    
    public function suma_stock($idarticulo, $uds) {
        $bd=Db::getInstance(); 
        
        $ssql = "UPDATE articulos SET uds_stock = uds_stock + ".$uds." 
            WHERE id_articulo = ".$idarticulo;
        
        $bd->actualizar($ssql);

    }
}

?>
