<?php

/**
 * Description of _modificadores
 *
 * @author luismips
 */
class _modificadores {
    public function panel() {
        $bd=Db::getInstance();         
        
        $html = '<table id="tabla_nuevo"><tr><td colspan="4">GRUPO NUEVO</td></tr>'; 
        $html .= '<tr><td><input class="'.$_SESSION["teclado"].'"  type="text" name="nuevo_grupo" id="nuevo_grupo"></td>
            <td><div id="bNuevoGrupo" class="boton" onclick="nuevo_grupo()">+</div></td>';
        $html .= '<td><div id="bVolver" class="boton" onclick="location.href=\'../admin.php\'">VOLVER</div></td></tr></table>';
        
        //------NOMBRES DE GRUPOS
        $ssql = "SELECT * FROM grupos_modificadores ORDER BY nombre ASC";
        $stmt=$bd->ejecutar($ssql); 
       
        $html .= "<table id=\"tabla_mods\">";
        
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            
           $html .= '<tr><td colspan="4">NOMBRE GRUPO</td></tr>'; 
           $html .= '<tr><td colspan="2"><select id="nombre_grupo" name="nombre_grupo" onchange="infogrupo()">';
           $html .= '<option value=""></option>';//valor en blanco al cargar la pagina
            while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>';  
               
               
            }
            

        }
        
        $html .= '</select></td></tr>';
                 
         
         $html .= "</table>"; 

       
        return $html;
    }
    
    public function g_grupomods($grupo) {
       $bd=Db::getInstance();  
        $html = "";
        
        
        
        $html .= '<table id="tabla_nuevo"><tr><td colspan="4">GRUPO NUEVO</td></tr>'; 
        $html .= '<tr><td><input class="'.$_SESSION["teclado"].'"  type="text" name="nuevo_grupo" id="nuevo_grupo"></td>
            <td><div id="bNuevoGrupo" class="boton" onclick="nuevo_grupo()">+</div></td>';
        $html .= '<td><div id="bVolver" class="boton" onclick="location.href=\'../admin.php\'">VOLVER</div></td></tr></table>';
        
        //------NOMBRES DE GRUPOS
        $ssql = "SELECT * FROM grupos_modificadores ORDER BY nombre ASC";
        $stmt=$bd->ejecutar($ssql); 
       
        $html .= "<table id=\"tabla_mods\">";
        
        

        
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            
           $html .= '<tr><td colspan="3">NOMBRE GRUPO</td></tr>'; 
           $html .= '<tr><td><select id="nombre_grupo" name="nombre_grupo" onchange="infogrupo()">';
           $html .= '<option value="'.$grupo.'">'.$grupo.'</option>';//valor en blanco al cargar la pagina
            while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>';  
               
               
            }
           $html .= '</select></td><td><div id="bDelGrupo" class="botoncillo" onclick="del()">-</div></td></tr>'; 

        }
        
         
         
         
         
         
       
         
        // NOMBRE Y PRECIO MOD + BOTONES
         $html .= '<tr><td>NOMBRE</td><td>PVP</td><td>DESCRIPCION</td></tr>'; 
         $html .= '<tr><td><input id="nombre_mod" class="'.$_SESSION["teclado"].'"  value=""></td>'; 
        
         $html .= '<td><input id="precio_mod" class="'.$_SESSION["teclado"].'"  value=""></td>';
         
   
         $html .= '<td><input id="descrip_mod" class="'.$_SESSION["teclado"].'"  value=""></td>';
         $html .= '<td><div id="bAddMod" class="botoncillo" onclick="nuevo_mod()">+</div></td></tr>';
         
         
        //tabla con modificadores
         $html .= '<tr><td colspan="4"><table id="detalle_mods">';
         
          $ssql = "SELECT modificadores.id_modificador,modificadores.nombre, modificadores.precio, modificadores.observ 
              FROM modificadores INNER JOIN relacion_modificadores 
              ON modificadores.id_modificador = relacion_modificadores.id_mod 
              INNER JOIN grupos_modificadores ON 
              relacion_modificadores.id_grupo = grupos_modificadores.id_grupo 
              WHERE grupos_modificadores.nombre = '".$grupo."' 
                  ORDER BY modificadores.nombre ASC";
          
        $stmt=$bd->ejecutar($ssql);
       
                
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            
           
             while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<tr>';
               $html .= '<td colspan="2">'.$a["nombre"].'</td>';
               $html .= '<td>'.$a["precio"].'</td>';
               $html .= '<td>'.$a["observ"].'</td>';
               $html .= '<td><div id="bok" class="botoncillo" onclick="del_mod('.$a["id_modificador"].')">-</div></td>';
               $html .= '</tr>';
               
               
               
            }
            

        }
             
         $html .='</table></td></tr>';
         
         
         $html .= "</table>"; 

       
      
        return $html;
    }
    
 public function i_grupo($nombre) {
        $bd=Db::getInstance();  
        
        if (!$this->c_grupo($nombre)){
            
           $ssql = "INSERT INTO grupos_modificadores (nombre, observ, nombre_es, 
               nombre_en, nombre_de, nombre_fr) VALUES ('".$nombre."', 
                '', '".$nombre."', '".$nombre."', '".$nombre."', '".$nombre."')";
           
            $bd->insertar($ssql);
            
        }
   }
    
   public function c_grupo($nombre) {
        $bd=Db::getInstance();  
        $sql = false;
        $ssql = "SELECT * FROM grupos_modificadores WHERE nombre = '".$nombre."'";
        $stmt=$bd->ejecutar($ssql); 
               
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
            $sql = true;                           

        }
        return $sql;
    }
    
    
   public function i_mod($nombre, $precio, $grupo) {
      $bd=Db::getInstance();  
        

            
           $ssql = "INSERT INTO modificadores (nombre, precio, observ, imagen, 
               nombre_es, nombre_en, nombre_de, nombre_fr) VALUES 
               ('".$nombre."', ".$precio.", '".$grupo."', '', 
                  '".$nombre."', '".$nombre."', '".$nombre."', '".$nombre."' )";
           
            $bd->insertar($ssql);
            
            
            $ssql = "INSERT INTO relacion_modificadores (id_grupo, id_mod) VALUES 
               ((SELECT id_grupo FROM grupos_modificadores WHERE nombre = '".$grupo."'), 
                 (SELECT id_modificador FROM modificadores WHERE nombre = '".$nombre."' 
                     AND observ = '".$grupo."'))";//ORDER BY nombre DESC LIMIT 1
           
             $bd->insertar($ssql); 

     
      
    }
    
  public function del_mod($id, $grupo) {
      $bd=Db::getInstance(); 
      
      $del = "DELETE FROM modificadores WHERE id_modificador = ".$id;
      $bd->borrar($del);

     $del = "DELETE FROM relacion_modificadores WHERE id_mod = ".$id. " AND 
         id_grupo = (SELECT id_grupo FROM grupo_modificadores WHERE nombre = '".$grupo."')";
     $bd->borrar($del);
 }
    
 public function d_grupo($nombre) {
        $bd=Db::getInstance();  
        $idgrupo = "";
        
        $ssql = "SELECT id_grupo FROM grupos_modificadores WHERE nombre = '".$nombre."'";
        $stmt=$bd->ejecutar($ssql); 
               
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
               while ($a=$bd->obtener_fila($stmt,0)){
                   $idgrupo = $a['id_grupo'];
               }                      

        }
        
        
        $del = "DELETE FROM arts_grupomods WHERE id_grupo = ".$idgrupo;
        $bd->borrar($del);
        
        $del = "DELETE FROM relacion_modificadores WHERE id_grupo = ".$idgrupo;
        $bd->borrar($del);
        
        $del = "DELETE FROM grupos_modificadores WHERE id_grupo = ".$idgrupo;
        $bd->borrar($del);
        
       
        
    }
    
}

?>
