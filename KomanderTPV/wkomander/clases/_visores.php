<?php



/**
 * Description of _visores
 *
 * @author luismips
 */
class _visores {
     public function g_cola_b_visor($visor, $zona) {
         $bd=Db::getInstance(); 
                  
         if ($_SESSION["modo"]=="normal"){
           $ssql="SELECT  articulos.nombre_".$_SESSION["lang"]." AS articulo,
               familias.preferencia, cola.llevar, cola.id_cola, cola.hora_recibo, cola.uds, 
               cola.mods, cola.observ, cola.mesa, cola.comensal, cola.usuario, cola.servido, cola.anulado,
               cola.traspaso, cola.punto_anterior  FROM relacion_visores_cola 
                    INNER JOIN cola ON relacion_visores_cola.id_cola=cola.id_cola
                    INNER JOIN visores ON relacion_visores_cola.id_visor=visores.id_visor 
                    INNER JOIN articulos ON cola.articulo = articulos.id_articulo 
                    INNER JOIN familias ON articulos.id_familia = familias.id_familia
                    WHERE visores.id_visor=".$visor." GROUP BY relacion_visores_cola.id_cola ORDER BY cola.id_cola ASC LIMIT "._LINEAS_VISOR_; 
        }else if ($_SESSION["modo"]=="pte"){
           $ssql="SELECT articulos.nombre_".$_SESSION["lang"]." AS articulo,
               familias.preferencia, cola.llevar, cola.id_cola, cola.hora_recibo, cola.uds, 
               cola.mods, cola.observ, cola.mesa, cola.comensal, cola.usuario, cola.servido, cola.anulado,
               cola.traspaso, cola.punto_anterior  FROM relacion_visores_cola 
                    INNER JOIN cola ON relacion_visores_cola.id_cola=cola.id_cola
                    INNER JOIN visores ON relacion_visores_cola.id_visor=visores.id_visor
                    INNER JOIN articulos ON cola.articulo = articulos.id_articulo
                    INNER JOIN familias ON articulos.id_familia = familias.id_familia
                    WHERE visores.id_visor=".$visor." AND cola.servido = 'N' 
                     AND cola.anulado = 'N' GROUP BY relacion_visores_cola.id_cola ORDER BY cola.id_cola ASC LIMIT "._LINEAS_VISOR_;
        }else if ($_SESSION["modo"]=="servido"){
           $ssql="SELECT SELECT articulos.nombre_".$_SESSION["lang"]." AS articulo, 
               familias.preferencia, cola.llevar, cola.id_cola, cola.hora_recibo, cola.uds, 
               cola.mods, cola.observ, cola.mesa, cola.comensal, cola.usuario, cola.servido, cola.anulado,
               cola.traspaso, cola.punto_anterior  FROM relacion_visores_cola 
                    INNER JOIN cola ON relacion_visores_cola.id_cola=cola.id_cola
                    INNER JOIN visores ON relacion_visores_cola.id_visor=visores.id_visor
                   INNER JOIN articulos ON cola.articulo = articulos.id_articulo
                    INNER JOIN familias ON articulos.id_familia = familias.id_familia
                    WHERE visores.id_visor=".$visor." AND cola.servido = 'S' 
                        GROUP BY relacion_visores_cola.id_cola ORDER BY cola.id_cola ASC LIMIT "._LINEAS_VISOR_;
        }
        $rs = $bd->ejecutar($ssql);


        
           $sql = "";
           $sql .= "<div id=\"container_cola\">";
           
           $sql .= "<table id=\"tabla_cola\" rules=\"all\">";  
            $sql .= '<tr>
			<td class="oculta">IDCOLA</td>';
            if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado" || $_SESSION["nivel"]=="visor"){
                $sql .='  <td class="c_serv"> SERV </td>';
            }
//            <td id="c_mods">MODS</td>
            $sql .= '  <td id="c_hora">'.HORA.'</td>
                        <td id="c_uds">'.UDS.'</td>
			<td class="c_articulo">'.ARTICULO.'</td>
			
                        <td id="c_obs">'.OBSERV.'</td>
                        <td id="c_mesa">'.MESA.'</td>
                        <td id="c_comensal">'.COMENSAL.'</td>
                        <td id="c_usuario">'.USUARIO.'</td>
                        <td class="oculta">SERVIDO</td>
                        <td class="oculta">ANULADO</td>
                        <td class="oculta">TRASPASO</td>
                        <td id="c_anterior">TRASP</td>
		</tr>';
        
                
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    
         
           
           
