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
    
   
    <link rel="stylesheet" type="text/css" href="styles/visores.css" />
     <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
     <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
    
     <script type="text/javascript" src="js/jquery.timer.js"></script>

 
    <script>
        
        $(document).ready(function(){
                    
                    
                    $('.oculta').hide();
                    $('#sonido').hide();
                    
                    $.timer(<?php echo Vars::$timer_visor; ?>, function(){
                         updvisor();
                     });
                     
//                //actualizar la cola con las comandas introducidas   
                  function updvisor(){
                      
                      var last;
                      var filas = $("#tabla_cola tr").length; 
                      
                      if (filas == 1){
                          last = 0;
                      }else{ 
                          last = $("#tabla_cola tr:eq(1) td:first").text();
                         
                      }                      
//                       alert(last);                       
//                      (filas <){ 
                       
                           $.ajax({
                                    url: 'updvisor.php',
                                    type: "GET",
                                    data: "visor="+visor_activo.value+"&lastcola="+last,
                                    success: function(datos){
    //                                    $("#tabla_cola").remove();
    //                                    $("#container_cola").append(datos);
                                         if ($.trim(datos) != 'nada'){
//                                              $("#tabla_cola").find("tr:eq(1)").before(datos);
        //                                      alert(datos);
                                            $("#tabla_cola").find("tr:gt(0)").remove();
                                              $("#tabla_cola").append(datos);
                                              $(".oculta").hide();
                                          
//                                           if (last < $("#tabla_cola tr:eq(1) td:first").text()){
//                                               playSound("sounds/1.ogg");
    //                                            playSound("http://www.freesound.org/data/previews/9/9218_288-lq.mp3");
    //                   
//                                           }
                                         }
                                         
                                    }
                            });
                        
                    };
                       
                       
//                   function updvisor(){   
//                       
////                      var last = $("#tabla_cola tr:eq(1) td:first").text();
////                         alert(last);
//
//                       $.ajax({
//                                url: 'updvisor.php',
//                                type: "GET",
//                                data: "visor="+visor_activo.value+"&lastcola="+$("#tabla_cola tr:eq(1) td:first").text(),
//                                success: function(datos){
////                                    $("#tabla_cola").remove();
////                                    $("#container_cola").append(datos);
//                                      $("#tabla_cola").find("tr:gt(0)").remove();
//                                      $("#tabla_cola").append(datos);
//                                      $(".oculta").hide();
////                                     
////                                       if (last < $("#tabla_cola tr:eq(1) td:first").text()){
////                                           playSound("sounds/1.mp3");
//////                                            playSound("http://www.freesound.org/data/previews/9/9218_288-lq.mp3");
//////                    playSound("sounds/1.ogg");
////                                       }; 
//                                }
//                        });
//                   };  
                   
                   
                   
                    
                   
                   
                        
//                        checksonido(last);
                        
//                        if (last < $("#tabla_cola tr:last td:first").text()){
//                            playSound('1.wav');
//                        }
                        
                
                        

                
                

                    
//                    $('#bVDw1').click(function(evento){ 
//                   var valor_scroll = parseInt(valor_scroll_cola.value); 
//                    valor_scroll += 50;
//                    $("#container_cola").animate({scrollTop: valor_scroll}, 'fast');
//                    valor_scroll_cola.value = valor_scroll;
//                 });
//                 
//                 $('#bVUp1').click(function(evento){ 
//                   var valor_scroll = parseInt(valor_scroll_cola.value); 
//                    valor_scroll -= 50;
//                    $("#container_cola").animate({scrollTop: valor_scroll}, 'fast');
//                    valor_scroll_cola.value = valor_scroll;
//                 });
//                     $('#bVPageDw').click(function(evento){ 
//                   var valor_scroll = parseInt(valor_scroll_cola.value); 
//                    valor_scroll += 450;
//                    $("#container_cola").animate({scrollTop: valor_scroll}, 'fast');
//                    valor_scroll_cola.value = valor_scroll;
//                 });
//                 
//                 $('#bVPageUp').click(function(evento){ 
//                   var valor_scroll = parseInt(valor_scroll_cola.value); 
//                    valor_scroll -= 450;
//                    $("#container_cola").animate({scrollTop: valor_scroll}, 'fast');
//                    valor_scroll_cola.value = valor_scroll;
//                 });
                 
 
                 $('#dialogDatos').dialog({
                            autoOpen: false,
                            width: 600,
                            buttons: {
                                    
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
    //                                   
                                    }

                                    color = colorToHex($("#"+id).css('background-color'));
//                                    alert($("#"+id).attr('class'));
                
                                    if ((color==="#ffffff") || (color==="#ffdddd")){
                                        $("#"+id).css({ "color": "#000000", "background": "#aaFFaa" });
                                        $("#"+id).attr('class', "verde");
//                                      
                                    }else if (color==="#aaffaa"){
                                         $("#"+id).css({ "color": "#000000", "background": "#ffffff" });
                                         $("#"+id).attr('class', "normal");

                                    }
                                  
                                        
                              }
                        });
                        
       }
       
         function fmas(){    
                     
                         var last = $("#tabla_cola tr:last td:first").text();
//                         alert(last);
                         
                       $.ajax({
                                url: 'updvisor.php',
                                type: "GET",
                                data: "ver=mas&visor="+visor_activo.value+"&lastcola="+last,
                                success: function(datos){
//                                    $("#tabla_cola").remove();
//                                    $("#container_cola").append(datos);
                                    if ($.trim(datos) != 'nada'){
                                          $("#tabla_cola").find("tr:gt(0)").remove();
                                          $("#tabla_cola").append(datos);
                                          $(".oculta").hide();
                                    }
                                     

                                }
                        });
         }; 
         
          function fmenos(){    
                     
                         var last = $("#tabla_cola tr:eq(1) td:first").text();
//                         alert(last);
                         
                       $.ajax({
                                url: 'updvisor.php',
                                type: "GET",
                                data: "ver=menos&visor="+visor_activo.value+"&lastcola="+last,
                                success: function(datos){
//                                    alert(datos);
//                                    $("#tabla_cola").remove();
//                                    $("#container_cola").append(datos);
                                       if ($.trim(datos) != 'nada'){
                                          $("#tabla_cola").find("tr:gt(0)").remove();
                                          $("#tabla_cola").append(datos);
                                          $(".oculta").hide();
                                       }

                                }
                        });
         }; 
        
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
        
        function playSound(soundfile) {
            document.getElementById("sonido").innerHTML=
            "<audio id=\"sonido\" src=\""+soundfile+"\" type=\"audio/mp3\" hidden=\"true\" controls autoplay />";
               
        }
        

               
