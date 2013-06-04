<?php
  session_start();
  session_name("loginUsuario");
  
  
  //variables de sesion usadas
  $_SESSION["logeado"] = "";//PARA SABER SI SE HA HECHO CORRECTAMENTE EL LOGIN PRINCIPAL
                                //para la apertura del programa
  $_SESSION["teclado"] = "";
  $_SESSION["zona"] = "";
  $_SESSION["autentificado"] = ""; //AUTENTIFICADO!!
  $_SESSION["usuario"] = "";//GUARDA USUARIO
  $_SESSION["unico"] = "";               //GUARDA COMO UNICO = S
  $_SESSION["nivel"] = "";       //NIVEL USUARIO
  $_SESSION["tipo"] = ""; //si es currante o cliente (usuario/cliente)
  $_SESSION["tipo_zona"] =""; //por si es llevar o reparto  
  
  $_SESSION["mesa"] = "";
  $_SESSION["comensal"] = "";
  $_SESSION["padre"] = ""; //la familia raiz para mostrar articulos y familias
  $_SESSION["last_padre"] = "";//ultimo raiz (en comanda.php) sirve??
  $_SESSION["idarticulo"] = "";
  $_SESSION["articulo"] = "";
  $_SESSION["uds"] = "";
  $_SESSION["idmods"] = "";
    
  
  $_SESSION["ids_mods"] = ""; //las ids de los mods selecionados
  $_SESSION["mods"] = "";//los nombres de los mods seleccionados
  
  $_SESSION["desde_mods"] = "";//para saber si vuelve desde la pantalla mods
  $_SESSION["precio_mods"] = "";//la suma del pvp de los mods seleccionados
  $_SESSION["grupomods"] = "";
  
  $_SESSION["desdemods"] = ""; //para saber si viene desde la pantalla mods
  $_SESSION["total_cobro"]= "";

  
   require 'clases/includes.php'; 
    include_once('clases/_usuarios.php');
    $users = new _usuarios();
    include_once('clases/_log.php');
    $log = new _log(); 

$bd=Db::getInstance();

    if (isset($_POST['teclado'])){
        if ($_POST['teclado']=='teclado'){//SI necesita teclado virual
            $_SESSION["teclado"] = "qwerty";
//            Vars::$clase_teclado = "qwerty";
        }
       
    }else{
             $_SESSION["teclado"] = "";
    }


       
    //para piyar una zona por defecto y que no falle si abre cajon o entra en visores
     $zona = "SELECT id_zona FROM zonas WHERE activo=1 ORDER BY id_zona ASC Limit 1,1";
     $stmt=$bd->ejecutar($zona);
     while ($x=$bd->obtener_fila($stmt,0)){
        $_SESSION["zona"] = $x["id_zona"];
    }
  
    

    
    
    
    $nivel = $users->c_user($_POST['usuario'], $_POST['contrasena']);
    

    
 if ($nivel[0] != ""){    


   
    
    $_SESSION["logeado"] = "S";//PARA SABER SI SE HA HECHO CORRECTAMENTE EL LOGIN PRINCIPAL
                                //para la apertura del programa
   
    if (isset($_POST['usuariounico'])) {
    if ($_POST['usuariounico']=='unico'){//SI ES UNICO
        $_SESSION["autentificado"] = "SI"; //AUTENTIFICADO!!
        $_SESSION["usuario"] = $_POST['usuario'];//GUARDA USUARIO
        $_SESSION["unico"] = "S";               //GUARDA COMO UNICO = S
         
//        while ( $a = mysql_fetch_assoc($rs) ) {//REDIRIGE SEGUN ROL
            $_SESSION["nivel"] = $nivel[0]; //GUARDA NIVEL
            header ("Location: ".$nivel[1]);
//        }
         $log->add_log($_POST['usuario'], "ACCESO", "Desde pantalla LOGIN. Usuario Unico");
    }
    }else{
        
        $_SESSION["autentificado"] = "SI"; //AUTENTIFICADO!!
        $_SESSION["unico"] = "N";
         $_SESSION["usuario"] = "";//GUARDA USUARIO
         $_SESSION["nivel"] = "camarero";
         $log->add_log($_POST['usuario'], "ACCESO", "Desde pantalla LOGIN. Apertura para varios usuarios.");
        header ("Location: usuarios.php");
    }
   
    $_SESSION["tipo"] = "usuario";
    
}else {
    //si no existe le mando otra vez a la portada
    $_SESSION["logeado"] = "N";
    header("Location: acceso.php?errorusuario=si");
}


?> 