            $idcola = "";
          
//           
            while ( $a = $bd->obtener_fila($rs,0)){
               
              
             if ($idcola != stripslashes($a['id_cola']) ) {  //para ke no se repita la id cola
                                                            //en el caso de los traspasos
                 
                  $mods = "";  
              //obtener mods en el idioma elegido
              if ($a["mods"]!=""){
                  $ids = explode(" ", $a["mods"] );
                  foreach ($ids as $id)

                    {
                      $serv = "SELECT nombre_".$_SESSION["lang"]." AS nombre
                          FROM modificadores WHERE id_modificador = ".$id;
                       $stmtserv=$bd->ejecutar($serv); 
                       if ($stmtserv !== false && mysql_num_rows($stmtserv) > 0) {
                             while ($s=$bd->obtener_fila($stmtserv,0)){
                                $mods .= $s['nombre']. " ";
                               
                            }
                        }
                    }

              }
                 
                 
               $llevar = stripslashes($a['llevar']);
                 $servido = stripslashes($a['servido']);
                $anulado = stripslashes($a['anulado']);
                $traspaso = stripslashes($a['traspaso']);
                $color = "normal";
                $preferencia = stripslashes($a['preferencia']);
                $hora = substr($a['hora_recibo'],0, strlen($a['hora_recibo'])-3);
                if ($anulado == 'S'){
                    $color = "rojo";
                    
                }else{
                    
                    if ($llevar=='S'){
                        $color="llevar";
                    }
                    
                    if ($preferencia < "3"){
                        $color="primeros";
                    }
                    
                    if ($servido == 'S'){
                        $color="verde";
                    }
                    
                    
                }
               
                
                $sql .= "<tr id=\"".stripslashes($a['id_cola'])."\" class=\"".$color."\">";
                $sql .= "<td class=\"oculta\">".stripslashes($a['id_cola'])."</td>";
                if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado" || $_SESSION["nivel"]=="visor"){
                    $sql .= "<td><div class=\"bServ\" onclick=servido(".$a['id_cola'].")></div></td>";
                }
                
                $sql .= "<td class=\"c_hora\">".$hora."</td>";
                $sql .= "<td class=\"c_uds\">".preg_replace('/^(\d+)\.0+$/', '$1', $a['uds'])."</td>";
                $sql .= "<td class=\"c_articulo\">".stripslashes($a['articulo'])."</td>";
//                $sql .= "<td class=\"c_mods\">".stripslashes($a['mods'])."</td>";
                $sql .= "<td class=\"c_obs\">".$mods. " ".stripslashes($a['observ'])."</td>";
                $sql .= "<td class=\"c_mesa\">".stripslashes($a['mesa'])."</td>";
                $sql .= "<td class=\"c_comensal\">".stripslashes($a['comensal'])."</td>";
                $sql .= "<td class=\"c_usuario\">".stripslashes($a['usuario'])."</td>";
                $sql .= "<td class=\"oculta\">".stripslashes($a['servido'])."</td>";
                $sql .= "<td class=\"oculta\">".stripslashes($a['anulado'])."</td>";
                $sql .= "<td class=\"oculta\">".stripslashes($a['traspaso'])."</td>";
                $sql .= "<td class=\"c_anterior\">".stripslashes($a['punto_anterior'])."</td>";
                $sql .= "</tr>";
                
                $idcola =  stripslashes($a['id_cola']); 
                
             }
            
            }
       
           
            
            

        }
         $sql .= "</table>";
        $sql .= "</div>";
        
        return $sql;
    }
    
     public function g_visores() {
	$bd=Db::getInstance(); 
        $ssql = "SELECT nombre_".$_SESSION["lang"]." AS nombre,
            id_visor FROM visores WHERE activo=1 ORDER BY nombre ASC";

        $rs = $bd->ejecutar($ssql);

        $sql = "";
        
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    
           $sql = "<div id=\"sel_visores\">";
    
            while ( $a = $bd->obtener_fila($rs,0)){
                $sql .= "<div id=\"sel_visor\" onclick=\"location.href='visores.php?visor=".stripslashes($a['id_visor'])."&modo=pte'\">".stripslashes($a['nombre'])."</div>";
                 
            }
            
            $sql .= "</div>";
            

        }
        
        return $sql;
    }
    
    public function g_articulos_pte_agrupados($visor, $zona) {
         $bd=Db::getInstance();         
         $articulos = "";
       
        $sql = "";
        
        $ssql="SELECT * FROM relacion_visores_cola 
            INNER JOIN cola ON relacion_visores_cola.id_cola=cola.id_cola
            INNER JOIN visores ON relacion_visores_cola.id_visor=visores.id_visor
            WHERE visores.nombre='".$visor."' AND cola.servido = 'N'";

        $rs = $bd->ejecutar($ssql);
        
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    
           
          $sql .= "<div id=\"container_cola\">";
           
           $sql .= "<table id=\"tabla_cola\" rules=\"all\">";
            $sql .= '<tr>
			
                        <td id="c_uds">UDS</td>
			<td class="c_articulo">ARTICULO</td>
			<td id="c_mods">MODS</td>
                        
		</tr>';
                     
            while ( $a = $bd->obtener_fila($rs,0)){
              
              if ($_SESSION["modo"]=="articulos_pte_agrupados") { 
                   if (isset($articulos[$a["articulo"]])){
                      $articulos[$a["articulo"]] = $articulos[$a["articulo"]] + $a["uds"]; 
                   }else{

                    $articulos[$a["articulo"]] = $a["uds"];
    
                   }
             }else if($_SESSION["modo"]=="articulos_pte_agrupados_mods"){
                  if (isset($articulos[$a["articulo"]][$a["mods"]])){
                      $articulos[$a["articulo"]][$a["mods"]] = $articulos[$a["articulo"]][$a["mods"]] + $a["uds"]; 
                   }else{

                    $articulos[$a["articulo"]][$a["mods"]] = $a["uds"];
    
                   }
             }
         }
         
         if ($_SESSION["modo"]=="articulos_pte_agrupados") { 
                foreach ($articulos as $clave => $valor1) {
                    
                        $sql .= "<tr>";
                        $sql .= "<td class=\"c_uds\">".$valor1."</td>";
                        $sql .= "<td class=\"c_articulo\">".$clave."</td>";
                        

                        $sql .= "</tr>";  
                    
                }
        }else if ($_SESSION["modo"]=="articulos_pte_agrupados_mods") { 
                foreach ($articulos as $clave => $valor1) {
                    foreach ($valor1 as $clave2 => $valor2) {
                        $sql .= "<tr>";
                        $sql .= "<td class=\"c_uds\">".$valor2."</td>";
                        $sql .= "<td class=\"c_articulo\">".$clave."</td>";
                        $sql .= "<td class=\"c_mods\">".$clave2."</td>";

                        $sql .= "</tr>";  
                    }
                }
        }
         
         
        }
        
        $sql .= "</table>";
        $sql .= "</div>";
        $sql .= "</div>";
        
        return $sql;
    }
    
     public function g_articulos_pte_agrupados_mods($visor, $zona) {
         $bd=Db::getInstance(); 
         $articulos = "";
        
        $sql = "";
     
       $ssql="SELECT * FROM relacion_visores_cola 
            INNER JOIN cola ON relacion_visores_cola.id_cola=cola.id_cola
            INNER JOIN visores ON relacion_visores_cola.id_visor=visores.id_visor
            WHERE visores.id_visor=".$visor." AND cola.servido = 'N'";

        $rs = $bd->ejecutar($ssql);
        
           
           $sql .= "<div id=\"botones_cola\">"; 
             $sql .= "</div>";
        
                
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    
           
          $sql .= "<div id=\"container_cola\">";
           
           $sql .= "<table id=\"tabla_cola\" rules=\"all\">";
            $sql .= '<tr>
			
                        <td id="c_uds">UDS</td>
			<td class="c_articulo">ARTICULO</td>
			<td id="c_mods">MODS</td>
                        
		</tr>';
           
            while ( $a = $bd->obtener_fila($rs,0)){
              
                
               if (isset($articulos[$a["articulo"]][$a["mods"]])){
                  $articulos[$a["articulo"]][$a["mods"]] = $articulos[$a["articulo"]][$a["mods"]] + $a["uds"]; 
               }else{
                
                $articulos[$a["articulo"]][$a["mods"]] = $a["uds"];
//                $mods[$a["articulo"]] = $a["mods"];
               }
             }
        }
        
        
        
        foreach ($articulos as $clave => $valor1) {
            foreach ($valor1 as $clave2 => $valor2) {
                $sql .= "<tr>";
                $sql .= "<td class=\"c_uds\">".$valor2."</td>";
                $sql .= "<td class=\"c_articulo\">".$clave."</td>";
                $sql .= "<td class=\"c_mods\">".$clave2."</td>";

                $sql .= "</tr>";  
            }
        }
          
        
        $sql .= "</table>";
        $sql .= "</div>";
        $sql .= "</div>";
                
        return $sql;
    }
    
    
    public function c_sonido($idcola) {
        
        if ($_SESSION['idcola'] < $idcola){
            
            //asigna el nuevo numero
            $_SESSION['idcola'] = $idcola;
            
            //play sonido
            
            
            
        }
    }
     
}

?>
