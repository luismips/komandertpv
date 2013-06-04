<?php
 session_start();
 session_name("loginUsuario");
 require 'clases/includes.php';
 header('Content-type: text/html; charset=iso-8859-1');
 include 'lang/'.$_SESSION["lang"].'.php';
?>
<html>

  <head>
     
    
    <title>KomanderTPV</title>
    
   
    <link rel="stylesheet" type="text/css" href="styles/visoresdetalle.css" />
     <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
     <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
    
     <script type="text/javascript" src="js/jquery.timer.js"></script>

 
    <script>
        
        $(document).ready(function(){
            
                    
                grupo_pte();
                $('.oculta').hide();
                    

                 $.timer(5000, function(){
                         grupo_pte();
                 });
               
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

                            $("#openCloseIdentifier").hide();
                            
                        }
                    });  

                
                
                 
          });  
         
     
          
    </script>

 <script>
              
        function infomods(articulo){
//           alert(articulo);
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
        
        function relacion_mesa(mesa){
//            alert(mesa);
            $.ajax({
                                url: "relacion_mesa.php",
                                type: "GET",
                                data: "mesa="+mesa+"&visor=<?php echo $_GET["visor"];?>",
                                success: function(datos){
                                if ($.trim(datos) != "NO" ){
                                    $("#tabla_grupo3").text("");
                                    $("#tabla_grupo3").append(datos);
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
                                grupo_pte();
//                             
                                $("#"+id).css({ color: "#FFFFFF", background: "#FF0000" });    
                                        
                                }
                        });
                        


        }
        
        function grupo_pte(){
            
            $.ajax({
                                url: "grupo_pte.php",
                                type: "GET",
                                data: "visor=<?php echo $_GET["visor"];?>&modo=detallado",
                                success: function(datos){
                                if ($.trim(datos) != "NO" ){
                                    $("#tabla_grupo1").text("");
                                    $("#tabla_grupo1").append(datos);
//                                    $("#dialogDatos").dialog("open");
//                                        return false;
//                                   alert(datos);
                                }
                                
                                    
                                        
                                }
                        });
                        


        }
        
         function tiket(mesa){
            location.href="tiket.php?mesa="+mesa+"&comensal=0";
        }
        
               
</script> 


  </head>

  <body>
         <?php
    echo '<div id="dialogDatos" title="">
		<div id="tdatos"></div>
               

      </div>';
 
 ?>
      
             <div id="sliderWrap">
        <div id="openCloseIdentifier"></div>
        <div id="slider">
            <div id="sliderContent">

                <!--<div id="bColaNormal" class="boton_izq" onclick="location.href='visores.php?visor=&modo=normal'"> NORMAL </div>-->
                <div id="bColaNoServido" class="b_slider" onclick="location.href='visores.php?visor=<?php echo $_GET["visor"]; ?>&modo=pte'"><?php echo PENDIENTE; ?> </div>
                <div id="bColaServido" class="b_slider" onclick="location.href='visores.php?visor=<?php echo $_GET["visor"]; ?>&modo=normal'"><?php echo TODO; ?> </div>
<!--                <div id="bColaArtPteAgrupados" class="boton_izq" onclick="location.href='visores.php?visor=&modo=articulos_pte_agrupados'"> GRUPO PTE </div>
                <div id="bColaArtPteAgrupadosMods" class="boton_izq" onclick="location.href='visores.php?visor=&modo=articulos_pte_agrupados_mods'"> GRUPO PTE MODS</div>-->
                <div id="bColaArtPteAgrupados" class="b_slider" onclick="location.href='visoresdetalle.php?visor=<?php echo $_GET["visor"]; ?>&modo=detallado'"> <?php echo AGRUPADO; ?></div>
                <div id="bColaMesa" class="b_slider" onclick="location.href='visormesa.php?visor=<?php echo $_GET["visor"]; ?>&modo=mesa'"> <?php echo MESAS; ?> </div>
            </div>
        </div>
        <div id="openCloseWrap">

                <div class="b_menu topMenuAction"></div>


         </div>
    </div>
    
    
      
      
      <input type="hidden" id="valor_scroll_grupo1" value="0" />
      <input type="hidden" id="valor_scroll_grupo2" value="0" />
      <input type="hidden" id="valor_scroll_grupo3" value="0" />
      <input type="hidden" id="visor_activo" value="<?php echo $_GET["visor"];?>"/>
   
      
    <div id="page-wrap">
       <div id="panel_botones">
            <div id="bVVolver" class="b_visores" onclick="location.href='mesas.php?zona=<?php echo $_SESSION["zona"]; ?>'"> <?php echo VOLVER; ?> </div>
               
        </div>
        
        
       <div id="container_grupo1">

            <table id="tabla_grupo1" rules="all">
            
            </table> 

      </div> 
      
      <div id="container_grupo2">

            <table id="tabla_grupo2" rules="all">
               
            </table> 

      </div> 
      
       <div id="container_grupo3">

            <table id="tabla_grupo3" rules="all">
        
            </table> 

      </div>  
    
</div>
  </body>

</html>