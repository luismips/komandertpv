        
        function gup( name )
        {
          name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
          var regexS = "[\\?&]"+name+"=([^&#]*)";
          var regex = new RegExp( regexS );
          var results = regex.exec( window.location.href );
          if( results == null )
            return "";
          else
            return results[1].replace('%20',' ');

        }






function set_mesa(nombre){

        $.ajax({
                            url: "phps/set_mesa.php",
                            type: "POST",
                            data: "nombre="+nombre,
                            success: function(datos){
                               
                            }
                    });



    }
    
  function set_comensal(nombre){

        $.ajax({
                            url: "phps/set_comensal.php",
                            type: "POST",
                            data: "comensal="+nombre,
                            success: function(datos){
                               
                            }
                    });



    }
    
        function set_padre(padre){

        $.ajax({
                            url: "phps/set_padre.php",
                            type: "POST",
                            data: "padre="+padre,
                            success: function(datos){
                               
                            }
                    });



    }
    
  function set_uds(uds){

        $.ajax({
                            url: "phps/set_uds.php",
                            type: "POST",
                            data: "uds="+uds,
                            success: function(datos){
                               
                            }
                    });



    }
    
     function set_articulo(art){

        $.ajax({
                            url: "phps/set_articulo.php",
                            type: "POST",
                            data: "articulo="+art,
                            success: function(datos){
                               
                            }
                    });



    }
    
   function set_idarticulo(idart){

        $.ajax({
                            url: "phps/set_idarticulo.php",
                            type: "POST",
                            data: "idarticulo="+idart,
                            success: function(datos){
                               
                            }
                    });

    }
    
 function set_total_cobro(total){

    $.ajax({
                        url: "phps/set_total_cobro.php",
                        type: "POST",
                        data: "total="+total,
                        success: function(datos){

                        }
                });

 }