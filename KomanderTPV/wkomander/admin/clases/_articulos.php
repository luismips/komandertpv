<?php


class _articulos {
    public function listado() {
        
        
	$bd=Db::getInstance();  
        
       
        $html = "";
        $html .= '<table id="tabla_articulos">';
        $html .= '<tr><td>FAMILIA</td></tr>'; 
        
        $ssql = "SELECT * FROM familias ORDER BY nombre ASC";
        $stmt=$bd->ejecutar($ssql);  
        
        $html .= '<tr><td><select id="familia" name="familia" onchange="articulos()">';
        $html .= '<option value=""></option>';//valor en blanco al cargar la pagina
        
        while ($x=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$x['nombre'].'">'.$x['nombre'].'</option>';  
               
            }
     
        
         $html .= '</select></td>';
                 
         $html .= '<td><div id="bVolver" class="boton" onclick="location.href=\'../admin.php\'">VOLVER</div></td></tr>';
         $html .= "</table>"; 

        return $html;
    }
    
    public function g_articulos($familia) {
                
	$bd=Db::getInstance();  

       
        $html = '<table id="tabla_articulos">';
        $html .= '<tr><td>FAMILIA:</td></tr>'; 
        
        $ssql = "SELECT * FROM familias ORDER BY nombre ASC";
        $stmt=$bd->ejecutar($ssql);  
        
        $html .= '<tr><td><select id="familia" name="familia" onchange="articulos()">';
        $html .= '<option value="'.$familia.'">'.$familia.'</option>';//valor en blanco al cargar la pagina
        while ($x=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$x['nombre'].'">'.$x['nombre'].'</option>';  
               
         }
        
        
         $html .= '</select></td><td><div id="bNuevo" class="boton" onclick="nuevo()">+</div></td>';
         $html .= '<td><div id="bVolver" class="boton" onclick="location.href=\'../admin.php\'">VOLVER</div></td></tr>';
         
         
         //LISTADO DE ARTICULOS EN ESA FAMILIA
         $ssql = "SELECT articulos.orden, articulos.id_articulo, articulos.nombre, articulos.pvp, articulos.uds_stock FROM articulos INNER JOIN familias ON 
             familias.id_familia = articulos.id_familia 
             WHERE familias.nombre = '".$familia."' ORDER BY articulos.orden ASC";
         $stmt=$bd->ejecutar($ssql);  
       
        
            
           $html .= '<tr><td colspan="3"><table id="tabla_detalle">';
           $html .= '<tr>
               <td>NOMBRE</td>
               <td>ORDEN</td>
               <td>PVP</td>
               <td>STOCK</td>
               <td>DEL</td>
               <td>MOD</td>
               </tr>';
           
          while ($x=$bd->obtener_fila($stmt,0)){
                $html .= '<tr class="linea_articulo">';
                $html .= '<td>'.$x["nombre"].'</td>';
                $html .= '<td>'.$x["orden"].'</td>';
                $html .= '<td>'.$x["pvp"].'</td>';
                $html .= '<td>'.preg_replace('/^(-?\d+).0+$/', '$1',$x["uds_stock"]).'</td>';
                $html .= '<td><div id="bDel" class="botoncillo" onclick="del_art('.$x["id_articulo"].')"/>-</div></td>';
                $html .= '<td><div id="bMod" class="botoncillo" onclick="mod_art('.$x["id_articulo"].')"/>M</div></td>';
                $html .= '</tr>';
               
           }
           
         $html .= '</td></tr></table>';
         $html .= '</td></tr>';
         $html .= "</table>"; 

     
        return $html;
    }
    
