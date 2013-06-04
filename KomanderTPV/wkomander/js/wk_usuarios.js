
       
       
       
       
       function comprueba(usuario, pantalla, nivel){
       
            $.ajax({
                                url: "checkuser.php",
                                type: "POST",
                                data: "usuario="+usuario+"&contrasena="+contrasena.value+"&nivel="+nivel,
                                success: function(datos){
                                
                                    if ($.trim(datos) == "OK" ){
                                        location.href=pantalla;
                                    }else{
                                        location.href="usuarios.php";
                                    }
                                
                                        
                                }
               });
                        


        }



       function borralinea2(idlinea){
            location.href="borralinea.php?idlinea="+idlinea;
        }