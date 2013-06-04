<?php
session_start();
session_name("loginUsuario");

if ($_SESSION["autentificado"] != "SI") {
    header("Location: acceso.php");
    
}
//else{
////    if ($_SESSION["autentificado"] != "SI") {
//        header("Location: usuarios.php");
////    }
//}
//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
//if ($_SESSION["autentificado"] != "SI") {
//    //si no existe, envio a la página de autentificacion
//    header("Location: acceso.php");
//    
//    exit();
//}
//



//}else {
//    //sino, calculamos el tiempo transcurrido
//    $fechaGuardada = $_SESSION["ultimoAcceso"];
//    $ahora = date("Y-n-j H:i:s");
//    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
//
//    //comparamos el tiempo transcurrido
//     if($tiempo_transcurrido >= 600) {
//     //si pasaron 10 minutos o más
//      session_destroy(); // destruyo la sesión
//      header("Location: acceso.php"); //envío al usuario a la pag. de autenticación
//      //sino, actualizo la fecha de la sesión
//    }else {
//    $_SESSION["ultimoAcceso"] = $ahora;
//   }
//} 
?> 