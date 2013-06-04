<?php

/**
 * Description of _familias
 *
 * @author luismips
 */
class _familias {
    
    public function panel() {
        $bd=Db::getInstance();  
        
        $html = "";
        $padres = "";
        
    $html .= '<table id="tabla_fam_nueva">
            <tr><td>FAMILIA NUEVA</td>'; 
        $html .= '<td><input class="'.$_SESSION["teclado"].'" type="text" name="nueva" id="nueva"></td>
            <td><div id="bNueva" class="boton" onclick="nueva()">+</div></td></tr></table>';
        
        //------NOMBRES DE FAMILIA
        $ssql = "SELECT * FROM familias ORDER BY nombre ASC";
        $stmt=$bd->ejecutar($ssql); 
       
        $html .= "<table id=\"tabla_familias\">";
        
        
//        $html .= '<tr><td colspan="2"></td></tr>';
        
        if ($stmt !==false && mysql_num_rows($stmt) > 0) {
            
           $html .= '<tr><td colspan="2">NOMBRE</td>'; 
           $html .= '<td><select id="nombre" name="nombre" onchange="infofamilia()">';
           $html .= '<option value=""></option>';//valor en blanco al cargar la pagina
             while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>';  
               $padres .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>'; 
               
            }
            

        }

         $html .= "</select></td></tr>";
        
        //------NOMBRES DE GRUPOS VISORES
        $ssql = "SELECT * FROM grupos_visores ORDER BY nombre ASC";
        $stmt=$bd->ejecutar($ssql); 

      
              
