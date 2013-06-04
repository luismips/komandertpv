<?php
 session_start();
 session_name("loginUsuario");
 require 'clases/includes.php';
 include 'lang/'.$_SESSION["lang"].'.php';
?>
<html>

  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
    
    
    <link rel="stylesheet" type="text/css" href="styles/visormesa.css" />
     <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
     <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
    
     <script type="text/javascript" src="js/jquery.timer.js"></script>

 
    <script>
        
        $(document).ready(function(){
            
                    cargamesas();
                    
                    $('.oculta').hide();
 
                    $.timer(10000, function(){
                         cargamesas();
               
                         
                    });
                 
 
                 $('#dialogDatos').dialog({
                            autoOpen: false,
                            width: 600,
                            buttons: {
//                                    "TIKET": function() { 
//                                          $(this).dialog("close");    
//                                                
//                                    }, 
                                    "VOLVER": function() { 
                                            $(this).dialog("close"); 
                                    } 
                            }
                    });
                    
                   $(".topMenuAction").click( function() {
                        if ($("#openCloseIdentifier").is(":hidden")) {
                            $("#slider").animate({ 
                                marginTop: "-580px"
                                }, 200 );
                            $("#openCloseWrap").animate({ 
                                marginTop: "1px"
                                }, 200 );
//                            $("#topMenuImage").html('<div class="boton"> BOTON </div>');
                            $("#openCloseIdentifier").show();
//                            $("#padre0").show();
                        } else {
                            $("#slider").animate({ 
                                marginTop: "-0px"
                                }, 200 );
                             $("#openCloseWrap").animate({ 
                                marginTop: "580px"
                                }, 200 );
//                            $("#topMenuImage").html('<div class="boton"> BOTON </div>');
                            $("#openCloseIdentifier").hide();
                            
                        }
                    });  

                
                
                 
          });  
         
     
          
    </script>
 
<script>
              
        function infomods(articulo){
           
            $.ajax({
                                url: "visordetalle_infomods.php",
                                type: "GET",
                                data: "articulo="+articulo,
                                success: function(datos){
                                if ($.trim(datos) != "NO" ){
                                    $("#tabla_grupo2").text("");
                                    $("#tabla_grupo2").append(datos);
//                                    $("#dialogDatos").dialog("open");
//                                        return false;
//                                   alert(datos);
                                }
                                
                                    
                                        
                                }
                        });
                        


        }
        

        
          function servido(id){
       
            $.ajax({
                                url: "servido.php",
                                type: "GET",
                                data: "idcola="+id,
                                success: function(datos){
                                    if ($.trim(datos) != "NO" ){
                                        $("#tdatos").text("");
                                        $("#tdatos").append(datos);
                                        $("#dialogDatos").dialog("open");
                                            return false;
    //                                   alert(datos);
                                    }
//                                    alert(colorToHex($("#"+id).parent().css('background-color')));
                                     color = colorToHex($("#"+id).parent().css('background-color'));
//                                    alert($("#"+id).attr('class'));
                
                                    if ((color==="#ffffff") || (color==="#ffdddd") || (color ==="#ffdd00")){
                                        $("#"+id).parent().css({ "color": "#000000", "background": "#aaFFaa" });
                                        $("#"+id).parent().attr('class', "verde");
////                                      
                                    }else {
                                         $("#"+id).parent().css({ "color": "#000000", "background": "#ffffff" });
                                         $("#"+id).parent().attr('class', "normal");

                                    }
                                }
                        });
                        


        }
        
        function comandamesa(mesa){
            
            $.ajax({
                                url: "visormesascomanda.php",
                                type: "GET",
                                data: "mesa="+mesa+"&visor=<?php echo $_GET["visor"];?>",
                                success: function(datos){
                                if ($.trim(datos) != "NO" ){
                                    $("#tabla_grupo2").text("");
                                    $("#tabla_grupo2").append(datos);
//                                    $("#dialogDatos").dialog("open");
//                                        return false;
//                                   alert(datos);
                                }
                                
                                
                                    
                                        
                                }
                        });
                        


        }
        
        function cargamesas(){
            
            $.ajax({
                                url: "visormesaspte.php",
                                type: "GET",
                                data: "visor=<?php echo $_GET["visor"];?>&modo=mesas",
                                success: function(datos){
                                if ($.trim(datos) != "NO" ){
                                    $("#tabla_grupo1").text("");
                                    $("#tabla_grupo1").append(datos);

                                }
                                
                                    
                                        
                                }
                        });
                        


        }
        
          function colorToHex(color) {
            if (color.substr(0, 1) === '#') {
                return color;
            }
            var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(color);

            var red = parseInt(digits[2]);
            var green = parseInt(digits[3]);
            var blue = parseInt(digits[4]);

            var rgb = blue | (green << 8) | (red << 16);
            return digits[1] + '#' + rgb.toString(16);
        };
        
               
</script> 
  <?php
  echo '<div id="dialogDatos" title="">
		<div id="tdatos"></div>
               

      </div>';
 
 ?>

  </head>

  <body>
        <div id="sliderWrap">
        <div id="openCloseIdentifier"></div>
        <div id="slider">
            <div id="sliderContent">

                <div id="bColaNoServido" class="b_slider" onclick="location.href='visores.php?visor=<?php echo $_GET["visor"]; ?>&modo=pte'"><?php echo PENDIENTE; ?>  </div>
                <!--<div id="bColaServido" class="b_slider" onclick="location.href='visores.php?visor=&modo=servido'"> SERVIDO </div>-->
                <div id="bColaNormal" class="b_slider" onclick="location.href='visores.php?visor=<?php echo $_GET["visor"]; ?>&modo=normal'"> <?php echo TODO; ?> </div>
                
                <!--                <div id="bColaArtPteAgrupados" class="boton_izq" onclick="location.href='visores.php?visor=&modo=articulos_pte_agrupados'"> GRUPO PTE </div>
                <div id="bColaArtPteAgrupadosMods" class="boton_izq" onclick="location.href='visores.php?visor=&modo=articulos_pte_agrupados_mods'"> GRUPO PTE MODS</div>-->
                <div id="bColaArtPteAgrupados" class="b_slider" onclick="location.href='visoresdetalle.php?visor=<?php echo $_GET["visor"]; ?>&modo=detallado'"> <?php echo AGRUPADO; ?> </div>
                <div id="bColaMesa" class="b_slider" onclick="location.href='visormesa.php?visor=<?php echo $_GET["visor"]; ?>&modo=mesa'"> <?php echo MESAS; ?>  </div>
            </div>
        </div>
        <div id="openCloseWrap">

                <div class="b_menu topMenuAction"> MENU </div>


         </div>
    </div>
      
      <div id="page-wrap">
      <div id="panel_botones">
          <div id="bVVolver" class="b_visores" onclick="location.href='mesas.php?zona=<?php echo $_SESSION["zona"]; ?>'"><?php echo VOLVER; ?></div>
                
      </div>
      
      <input type="hidden" id="visor_activo" value="<?php echo $_GET["visor"];?>"/>
   
       <div id="container_grupo1">
            <table id="tabla_grupo1" rules="all">
            </table> 
        </div> 
      
      <div id="container_grupo2">
        <table id="tabla_grupo2" rules="all">
        </table> 
       </div> 
      
      
    
</div>
  </body>

</html>