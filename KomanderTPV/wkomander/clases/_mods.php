<?php

/**
 * Description of _mods
 *
 * @author luismips
 */
class _mods {
   
    public function g_mods($grupomods, $id_articulo) {
              
       $bd=Db::getInstance();
      
        $ssql = "SELECT grupos_modificadores.id_grupo, grupos_modificadores.nombre_".$_SESSION["lang"]." AS nombre FROM arts_grupomods 
            INNER JOIN grupos_modificadores ON 
            grupos_modificadores.id_grupo = arts_grupomods.id_grupo 
            WHERE arts_grupomods.id_art = ".$id_articulo;
     
      
        $rs = $bd->ejecutar($ssql);

        $sql = "<div id=\"mods\">";
        $panel_grupos = "<div id=\"panel_grupos\">";

        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
             while ( $a = $bd->obtener_fila($rs,0)){

               $panel_grupos .= "<div class=\"grupo_mods\">".stripslashes($a['nombre'])."</div>";                        

                if ($grupomods==""){
                    $ssql2 = "SELECT modificadores.id_modificador, modificadores.nombre_".$_SESSION["lang"]." AS nombre FROM relacion_modificadores 
                    INNER JOIN modificadores ON
                    relacion_modificadores.id_mod = modificadores.id_modificador
                    WHERE relacion_modificadores.id_grupo = ".stripslashes($a['id_grupo']);
                }
                else{
                    $ssql2 = "SELECT modificadores.id_modificador, modificadores.nombre_".$_SESSION["lang"]." AS nombre  FROM relacion_modificadores 
                    INNER JOIN modificadores ON
                    relacion_modificadores.id_mod = modificadores.id_modificador
                    INNER JOIN grupos_modificadores ON grupos_modificadores.id_grupo = relacion_modificadores.id_grupo
                    WHERE relacion_modificadores.id_grupo = ".stripslashes($a['id_grupo'])." AND 
                        grupos_modificadores.id_grupo = '".stripslashes($a['id_grupo'])."'";
                }
                $rs2 = $bd->ejecutar($ssql2);

                if ( $rs2 !== false && mysql_num_rows($rs2) > 0 ) {

                    while ( $b = $bd->obtener_fila($rs2,0)){
                      $sql .= "<div class=\"mod\" onclick=check_mods(".stripslashes($b['id_modificador']).")>".stripslashes($b['nombre'])."</div>"; 
                    }

                }
                
            }
            $sql .= "</div>";
            $panel_grupos .= "</div>";

        }
        
        return $panel_grupos.$sql;
    }
  
}

?>
