<?php

/**
 * Description of _mesas
 *
 * @author luismips
 */
class _mesas {
   
     public function g_zonas() {
         $bd=Db::getInstance(); 
         
         $zonas = ""; //para acceder al visor sin tener que escoger una zona (para ke no de fallo)
         $i = 0;
         
         $ssql = "SELECT nombre_".$_SESSION["lang"]." AS nombre, id_zona, tipo FROM zonas 
             WHERE activo = 1 ORDER BY orden ASC";

        $stmt=$bd->ejecutar($ssql);

        $sql = "";
        
        
        
        if ($stmt !== false && mysql_num_rows($stmt) > 0) {
                while ($a=$bd->obtener_fila($stmt,0)){
                $sql .= '<div class="zona" onclick="g_mesas('.stripslashes($a['id_zona']).',\''.stripslashes($a['tipo']).'\')">'.stripslashes($a['nombre']).'</div>';
                $zonas[$i] = stripslashes($a['id_zona']);
                $tipo_zona[$i] = stripslashes($a['tipo']);
                $i++;
            }
            
            if (!isset($_SESSION["zona"])){
                $_SESSION["zona"]= $zonas[0];
                $_SESSION["tipo_zona"] = $tipo_zona[0] ; 
            }
                     
         }
        return $sql;
    }
    
    
    public function g_mesas($zona, $tipo) {
         include_once('conexion.php');
         
          $bd=Db::getInstance(); 
         $datos = new conexion();
//        $zona = "";
        $pedido = "mesa ";
//        $tdpedido = "";
         

                 
        $ssql = "SELECT puntos.nombre, puntos.ocupada, puntos.pos_x, puntos.pos_y FROM puntos INNER JOIN zonas ON puntos.zona=zonas.id_zona 
            WHERE zonas.id_zona = ".$zona;

        $stmt=$bd->ejecutar($ssql);

        $sql = "";
        $color = "";
        
        $sql .= "<div id=\"mesas\">";
          
         if ($tipo=='LLEVAR') {
                   $sql .= "<div id=\"bLlevar\" class=\"boton_izq\" onclick=\"$('#dialogLlevar').dialog('open')\"> + </div>";
                   $pedido = "pedido";
        //           $tdpedido = "td_pedido";
               }

           if($tipo=='REPARTO'){
               $sql .= "<div id=\"bReparto\" class=\"boton_izq\" onclick=\"$('#dialogReparto').dialog('open');\"> + </div>";
               $pedido = "pedido";
    //           $tdpedido = "td_pedido";
           }

        
       if ($stmt !== false && mysql_num_rows($stmt) > 0) {
    
           $user = "";
           $total = 0.00;           
           $hora_apertura = "";//date("H:i");
           $fecha_apertura = "";           
//            $fecha = date("Y-n-j");  
           
            while ($a=$bd->obtener_fila($stmt,0)){
                
                
               
                
                if ($a['ocupada']=="S"){
                    $color = "rojo";
                   $entregado = "";
                   $servido = "";
                   $propina = 0;
                   $descuento = 0;
                   
                   $entregar = FALSE;
                   $servir = TRUE;
                   
 //                 $todo_entregado = true;
  
                   
                    //para saber si tienen algo pendiente en la mesa y ke aparezcoa de otro color
                    //para saber si tienen algo pendiente en la mesa y ke aparezcoa de otro color
                    $_entrega = "SELECT entregado FROM cola INNER JOIN historial_puntos_descr ON
                                cola.id_hist_descr = historial_puntos_descr.id_hist_descr 
                                INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = 
                                historial_puntos.id_hist
                                
                                WHERE historial_puntos_descr.anulado = 'N' AND 
                                historial_puntos.punto = '".$a['nombre']."' AND 
                                    cola.servido = 'S' AND
                                    cola.entregado = 'N'";
                     $stmt4=$bd->ejecutar($_entrega);
                     

                     if ( $stmt4 !== false && mysql_num_rows($stmt4) > 0 ) {
                                $entregado = 'N';
                     }
                            
                       //para saber si tienen algo pendiente de servir
                    $_serv = "SELECT servido FROM cola INNER JOIN historial_puntos_descr ON
                                cola.id_hist_descr = historial_puntos_descr.id_hist_descr 
                                INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = 
                                historial_puntos.id_hist
                                
                                WHERE historial_puntos_descr.anulado = 'N' AND 
                                historial_puntos.punto = '".$a['nombre']."' AND 
                                    cola.servido = 'N'";
                     $stmt5=$bd->ejecutar($_serv);
                             
                     if ( $stmt5 !== false && mysql_num_rows($stmt5) > 0 ) {
                          $servido = 'N';
                     }
                           
                            

                   
                     $total = 0;
                    //total de mesa
                    $_mesas = "SELECT id_hist, hora_apertura, fecha, propina, descuento, usuario FROM historial_puntos WHERE 
                        punto = '".$a['nombre']."' 
                            AND cobrada = 'N' AND anulado = 'N'";
                    $rs3 = $bd->ejecutar($_mesas);
                    
                    if ( $rs3 !== false && mysql_num_rows($rs3) > 0 ) {
                        while ($c=$bd->obtener_fila($rs3,0)){
                             
                           
                             $hora_apertura = $c['hora_apertura'];
                             $fecha_apertura = $c['fecha'];
                             
                             $propina = $c['propina'];
                             $descuento = $c['descuento'];
                             
                             $user = $c['usuario'];
                             
                             $_total = "SELECT pvp FROM historial_puntos_descr 
                                WHERE anulado = 'N' AND id_hist_punto = ".$c['id_hist'];
                             $rs4 = $bd->ejecutar($_total);
                             
                             if ( $rs4 !== false && mysql_num_rows($rs4) > 0 ) {
                                while ($d=$bd->obtener_fila($rs4,0)){
                                    $total = $total + $d['pvp'];
                                }
                            }
                        }
                        
                        if (is_numeric($total)){
                            
                            $total = $total + (($total * $propina)/100) - (($total * $descuento)/100);
                            $total = $datos->knumber($total);
                            $total = $total. " "._MONEDA_;
                            
                        }else{
                            $total = "";
                        }
                            
                        
                    }
                  
                        
                    $tiempo = $this->calcular_tiempo_trasnc($fecha_apertura,$hora_apertura);//time());                  
                   
                  if ($entregado == 'N'){
                    $color = "entregar";
                  }
                
                    if ($entregado != 'N' && $servido !='N'){
                        $color = "sinpedido";
                    }
                    
                }else{
                    $color= "verde";
                    $user = "";
                    $total = "";
                    $tiempo = "";
                }
                
                
//                
                $sql .= "<div id=\"m".$a['nombre']."\" class=\"".$color." ".$pedido."\" style=\"top:".$a['pos_x']."px;left:".$a['pos_y']."px;\" onclick=c_comensal('".stripslashes($a['nombre'])."')>";
                $sql .= "<table id='tb_datos' width='100%'>";
                    $sql .= "<tr>";
                        $sql .= '<td id="td_mesa">'.stripslashes($a["nombre"]).'</td>';
                    $sql .= "</tr>";
                    $sql .= "<tr>";
                        $sql .= '<td id="td_usuario"><p id="user">'.$user.'</p></td>';
                    $sql .= "</tr>";
                    $sql .= "<tr>";
                        $sql .= "<td id='td_tiempo'><p id=\"tiempo\">".$tiempo."</p></td>";
                    $sql .= "</tr>";
                    $sql .= "<tr>";
                        $sql .= "<td id='td_total'><p id=\"total\">".$total."</p></td>";
                    $sql .= "</tr>";
                   
                $sql .= "</table>";
                $sql .= "</div>";
                
       
            }
           
           

        }
         $sql .= "</div>";

        return $sql;
    }
 
