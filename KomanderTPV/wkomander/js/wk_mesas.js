  $(document).ready(function(){
        $(".qwerty").keyboard({
                position:{
                    at: 'center bottom'
                }
            });

             $('#dialogLlevar').dialog({
                        autoOpen: false,
                        width: 600,
                        buttons: {
                                "OK": function() { 

                                            nuevopedido(nombre.value);
                                }, 
                                "Cancel": function() { 
                                        $(this).dialog("close"); 
                                } 
                        }
                });

//             $('#bLlevar').click(function(){
//                        $('#dialogLlevar').dialog('open');
//                        return false;
//             });

             $('#dialogReparto').dialog({
                        autoOpen: false,
                        width: 600,
                        buttons: {
                                "OK": function() { 

                                            checkcliente(telefono.value);
                                }, 
                                "Cancel": function() { 
                                        $(this).dialog("close"); 
                                } 
                        }
                });

//                $('#bReparto').click(function(){
//                        $('#dialogReparto').dialog('open');
//                        return false;
//                });


                $(".topMenuAction").click( function() {
                    if ($("#openCloseIdentifier").is(":hidden")) {
                        $("#slider").animate({ 
                            marginTop: "-583px"
                            }, 200 );
                        $("#topMenuImage").html('<div class="boton"> BOTON </div>');
                        $("#openCloseIdentifier").show();
                    } else {
                        $("#slider").animate({ 
                            marginTop: "0px"
                            }, 200 );
                        $("#topMenuImage").html('<div class="boton"> BOTON </div>');
                        $("#openCloseIdentifier").hide();
                    }
                });  





    });    










 function salir(unico){
        if (unico=="S"){

            location.href="acceso.php";

         }else{
            location.href="usuarios.php";
        }
    }  

    function pedidos(){
            location.href="pedidos.php";
    }

    function nuevopedido(name){
            location.href="nuevopedido.php?nombre="+name;
    }

    function checkcliente(tlf){
            location.href="checkcliente.php?tlf="+tlf;
    }

     function playSound(soundfile) {
        document.getElementById("sonido").innerHTML=
        "<audio id=\"sonido\" src=\""+soundfile+"\" type=\"audio/mp3\" hidden=\"true\" controls autoplay />";

     }

     function g_mesas(idzona, tipo){

        $.ajax({
                            url: "g_mesas.php",
                            type: "POST",
                            data: "zona="+idzona+"&tipo="+tipo,
                            success: function(datos){

                                $("#mesas").remove();
                                $("#page-wrap").append(datos);
                                $(".topMenuAction").click();
                              



                            }
                    });



    }
    
  function c_comensal(nombre){

        $.ajax({
                            url: "phps/c_comensal.php",
                            type: "POST",
                            data: "nombre="+nombre,
                            success: function(datos){
//                                alert(datos.trim());
                                    if (datos.trim() == "S"){
//                                        
                                          location.href="comensales.php";
                                    }else{
//                                        
                                          location.href="comanda.php?c="+datos.trim();
                                    }   

                            }
                    });



    }
    
