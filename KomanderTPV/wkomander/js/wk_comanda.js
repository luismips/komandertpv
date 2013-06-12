 $(document).ready(function(){
                   
                g_comanda();  
                g_info_comanda();   
                g_familias_comanda(0);
                
                $(".qwerty").keyboard({
                    position:{
                        at: 'center bottom'
                    }
                });
                   
                   
                  $('#dialogBorraLinea').hide();
                  $('#dialogTexto').hide();
                  $('#dialogCamarero').hide();
                 

    

                 // Dialog			
                    $('#dialog').dialog({
                            autoOpen: false,
                            width: 600,
                            buttons: {
                                    "OK": function() { 
//                                            $(this).dialog("close"); 
                                                eliminar();
                                    }, 
                                    "Cancel": function() { 
                                            $(this).dialog("close"); 
                                    } 
                            }
                    });

                    // Dialog Link
//                    $('#bEliminar').click(function(){
//                            $('#dialog').dialog('open');
//                            return false;
//                    });
                    
                    // Dialog			
                    $('#dialogNombre').dialog({
                            autoOpen: false,
                            width: 600,
                            buttons: {
                                    "OK": function() { 
//                                            $(this).dialog("close"); 
                                                nombre();
                                    }, 
                                    "Cancel": function() { 
                                            $(this).dialog("close"); 
                                    } 
                            }
                    });

                    // Dialog Link
                    $('#bNombre').click(function(){
                            $('#dialogNombre').dialog('open');
                            return false;
                    });
                    
                    
                    //Dialog camareros
                     $('#dialogCamarero').dialog({
                            autoOpen: false,
                            width: 600,
                            buttons: {
                                    "OK": function() { 
//                                            $(this).dialog("close"); 
                                             camarero(nCamarero.value);
                                    }, 
                                    "Cancel": function() { 
                                            $(this).dialog("close"); 
                                    } 
                            }
                    });
                    
                    
                   
                    
                    
                    
                    $(".topMenuAction").click( function() {
                        if ($("#openCloseIdentifier").is(":hidden")) {
                            $("#slider").animate({ 
                                marginTop: "-580px"
                                }, 200 );
                            $("#topMenuImage").html('<div class="boton"> BOTON </div>');
                            $("#openCloseIdentifier").show();
                            $("#padre0").show();
                        } else {
                            $("#slider").animate({ 
                                marginTop: "0px"
                                }, 200 );
                            $("#topMenuImage").html('<div class="boton"> BOTON </div>');
                            $("#openCloseIdentifier").hide();
                            
                        }
                    });  
           
        });    





function g_info_comanda(){

        $.ajax({
                            url: "phps/g_info_comanda.php",
                            type: "POST",
                            data: "",
                            success: function(datos){
                              $("#tabla_info").remove();
                              $("#container_info").append(datos);
                              
                             }
                    });



    }
    
      function g_comanda(){

        $.ajax({
                            url: "phps/g_comanda.php",
                            type: "POST",
                            data: "",
                            success: function(datos){
                              $("#td_comanda").html("");
                              $("#td_comanda").append(datos);
                              
                             }
                    });



    }
    
    function g_familias_comanda(padre){

        $.ajax({
                            url: "phps/g_familias_comanda.php",
                            type: "POST",
                            data: "padre="+padre,
                            success: function(datos){
                              $("#articulos").html("");
                              $("#articulos").append(datos);
                                set_padre(padre);
                                g_articulos_comanda(padre);
                             }
                    });



    }
    
   function g_articulos_comanda(padre){

      $.ajax({
                            url: "phps/g_articulos_comanda.php",
                            type: "POST",
                            data: "padre="+padre,
                            success: function(datos){
//                              $("#articulos").html("");

                              $("#articulos").append(datos);
//                              alert(datos);  
                             }
                            
       });



    }
    
    
function i_historial(mods, articulo, idarticulo){

   if (mods=="S"){
            
           location.href="mods.php?i="+idarticulo+"&a="+articulo;
            
   }else{

                $.ajax({
                                        url: "comanda_i_historial.php",
                                        type: "POST",
                                        data: "articulo="+articulo+"&idarticulo="+idarticulo,
                                        success: function(datos){

                                            g_comanda();
                                            g_info_comanda();

                                        }
                                });

    }

  g_comanda();
}


function padre0(){
    g_familias_comanda(0);
}

function sube1(familia){
    
    
    $.ajax({
                url: "phps/g_padre.php",
                type: "POST",
                data: "familia="+familia,
                success: function(datos){

                   
                    g_familias_comanda(datos.trim());
                }
       });
}


function sin_stock(art){
    alert("SIN EXISTENCIAS:\n\n" + art);
}


function pte(){
    
        location.href="pte.php";
        
}

function addcom(){
        location.href="comensales.php";
}

function eliminar(){
        location.href="borracomanda.php";
}

function abrir_cliente(){
        location.href="abrir_cliente.php";
}

function trasp(){
        location.href="trasp.php";
}

function cobrar(total){
        location.href="cobro.php?total="+total;
}

function tiket(){
      location.href="tiket.php";
}

function nombre(){
        if (nuevonombre.value == ""){
            alert("Antes de traspasar debes seleccionar una mesa.");
        } else{
            location.href="cambionombre.php?nuevo="+nuevonombre.value;
        }
 }
 
 function camarero(nick){
     location.href="cambiocamarero.php?n="+nick;
 }
 
function borralinea2(idlinea, enviado){
    location.href="borralinea.php?enviado="+enviado+"&idlinea="+idlinea;
}

function invitalinea(idlinea){
    location.href="invitalinea.php?idhist="+idlinea;
}

function entregado(id){

    $.ajax({
                url: "entregado.php",
                type: "GET",
                data: "idhistdescr="+id,
                success: function(datos){
//                                    var color = $("#"+id).css("background");
//                                    alert(color);

                  $("#"+id+"celda").hide(); 
                   $("#"+id).css({ background: "rgb(200,200,200)" });


                }
        });



}

function gobservlinea(id){

        $.ajax({
                    url: "g_observ_linea.php",
                    type: "GET",
                    data: "idhist="+id,
                    success: function(datos){

                    texto_libre.value = datos;



                    }
            });



}

function iobservlinea(id, ob){

                $.ajax({
                        url: "i_observ_linea.php",
                        type: "GET",
                        data: "idhist="+id+"&observ="+ob,
                        success: function(datos){

                         }
                });



}