  public function ids_mover() {
        $bd=Db::getInstance(); 
        
        $zona = "";
         
        if (isset($_GET["zona"]))
            {
                if ($_GET["zona"]!="")
                {
                    $zona = $_GET["zona"];
                }else{
                    exit();
                }
                
            }
         
        
        $ssql = "SELECT puntos.nombre, puntos.ocupada, puntos.pos_x, puntos.pos_y FROM puntos INNER JOIN zonas ON puntos.zona=zonas.id_zona 
            WHERE zonas.nombre = '".$zona."'";

         $rs = $bd->ejecutar($ssql);
         
         $sql[]=null;
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
            $i = 0;
            while ($a=$bd->obtener_fila($rs,0)){
                $sql[$i] = "m".$a["nombre"];
                $i++;
            }
        }
        return $sql;
    }   
    
    
 function calcular_tiempo_trasnc($fecha1, $hora1){
         
         
         $dia = explode("-", $fecha1);
         $hora = explode(":", $hora1);
         
         $timestamp1 = time();
         $timestamp2 = mktime($hora[0], $hora[1], $hora[2], $dia[1], $dia[2], $dia[0]);
          // Fecha de Ejemplo 21:00:00 del 14-02-2008
          $diferencia = $timestamp1 - $timestamp2;
          $resultado = $this->diferencia_fechas($diferencia);
          return $resultado;
         


} 