</script>   
 



  </head>

  <body>
      <span id="sonido"></span>
      
      
              <div id="sliderWrap">
        <div id="openCloseIdentifier"></div>
        <div id="slider">
            <div id="sliderContent">

                
               <div id="bColaNoServido" class="b_slider" onclick="location.href='visores.php?visor=<?php echo $_GET["visor"]; ?>&modo=pte'"> <?php echo PENDIENTE; ?> </div>
                <!--<div id="bColaServido" class="b_slider" onclick="location.href='visores.php?visor= ?>&modo=servido'"> SERVIDO </div>-->
                 <div id="bColaNormal" class="b_slider" onclick="location.href='visores.php?visor=<?php echo $_GET["visor"]; ?>&modo=normal'"><?php echo TODO; ?></div>
                
                <!--                <div id="bColaArtPteAgrupados" class="boton_izq" onclick="location.href='visores.php?visor=&modo=articulos_pte_agrupados'"> GRUPO PTE </div>
                <div id="bColaArtPteAgrupadosMods" class="boton_izq" onclick="location.href='visores.php?visor=&modo=articulos_pte_agrupados_mods'"> GRUPO PTE MODS</div>-->
                <div id="bColaArtPteAgrupados" class="b_slider" onclick="location.href='visoresdetalle.php?visor=<?php echo $_GET["visor"]; ?>&modo=detallado'"><?php echo AGRUPADO; ?> </div>
                <div id="bColaMesa" class="b_slider" onclick="location.href='visormesa.php?visor=<?php echo $_GET["visor"]; ?>&modo=mesa'"> <?php echo MESAS; ?> </div>
            </div>
        </div>
        <div id="openCloseWrap">

                <div id="b_menu_vis" class="topMenuAction"></div>


         </div>
    </div>
      
      <div id="page-wrap">
          
          <div id="botones_cola">
      
              
              
               <div id="bVVolver" class="b_visores" onclick="location.href='mesas.php?zona=<?php echo $_SESSION["zona"]; ?>'"> <?php echo VOLVER; ?> </div>
               <div id="bSelvisor" class="b_visores" onclick="location.href='selvisor.php'"><?php echo VISOR; ?></div>
               <div id="bmas" class="b_visores" onclick="fmas()"><p> > </p></div>
               <div id="bmenos" class="b_visores" onclick="fmenos()"><p> < </p></div>
               
           </div>
          
          
      
          
          
        
           
      
      <input type="hidden" id="valor_scroll_cola" value="0" />
      <input type="hidden" id="visor_activo" value="<?php echo $_GET["visor"];?>"/>
   
      
  	

<?php

     echo '<div id="dialogDatos" title="">
		<div id="tdatos"></div>
               

      </div>';

    include_once('clases/_visores.php');
    $vis = new _visores();
    
    $_SESSION['idcola'] = 0;
    $_SESSION["modo"]=$_GET["modo"];

    if ($_SESSION["modo"]=="normal" || $_SESSION["modo"]=="pte" || $_SESSION["modo"]=="servido"){
     echo $vis->g_cola_b_visor($_GET["visor"], $_SESSION["zona"]); 
    }else if ($_SESSION["modo"]=="articulos_pte_agrupados" || $_SESSION["modo"]=="articulos_pte_agrupados_mods"){
      echo $vis->g_articulos_pte_agrupados($_GET["visor"], $_SESSION["zona"]);   
    }
    
    
        
    
?>
    
</div>
  </body>

</html>