     public function nuevo($familia) {
        $bd=Db::getInstance();  
        
        
        $html = "";
                
        $html .= '<table id="tabla_articulos">';
        
        $html .= '<tr><td>ARTICULO</td><td>FAMILIA</td></tr>';
        
        $html .= '<tr><td><input type="text" id="nombre" value="" class="'.$_SESSION["teclado"].'"/></td>';
        
        //------NOMBRES DE FAMILIAS
        $ssql = "SELECT * FROM familias ORDER BY nombre ASC";
        $stmt=$bd->ejecutar($ssql);  
       
        
            
       $html .= '<td><select id="familia" name="familia">';
       $html .= '<option value="'.$familia.'">'.$familia.'</option>';
        while ($x=$bd->obtener_fila($stmt,0)){

           $html .= '<option value="'.$x['nombre'].'">'.$x['nombre'].'</option>';  

        }
        
        
         $html .= '</select></td>';
         
         //INPUT PARA PVP
         $html .= '<tr><td>PVP</td><td>COLOR</td></tr>'; 
         $html .= '<tr><td><input type="text" id="pvp" value="" class="'.$_SESSION["teclado"].'"/></td><td><input id="tcolor" class="color" value=""/></td></tr>';
         
            
         //TARIFA Y STOCK
         $html .= '<td>TARIFA';
         $html .= '<input type="checkbox" id="tarifa" value="TARIFA" checked/></td>';
         $html .= '<td>STOCK';
         $html .= '<input type="checkbox" id="stock" value="STOCK" checked/></td></tr>';
         
         //BOTON OK Y VOLVER
         $html .= '<tr><td><div id="bAdd" class="boton" onclick="i_articulo()">+</div></td></tr>';
        
         $html .= "</table>"; 
      
        return $html;
    }
    
    
 public function i_articulo($nombre, $familia, $pvp, $tarifa, $stock, $color) {
     $bd=Db::getInstance();  
       
     if (!$this->c_articulo($nombre)){
            
           $ssql = "INSERT INTO articulos (nombre, cod_rapido, abreviatura, imagen, 
               en_tarifa, costo, pvp, cargo_llevar, tipo_iva, cod_barra, descripcion, 
               tiempo_servicio, id_familia, posx_pantalla, posy_pantalla, activo, descrip, 
               en_stock, en_carta, familia_hija, color, uds_stock,
               nombre_es, nombre_en, nombre_de, nombre_fr) VALUES ('".$nombre."', 
                   '0', '0', '',
                   '".$tarifa."', 0.00,
                   ".$pvp.",
                       0.00, 0.00, 0, 
                       '', 
                           0,
                           (SELECT id_familia FROM familias WHERE nombre = '".$familia."'), 
                               0, 0,
                               1,
                               '0',                               
                               ".$stock.", 0, 0, 
                                   '".$color."', 0,
                                       '".$nombre."', '".$nombre."','".$nombre."','".$nombre."')";
           
           $bd->insertar($ssql); 
            
        }
   }
    
   public function c_articulo($nombre) {
       
       $bd=Db::getInstance(); 
       $sql = false;
        $ssql = "SELECT nombre FROM articulos WHERE nombre = '".$nombre."'";
        $stmt = $bd->ejecutar($ssql);
        
        if (mysql_num_rows($stmt)>0)
            $sql = true;
        
       return $sql;
    }
    
    
  public function del_art($id) {
     $bd=Db::getInstance();
       
     $del = "DELETE FROM articulos WHERE id_articulo = ".$id;
     $bd->borrar($del);

     $del = "DELETE FROM arts_grupomods WHERE id_art = ".$id;
     $bd->borrar($del);
  }
    
    
  public function mod_art($id) {
      $bd=Db::getInstance();
      
        $clase = ($_SESSION["teclado"]=="S")?"class=\"qwerty\"":"";
        $html = "";
        
        $art_nombre = "";
        $art_familia = "";
        $art_pvp = 0.00;
        $art_descrip = "";
        $art_color = "";
        $art_tarifa = "";
        $art_stock = "0";
        $art_orden = "0";
        $art_uds_stock = "0";
        $art_imagen = "";
        
        
        $ssql = "SELECT articulos.orden, articulos.nombre, familias.nombre AS nombre_fam, 
            articulos.pvp, articulos.descripcion, articulos.color, articulos.imagen,  
            articulos.en_tarifa, articulos.en_stock, articulos.uds_stock FROM articulos INNER JOIN familias ON 
            articulos.id_familia = familias.id_familia WHERE id_articulo = ".$id;
         $stmt = $bd->ejecutar($ssql);
       
        if (mysql_num_rows($stmt) > 0) {
                     
           while ($a=$bd->obtener_fila($stmt,0)){
                $art_nombre = $a['nombre'];
                $art_familia = $a['nombre_fam'];
                $art_pvp = $a['pvp'];
                $art_descrip = $a['descripcion'];
                $art_color = $a['color'];
                $art_tarifa = $a['en_tarifa'];
                $art_stock = $a['en_stock'];
                $art_orden = $a['orden'];
                $art_uds_stock = $a['uds_stock'];
                $art_imagen = $a["imagen"];
             }
        }
        
        
        
        $html .= '<table id="tabla_articulos">';
        
        $html .= '<tr><td colspan="2">ARTICULO</td><td>ORDEN</td><td>P.V.P.</td></tr>';
        $html .= '<tr><td colspan="2"><input type="text" id="nombre" value="'.$art_nombre.'" class="'.$_SESSION["teclado"].'"/></td>';
                       
       
        
         $html .= '</select></td>';
         $html .= '<td><input type="text" id="torden" value="'.$art_orden.'" class="'.$_SESSION["teclado"].'"/></td>';
         $html .='<td><input type="text" id="pvp" value="'.$art_pvp.'" class="'.$_SESSION["teclado"].'"/></td></tr>';
               
        $html .= '<tr><td>FAMILIA</td><td>COLOR</td><td>TARIFA</td><td>STOCK</td></tr>'; 
          //------NOMBRES DE FAMILIAS
        $html .= '<tr>';
        $ssql = "SELECT * FROM familias ORDER BY nombre ASC";
        $stmt = $bd->ejecutar($ssql);
       
        if (mysql_num_rows($stmt) > 0) {
            
           $html .= '<td><select id="familia" name="familia">';
           $html .= '<option value="'.$art_familia.'">'.$art_familia.'</option>';
            while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>';  
               
            }
         }    
         
        $html .= '</td>';
         
         $html .= '<td><input id="tcolor" class="color" value="'.$art_color.'"/></td>';
         
         
         //TARIFA Y STOCK
         $html .= '<td>';
         if ($art_tarifa == "S"){
            $html .= '<input type="checkbox" id="tarifa" value="TARIFA" checked/></td>';
         }else{
             $html .= '<input type="checkbox" id="tarifa" value="TARIFA" /></td>'; 
         }
         
         
         $html .= '<td>';
         if ($art_stock == "1"){
             $html .= '<input type="checkbox" id="stock" value="STOCK" checked/></td>';//</tr>';
         }else{
             $html .= '<input type="checkbox" id="stock" value="STOCK" /></td>';//</tr>';
         }
         $html .= '</tr>';
         $html .= '<tr><td colspan="2">MODIFICADORES</td><td colspan="2"><p>Uds. en stock: '.preg_replace('/^(-?\d+).0+$/', '$1',  $art_uds_stock).'</p>';
         
               //------NOMBRES DE GRUPOS
        $ssql = "SELECT * FROM grupos_modificadores ORDER BY nombre ASC";
        $stmt = $bd->ejecutar($ssql);
                     
        if (mysql_num_rows($stmt) > 0) {
            
            
           $html .= '<tr><td colspan="2">
                
                    <select id="grupo" name="grupo">';
//           $html .= '<option value="'.$grupo.'">'.$grupo.'</option>';//valor en blanco al cargar la pagina
            while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<option value="'.$a['id_grupo'].'">'.$a['nombre'].'</option>';  
               
               
            }
           $html .= '</select><div id="bAddGrupo" class="botoncillo" style="float:right;" onclick="add_relacion('.$id.')"/>+</div></td>'; 

        }        
      
         $html .= '<td colspan="2"><input type="text" id="tAddUds" value="" class="'.$_SESSION["teclado"].'"/><div id="bAddUds" style="float:right;" class="botoncillo" onclick="add_uds('.$id.')">+</div></td>';
         
         
         //tabla con modificadores
         $html .= '<tr><td colspan="2"><table id="tabla_mods">';
                   
         $ssql = "SELECT grupos_modificadores.id_grupo, grupos_modificadores.nombre, grupos_modificadores.observ FROM grupos_modificadores
               INNER JOIN arts_grupomods ON 
               arts_grupomods.id_grupo = grupos_modificadores.id_grupo                
               WHERE arts_grupomods.id_art = ".$id;
          
        $stmt = $bd->ejecutar($ssql);
       
                
        if (mysql_num_rows($stmt) > 0) {
            
           
           while ($a=$bd->obtener_fila($stmt,0)){
                
               $html .= '<tr>';
               $html .= '<td>'.$a["nombre"].'</td>';
               $html .= '<td>'.$a["observ"].'</td>';
               $html .= '<td><div id="bok" class="botoncillo" onclick="del_grupo('.$a['id_grupo'].','.$id.')">-</div></td>';
               $html .= '</tr>';
           }
        }
         
         $html .= '</table></td>';
         
         
      
             
         $html .='</tr>';
         $html .='<tr><td id="td_img">IMAGEN <br/><input type="text" id="timagen" value="'.$art_imagen.'"/></td><td id="td_img"><img src="http://'._DOMAIN_.'/'._APP_FOLDER_.'/'._IMAGES_PATH_.'/wkomander/articulos/'.$art_imagen.'" /></td></tr>';
         //BOTON OK Y VOLVER
         $html .= '<tr><td><div id="bAdd" class="boton" onclick="upd_art('.$id.')">MOD</div></td>';
         $html .= '<td><div id="bVolver" class="boton" onclick="location.href=\'articulos.php?familia='.$art_familia.'\'">VOLVER</div></td></tr>';
         
         
         $html .= "</table>"; 

   
        return $html;
    }
    
    public function upd_articulo($id, $nombre, $familia, $pvp, $orden, $tarifa, $stock, $color, $imagen) {
      $bd=Db::getInstance();
      $ssql = "UPDATE articulos SET 
               nombre = '".$nombre."', 
               id_familia = (SELECT id_familia FROM familias WHERE nombre = '".$familia."'), 
               pvp = ".$pvp.", 
              
               orden = '".$orden."', 
               color = '".$color."', 
               en_tarifa = '".$tarifa."', 
               en_stock = ".$stock." ,
               imagen = '".$imagen."'
               WHERE id_articulo = ".$id;
           
       $bd->actualizar($ssql);
            
       
        
        
       
        

       
      
      
    }
    
 public function del_grupo($idgrupo, $idart) {
       $bd=Db::getInstance();
       
       $del = "DELETE FROM arts_grupomods WHERE id_art = ".$idart." AND id_grupo = ".$idgrupo;
       $bd->borrar($del);
}
    
    
     public function add_relacion($idart, $idgrupo) {
        $bd=Db::getInstance();
        
     if (!$this->c_grupo_articulo($idart, $idgrupo)){
            
           $ssql = "INSERT INTO arts_grupomods (id_art, id_grupo) VALUES 
               (".$idart.", ".$idgrupo.")";
           
            $bd->insertar($ssql);
            
        }
}
    
    public function c_grupo_articulo($idart, $idgrupo) {
        $bd=Db::getInstance();
        
        $sql = false;
        
        $ssql = "SELECT * FROM arts_grupomods WHERE id_art = ".$idart." AND 
            id_grupo = ".$idgrupo;
        $stmt = $bd->ejecutar($ssql);
               
        if (mysql_num_rows($stmt) > 0) {
            $sql = true;                           

        }

          return $sql;
    }
    
    public function add_uds($idart, $uds) {
       $bd=Db::getInstance();
       
       $fecha = date("Y-n-j");
       $hora = date("H:i");
   
            
           $ssql = "UPDATE articulos SET uds_stock = uds_stock + ".$uds." 
               WHERE id_articulo = ".$idart;
           $bd->actualizar($ssql);
           
            
        
        
          $ssql2 = "INSERT INTO hist_stock (fecha, hora, idart, articulo, uds) VALUES 
              ('".$fecha."', '".$hora."', ".$idart.", (SELECT nombre FROM articulos
                   WHERE id_articulo = ".$idart."), ".$uds.")";
          $bd->insertar($ssql2);
         

       
      
        
      
    }
    
}

?>