function diferencia_fechas($diferencia){
     $segundos = $diferencia % 60;
     $segundos = str_pad($segundos, 2, "0", STR_PAD_LEFT);
     $diferencia = floor($diferencia / 60);
     $minutos = $diferencia % 60;
     $minutos = str_pad($minutos, 2, "0", STR_PAD_LEFT);
     $diferencia = floor($diferencia / 60);
     $horas = $diferencia;
     $cadena = $horas.":".$minutos;//:".$segundos;
     return $cadena;
}
    
 public function g_comensales($mesa) {
        
        $bd=Db::getInstance(); 
        include_once('conexion.php');
        $datos = new conexion();
        
        

        $ssql = "SELECT id_hist, comensal, fecha, hora_apertura, propina, descuento FROM historial_puntos WHERE punto = '".$mesa."' AND
             cobrada = 'N' AND anulado = 'N' ORDER BY comensal ASC";

         $rs = $bd->ejecutar($ssql);

        $sql = "";
        
        if ($rs !== false && mysql_num_rows($rs) > 0) {
           
            $sql = "<div id=\"comensales\">";
            
           $hora_apertura = "";//date("H:i");
           $fecha_apertura = "";
            
           while ($a=$bd->obtener_fila($rs,0)){{
                $total = 0.00;
                $hora_apertura = $a['hora_apertura'];
                $fecha_apertura = $a['fecha'];
                $propina = $a["propina"];
                $descuento = $a["descuento"];
                $entregado = "S";
                $color = "";
                 //para saber si tienen algo pendiente en el comensal y ke aparezcoa de otro color
                    $_entrega = "SELECT entregado FROM cola INNER JOIN historial_puntos_descr ON
                                cola.id_hist_descr = historial_puntos_descr.id_hist_descr 
                                INNER JOIN historial_puntos ON historial_puntos_descr.id_hist_punto = 
                                historial_puntos.id_hist
                                
                                WHERE historial_puntos.id_hist = '".$a['id_hist']."' AND 
                                    cola.servido = 'S' AND
                                    cola.entregado = 'N'";
                             $rs4 = $bd->ejecutar($_entrega);
                             
                             if ( $rs4 !== false && mysql_num_rows($rs4) > 0 ) {                                 
                                        $entregado = 'N';
                                }
                                
                
                
                   $_total = "SELECT pvp FROM historial_puntos_descr 
                                WHERE id_hist_punto = ".$a['id_hist']." AND 
                    historial_puntos_descr.anulado = 'N'";
                             $rs5 = $bd->ejecutar($_total);
                             
                             if ( $rs5 !== false && mysql_num_rows($rs5) > 0 ) {
                                while ($d=$bd->obtener_fila($rs5,0)){
                                    $total = $total + $d['pvp'];
                                }
                             }else{
                                 $total = "0";
                             }
                             
                        
                        if (is_numeric($total)){
                            $total = $datos->knumber($total + (($total*$propina)/100)-(($total*$descuento)/100));
                        }else{
                            $total = 0;
                        }
                if ($entregado == 'N'){
                    $color = "entregar";
                }        
                
                $tiempo = $this->calcular_tiempo_trasnc($fecha_apertura,$hora_apertura);
                $sql .= "<div class=\"comensal ".$color."\" onclick=comanda('".stripslashes($a['comensal'])."')><p id=\"nombrec\">".stripslashes($a['comensal'])."</p><p id=\"total\">".$total." "._MONEDA_."</p><p id=\"tiempo\">".$tiempo."</p></div>";
                
                
                }
            }
            
            $sql .= "</div>";
        }
       
        return $sql;
    }
    
    
    public function g_pedidos() {
        $bd=Db::getInstance();  
     
        $ssql = "SELECT puntos.nombre, puntos.ocupada FROM puntos INNER JOIN zonas ON puntos.zona=zonas.id_zona 
            WHERE zonas.nombre = 'PEDIDOS'";

        $rs = $bd->ejecutar($ssql);

        $sql = "";
        $color = "";
        
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    
             $sql = "<div id=\"container_mesas\">";
           
           $sql .= "<div id=\"mesas\">";
           
            while ($a=$bd->obtener_fila($rs,0)){
                if ($a['ocupada']=="S"){
                    $color = "rojo";
                }else{
                    $color= "verde";
                }
                $sql .= "<div id=\"mesa\" class=\"".$color."\" onclick=\"location.href='c_comensal.php?mesa=".stripslashes($a['nombre'])."'\">".stripslashes($a['nombre'])."</div>";
             }
             
//            $sql .= "</div>";
//            $sql .= "<div id=\"bUpMesa\"> < </div>";
//            $sql .= "<div id=\"bDwMesa\"> > </div>";
//            $sql .= "</div>";

        }
        
        return $sql;
    }
    
    public function c_mas_de_un_comensal($mesa) {
        $bd=Db::getInstance(); 
        
        $ssql = "SELECT * FROM historial_puntos WHERE punto = '".$mesa."' AND 
            cobrada = 'N' AND anulado = 'N'";

        $rs = $bd->ejecutar($ssql);

        $sql = "";
        
        if ( $rs !== false && mysql_num_rows($rs) > 1 ) {
            $sql = "2";
        }else if( $rs !== false && mysql_num_rows($rs) == 1 ){
            $sql = "1";
        }
        
        return $sql;
    }
    