        if ($stmt !==false && mysql_num_rows($stmt) > 0) {

           $html .= '<tr><td colspan="2">GRUPO</td>'; 
           $html .= '<td colspan="2"><select id="grupo">'; 
           $html .= '<option value=""></option>';
           
           while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>';  
                        
            }
            

        }

         $html .= "</select></td></tr>";
         
         
        // SELECCION DEL COLOR
         $html .= '<tr><td colspan="2">COLOR</td>'; 
         $html .= '<td colspan="2"><input id="tcolor" class="color" value=""></td></tr>'; 
         
         
         //SELECCION DE PADRE
         $html .= '<tr><td colspan="2">PADRE</td>'; 
         $html .= '<td colspan="2"><select id="padre">';
          $html .= '<option value=""></option>';
         
         $html .= $padres;
         
         $html .= "</select></td></tr>";
         
                  
         //orden para mostrar en pantalla comanda
         $html .= '<tr><td colspan="2">ORDEN</td>';
         $html .= '<td colspan="2"><input type_"text" id="torden" value="">';
         $html .= '</td><tr>';
         
         
         
         //preferencia en el orden para la cola
         $html .= '<tr><td colspan="2">PREFERENCIA</td>'; 
         $html .= '<td colspan="2"><select id="preferencia">';
          $html .= '<option value="5">5</option>';
          $html .= '<option value="4">4</option>';
          $html .= '<option value="3">3</option>';
          $html .= '<option value="2">2</option>';
          $html .= '<option value="1">1</option>';
          $html .= '<option value="0">0</option>';
         $html .= "</select></td></tr>";
         
         
         //imagen para mostrar 
         $html .= '<tr><td colspan="2">IMAGEN</td>';
         $html .= '<td colspan="2"><input type="text" id="timagen" value="">';
         $html .= '</td><tr>';
         
         
         $html .= '<tr><td><div id="bMod" class="boton" onclick="mod()">OK</div></td>';
         $html .= '<td><div id="bDel" class="boton">BORRAR</div></td>';
         
          $html .= '<td><div id="bVolver" class="boton" onclick="location.href=\'../admin.php\'">VOLVER</div></td></tr>';
         $html .= "</table>"; 

       
        return $html;
    }
    
    public function i_familia($nombre) {
        $bd=Db::getInstance(); 
        
        if (!$this->c_familia($nombre)){
            
           $ssql = "INSERT INTO familias (nombre, id_padre, grupo_impresion, 
            grupo_visor, preferencia, color, imagen, orden, nombre_es,
            nombre_en, nombre_de, nombre_fr) VALUES ('".$nombre."', 
                0, 0, 
                    0, 
                        5, 'FFFFFF', '', 0, 
                        nombre, nombre, nombre, nombre)";
           
          $bd->insertar($ssql); 
            
        }
 }
    
    
    public function c_familia($nombre) {
        $bd=Db::getInstance(); 
        
        $sql = false;
        $ssql = "SELECT id_familia FROM familias WHERE nombre = '".$nombre."'";
        $stmt = $bd->ejecutar($ssql);
               
        if ($stmt !==false && mysql_num_rows($stmt) > 0) {
            $sql = true;                           

        }
        return $sql;
    }
    
    public function g_familia($nombre) {
        $bd=Db::getInstance(); 
        
        $padre = "";
        $visor = "";
        $color = "";
        $orden = "";
        $imagen = "";
        $preferencia = "";
        $nombre_padre ="";
        $nombre_visor = "";
        
        
        //------DATOS DE FAMILIA
        $ssql = "SELECT * FROM familias WHERE nombre = '".$nombre."'";
        $stmt=$bd->ejecutar($ssql); 
         if ($stmt !==false && mysql_num_rows($stmt) > 0) {
             while ($a=$bd->obtener_fila($stmt,0)){
                 $padre = $a["id_padre"];
                 $visor = $a["grupo_visor"];
                 $preferencia = $a["preferencia"];
                 $color = $a["color"];
                 $orden = $a["orden"];
                 $imagen = $a["imagen"];
             }
         }
         
         
        if ($padre == ""){
            $nombre_padre = "";
        } else {
            $ssql = "SELECT nombre FROM familias WHERE id_familia = ".$padre;
            $stmt=$bd->ejecutar($ssql);
            if ($stmt !==false && mysql_num_rows($stmt) > 0) {
                 while ($a=$bd->obtener_fila($stmt,0)){
                     $nombre_padre = $a["nombre"];

                 }
             }
        }
        
         
         $ssql = "SELECT nombre FROM grupos_visores WHERE id_grupo = ".$visor;
        $stmt=$bd->ejecutar($ssql);
        if ($stmt !==false && mysql_num_rows($stmt) > 0) {
              while ($a=$bd->obtener_fila($stmt,0)){
                 $nombre_visor = $a["nombre"];
                 
             }
         }
        
        $html = "";
        $padres = "";
        
        
        $html .= '<table id="tabla_fam_nueva">
            <tr><td>FAMILIA NUEVA</td>'; 
        $html .= '<td><input class="'.$_SESSION["teclado"].'" type="text" name="nueva" id="nueva"></td>
            <td><div id="bNueva" class="boton" onclick="nueva()">+</div></td></tr></table>';
        
        //------NOMBRES DE FAMILIA
        $ssql = "SELECT * FROM familias ORDER BY nombre ASC";
         $stmt=$bd->ejecutar($ssql);
       
        $html .= "<table id=\"tabla_familias\">";
        
        if ($stmt !==false && mysql_num_rows($stmt) > 0) {
            
           $html .= '<tr><td colspan="2">NOMBRE</td>'; 
           $html .= '<td colspan="2"><select id="nombre" name="nombre" onchange="infofamilia()">';
           $html .= '<option value="'.$nombre.'">'.$nombre.'</option>';//valor en blanco al cargar la pagina
            while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>';  
               $padres .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>'; 
               
            }
            

        }

         $html .= "</select></td></tr>";
        
        //------NOMBRES DE GRUPOS VISORES
        $ssql = "SELECT * FROM grupos_visores ORDER BY nombre ASC";
        $stmt=$bd->ejecutar($ssql);

        if ($stmt !==false && mysql_num_rows($stmt) > 0) {

           $html .= '<tr><td colspan="2">GRUPO</td>'; 
           $html .= '<td colspan="2"><select id="grupo">'; 
            $html .= '<option value="'.$nombre_visor.'">'.$nombre_visor.'</option>';
            while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>';  
                        
            }
            

        }

         $html .= "</select></td></tr>";
         
         
        // SELECCION DEL COLOR
         $html .= '<tr><td colspan="2">COLOR</td>'; 
         $html .= '<td colspan="2"><input id="tcolor" class="color" value="'.$color.'"></td></tr>'; 
         
         
         //SELECCION DE PADRE
         $html .= '<tr><td colspan="2">PADRE</td>'; 
         $html .= '<td colspan="2"><select id="padre">';
          $html .= '<option value="'.$nombre_padre.'">'.$nombre_padre.'</option>';
          $html .= '<option value=""></option>';
         
         $html .= $padres;
         
         $html .= "</select></td></tr>";
         
              
         //orden para mostrar en pantalla comanda
         $html .= '<tr><td colspan="2">ORDEN</td>';
         $html .= '<td colspan="2"><input type_"text" id="torden" value="'.$orden.'">';
         $html .= '</td><tr>';
         
         //preferencia en el orden para la cola
         $html .= '<tr><td colspan="2">PREFERENCIA</td>'; 
         $html .= '<td colspan="2"><select id="preferencia">';
         $html .= '<option value="'.$preferencia.'">'.$preferencia.'</option>';
          $html .= '<option value="5">5</option>';
          $html .= '<option value="4">4</option>';
          $html .= '<option value="3">3</option>';
          $html .= '<option value="2">2</option>';
          $html .= '<option value="1">1</option>';
          $html .= '<option value="0">0</option>';
         $html .= "</select></td></tr>";
         
          //imagen para mostrar 
         $html .= '<tr><td>IMAGEN</td><td id="td_img"><img src="http://'._DOMAIN_.'/'._APP_FOLDER_.'/'._IMAGES_PATH_.'/wkomander/familias/'.$imagen.'" /></td>';
         $html .= '<td colspan="2"><input type="text" id="timagen" value="'.$imagen.'">';
         $html .= '</td><tr>';
         
        
         
         $html .= '<tr><td><div id="bMod" class="boton" onclick="mod()">OK</div></td>';
         $html .= '<td><div id="bDel" class="boton" onclick="del()">BORRAR</div></td>';
         
         $html .= '<td><div id="bVolver" class="boton" onclick="location.href=\'../admin.php\'">VOLVER</div></td></tr>';
         $html .= "</table>"; 

       
        return $html;
    }
    
    public function m_familia($nombre, $padre, $visor, $preferencia, $color, $orden, $imagen) {
        $bd=Db::getInstance();
        
        $id_visor = "";
        $id_padre = "";
        
       
        if ($padre == ""){
            $id_padre = "0";
        }else{
           $ssql = "SELECT id_familia FROM familias WHERE nombre = '".$padre."'";
           $stmt = $bd->ejecutar($ssql);
            if ($stmt !==false && mysql_num_rows($stmt) > 0) {
                  while ($a=$bd->obtener_fila($stmt,0)){
                     $id_padre = $a["id_familia"];

                 }
             }  
        }
        
        
         
         $ssql = "SELECT id_grupo FROM grupos_visores WHERE nombre = '".$visor."'";
        $stmt = $bd->ejecutar($ssql);
        if ($stmt !==false && mysql_num_rows($stmt) > 0) {
              while ($a=$bd->obtener_fila($stmt,0)){
                 $id_visor = $a["id_grupo"];
                 
             }
         }
        
       
            
           $ssql = "UPDATE familias SET id_padre = ".$id_padre.", 
               grupo_visor = ".$id_visor.", 
               preferencia = ".$preferencia.", 
               color = '".$color."', orden = ".$orden.", imagen = '".$imagen."'  
                           WHERE nombre = '".$nombre."'";
           $bd->actualizar($ssql);
           
 }
    
 public function d_familia($nombre) {
        $bd=Db::getInstance();
        
        $id_familia = "";
        $sql = "";
        
        //obtiene id_familia
        $ssql = "SELECT id_familia FROM familias WHERE nombre = '".$nombre."'";
        $stmt = $bd->ejecutar($ssql);
        if ($stmt !==false && mysql_num_rows($stmt) > 0) {
              while ($a=$bd->obtener_fila($stmt,0)){
               
                 $id_familia = $a["id_familia"];
                 
                 //comprueba que no hay subfamilias
                 $check = "SELECT * FROM familias WHERE id_padre = ".$id_familia;
                 $stmt2 = $bd->ejecutar($check);
                 
                 //comprueba que no hay articulos
                 $check2 = "SELECT * FROM articulos WHERE id_familia = ".$id_familia;
                 $stmt3 = $bd->ejecutar($check2);
                 
                 if (($stmt2 !==false && mysql_num_rows($stmt2) > 0) || ($stmt3 !==false && mysql_num_rows($stmt3) > 0)) {
                     $sql = "EXISTEN FAMILIAS O ARTICULOS BAJO ESA FAMILIA.";
                 }else{//BORRA FAMILIA
                     $del = "DELETE FROM familias WHERE id_familia = ".$id_familia;
                    $bd->borrar($del);
                     
                     $sql = "FAMILIA ELIMINADA";
                 }
                 
             }                        

        }

        return $sql;
    }
}

?>
