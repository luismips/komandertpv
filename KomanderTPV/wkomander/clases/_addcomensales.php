<?php

/**
 * Description of _addcomensales
 *
 * @author luismips
 */
class _addcomensales {
    
//    public function g_comensales($mesa) {
//        $bd=Db::getInstance();       
//        
//        $ssql = "SELECT comensal FROM historial_puntos WHERE punto = '".$mesa."' AND
//            cobrada = 'N' AND anulado = 'N'";
//    
//        $stmt=$bd->ejecutar($ssql); 
//
//        $sql = "<div id=\"comensales\">";
//            
//        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
//            while ($a=$bd->obtener_fila($stmt,0)){
//                
//                $sql .= "<div id=\"comensal\"
//                    onclick=\"location.href='comanda.php?padre=0&mesa=".$mesa."&comensal=".$a['comensal']."'\">".$a['comensal']."</div>";
//               
//            }
//            
//        }
//        
//         $sql .= "</div>";
//          
//        
//        return $sql;
//    }
    
    public function add_comensal($mesa, $nombre) {
        
       $hist = new _i_historial();
       
       $hist->nuevo_historial($mesa, $nombre);

        if (!$hist->c_ocupado($mesa)){
            
            $hist->ocupar_mesa($mesa);
        }
    
        
    }
    
   public function g_num_comensales($mesa) {
        $bd=Db::getInstance();
       
        $ssql = "SELECT comensal FROM historial_puntos WHERE punto = '".$mesa."' AND
            cobrada = 'N' AND anulado = 'N'";
    
        $stmt=$bd->ejecutar($ssql); 

        $sql=mysql_num_rows($stmt);
         
      
        return $sql;
    }
    
     public function add_comensales($mesa, $num) {
       
        $hist = new _i_historial();
               
        $total = $this->g_num_comensales($mesa);
        
        
        
        for ($i=0;$i<$num;$i++){
            $total++;
            
            //comprobar ombre de comensal en mesa antes de añadir
            //si ya existe, hacer algo
            if ($this->c_comensal_en_mesa($mesa, $total)){
                $total++;
            }
            
            $hist->nuevo_historial($mesa, $total);
        }
        
        
        //comprobar si la mesa esta libre, si es asi, ocuparla
        $hist->c_ocupado($mesa);
        if (!$hist->c_ocupado($mesa)){
           
            $hist->ocupar_mesa($mesa);
        }
    
        
    }
    
    
   public function c_comensal_en_mesa($mesa, $comensal) {
        $bd=Db::getInstance();      
        
        $ssql = "SELECT comensal FROM historial_puntos WHERE punto = '".$mesa."' AND
        comensal = '".$comensal."' AND cobrada = 'N' AND anulado = 'N'";
    
        $stmt=$bd->ejecutar($ssql);

        $sql = false;
   
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
           $sql = true;
            
        }
        
        return $sql;
    }
}

?>
