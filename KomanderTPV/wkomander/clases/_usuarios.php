<?php



class _usuarios {  
    
    public function g_users() {
        
        
	$bd=Db::getInstance();  
	
        $ssql = "SELECT * FROM usuarios INNER JOIN niveles ON 
            usuarios.nivel = niveles.id_nivel";
        
        $stmt=$bd->ejecutar($ssql);  

        $sql = "<div id=\"usuarios\">";
         
        while ($x=$bd->obtener_fila($stmt,0)){
            
      
              if($x["nombre"]=="administrador"){
                    $_SESSION["nivel"] = "administrador";
                $sql .= "<div class=\"usuario\" style=\"background-image:url('".$x['imagen']."');\" onclick=acceso('".$x['nick']."','".$x['pantalla']."','administrador','".CANCELAR."')>".stripslashes($x['nick'])."</div>";
               }else if($x["nombre"]=="camarero"){
                    $_SESSION["nivel"] = "camarero";
                $sql .= "<div class=\"usuario\" style=\"background-image:url('".$x['imagen']."');\" onclick=acceso('".$x['nick']."','".$x['pantalla']."','camarero','".CANCELAR."')>".stripslashes($x['nick'])."</div>";
               }else if($x["nombre"]=="visor"){
                $_SESSION["nivel"] = "visor";
                $sql .= "<div class=\"usuario\" style=\"background-image:url('".$x['imagen']."');\" onclick=acceso('".$x['nick']."','".$x['pantalla']."','visor','".CANCELAR."')>".stripslashes($x['nick'])."</div>";
               }else if($x["nombre"]=="repartidor"){
                   $_SESSION["nivel"] = "repartidor";
                $sql .= "<div class=\"usuario\" style=\"background-image:url('".$x['imagen']."');\" onclick=acceso('".$x['nick']."','".$x['pantalla']."','repartidor','".CANCELAR."')>".stripslashes($x['nick'])."</div>";
               }else if($x["nombre"]=="encargado"){
                    $_SESSION["nivel"] = "encargado";
                $sql .= "<div class=\"usuario\" style=\"background-image:url('".$x['imagen']."');\" onclick=acceso('".$x['nick']."','".$x['pantalla']."','encargado','".CANCELAR."')>".stripslashes($x['nick'])."</div>";
               }   

               
            
        }
           
        $sql .= "</div>";
            

      
      
        return $sql;
    }
    
        public function g_nivel($usuario) {
            $bd=Db::getInstance();  
	
            $ssql = "SELECT niveles.nombre FROM usuarios INNER JOIN niveles ON 
            usuarios.nivel = niveles.id_nivel WHERE usuarios.nick = '".$usuario."'";

            $stmt=$bd->ejecutar($ssql);       

            $sql = "";
        
            while ($x=$bd->obtener_fila($stmt,0)){
                $sql = $x["nombre"];
            }
            
            return $sql;
        }
    
     public function c_user($usuario, $pass) {
        
        $bd=Db::getInstance();   
         
        $ssql = "SELECT niveles.nombre, niveles.pantalla FROM usuarios 
            INNER JOIN niveles ON usuarios.nivel = niveles.id_nivel 
            WHERE usuarios.nick='".$usuario."' and usuarios.pass='".$pass."'";
        
        $stmt=$bd->ejecutar($ssql);        
        
        $sql[0]= "";
        $sql[1]= "";
        
        while ($x=$bd->obtener_fila($stmt,0)){
             $sql[0] = $x["nombre"];//nivel
             $sql[1] = $x["pantalla"];//pantalla
             $sql[2] = $usuario;
        }
        
        return $sql;
    }
   
}

?>
