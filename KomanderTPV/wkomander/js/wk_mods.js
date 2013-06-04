       $(document).ready(function(){
    
                g_mods();
                
                $(".qwerty").keyboard({
                    position:{
                        at: 'center bottom'
                    }
                });
    
              
});   



function check_mods(mod){
  
              
  $.ajax({
            url: "check_mods.php",
            type: "POST",
            data: "mod="+mod,
            success: function(datos){
              mods_mods.value = datos;

            }
    });

} 


   function g_mods(){

      $.ajax({
                            url: "phps/g_mods.php",
                            type: "POST",
                            data: "",
                            success: function(datos){
                              $("#mods").remove();

                              $("body").append(datos);
                           
                             }
                            
       });



    }
    
    
        
function i_historial(articulo, idarticulo){



                $.ajax({
                                        url: "comanda_i_historial.php",
                                        type: "POST",
                                        data: "articulo="+articulo+"&idarticulo="+idarticulo+"&desdemods=S&uds="+mods_uds.value,
                                        success: function(datos){
//                                            alert(datos);
                                          location.href="comanda.php"

                                        }
                                });

   

  
}