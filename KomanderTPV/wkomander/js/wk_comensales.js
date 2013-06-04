$(document).ready(function(){
            
                g_comensales();
                
                $(".qwerty").keyboard({
                    position:{
                        at: 'center bottom'
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






function comanda(comensal){
//              alert(comensal);
//              set_mesa(mesa);
//              set_comensal(comensal);
              location.href="comanda.php?c="+comensal;
                
}

function add(num, nombre){
    if ((num == "") && (nombre != "")){               
            addnombre(nombre);
    }else if ((num != "") && (nombre == "")){
            addnumero(num);
    }
} 
        
        
function addnumero(num){
     $.ajax({
                    url: "phps/add_comensales.php",
                    type: "POST",
                    data: "num="+num,
                    success: function(datos){
                     g_comensales();
                     $(".topMenuAction").click();

                    }
      });
}
        
function addnombre(nombre){
     $.ajax({
                    url: "phps/add_comensal.php",
                    type: "POST",
                    data: "nombre="+nombre,
                    success: function(datos){
                      g_comensales();
                      $(".topMenuAction").click();

                    }
      });
}


     function g_comensales(){

        $.ajax({
                            url: "phps/g_comensales.php",
                            type: "POST",
                            data: "",
                            success: function(datos){

                                $("#comensales").remove();
                                $("#page-wrap").append(datos);
                               
                              



                            }
                    });



    }
    
function pte(){
    
       location.href="pte.php?todo=S";
      
        
}

 function cobrar(total){

        location.href="cobro.php?todo=S&total="+total;;
}


function tiket(){

  location.href="tiket_todo.php";
}