public function g_total_todos($mesa) {
         include_once('conexion.php');
         $datos = new conexion();
         
         $bd=Db::getInstance(); 
       
         $ssql = "SELECT SUM(historial_puntos_descr.cantidad) AS cantidad, 
              SUM(historial_puntos_descr.pvp) AS pvp, historial_puntos_descr.articulo, 
              historial_puntos_descr.mods, historial_puntos.propina, 
              historial_puntos.descuento FROM historial_puntos_descr INNER JOIN 
              historial_puntos ON historial_puntos_descr.id_hist_punto = historial_puntos.id_hist 
              WHERE historial_puntos.punto = '".$mesa."' AND historial_puntos.cobrada= 'N' 
                            AND historial_puntos.anulado = 'N' GROUP BY historial_puntos_descr.articulo ORDER BY historial_puntos_descr.id_hist_descr DESC";

        $rs = $bd->ejecutar($ssql);

        
//        $info = "";
        
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
            
           $suma = 0.00;
           $avg_propina = 0.00;
           $avg_descuento = 0.00;
           
            while ( $a = $bd->obtener_fila($rs,0)){
                
               $suma = $suma + (stripslashes($a['pvp']));
               $avg_propina = $a['propina'];
               $avg_descuento = $a['descuento'];
            }
            
            $propina = ($suma * $avg_propina)/100;
            $descuento = ($suma * $avg_descuento)/100;

            $total = $suma + $propina - $descuento;
            
            return $total;
        }   
  }
  
  public function zonas_admin() {
       $bd=Db::getInstance(); 
        
        $ssql = "SELECT * FROM zonas ORDER BY nombre ASC";
        $rs = $bd->ejecutar($ssql);
       
        $html = "<table id=\"tabla_zonas\">";
        
        if ($rs !== false && mysql_num_rows($rs) > 0) {
            
           $html .= '<tr><td>ZONA:</td>'; 
           $html .= '<td><select id="nombre" name="nombre" onchange="mesas()">';
           $html .= '<option value=""></option>';//valor en blanco al cargar la pagina
            while ( $a = $bd->obtener_fila($rs,0)){
                
               $html .= '<option value="'.$a['nombre'].'">'.$a['nombre'].'</option>';  
              
            }
            

        }

         $html .= "</select></td>";
         $html .= '<td><div id="bVolver" class="bPosVolver" onclick="location.href=\'../admin.php\'">VOLVER</div></td></tr>';
         $html .= "</table>"; 
         return $html;
    }
    
   
    public function mesas_admin() {
        $bd=Db::getInstance(); 
        $zona = "";
         
        if (isset($_GET["zona"]))
            {
                if ($_GET["zona"]!="")
                {
                    $zona = $_GET["zona"];
                }else{
                    exit();
                }
                
            }

        $ssql = "SELECT puntos.nombre, puntos.ocupada, puntos.pos_x, puntos.pos_y FROM puntos INNER JOIN zonas ON puntos.zona=zonas.id_zona 
            WHERE zonas.nombre = '".$zona."'";

        $rs = $bd->ejecutar($ssql);

        $sql = "";
     
        

           
           $sql .= "<div id=\"mesas\">";
          
           if ($_SESSION["tipo_zona"]=="LLEVAR"){
               $sql .= "<div id=\"bLlevar\" class=\"boton_izq\"> + </div>";
           }
           
           if ($_SESSION["tipo_zona"]=="REPARTO"){
               $sql .= "<div id=\"bReparto\" class=\"boton_izq\"> + </div>";
           }
        
        
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
            while ( $a = $bd->obtener_fila($rs,0)){
                
                 $sql .= "<div id=\"m".$a['nombre']."\" class=\"mesa mesapos\" style=\"top:".$a['pos_x']."px;left:".$a['pos_y']."px;\">";
                 $sql .= stripslashes($a["nombre"]);
                 $sql .= "</div>";
            }
         }
         $sql .= "</div>";

         return $sql;
    }
 
    
    
}

?>
