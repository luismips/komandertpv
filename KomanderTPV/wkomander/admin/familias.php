<?php
session_start();
session_name("loginUsuario");

if ($_SESSION["nivel"] != "administrador") {
    header("Location: ../usuarios.php");
}

header('Content-type: text/html; charset=iso-8859-1');



require '../clases/includes.php';

include_once('clases/_familias.php');
$fam = new _familias();
?>
<html>

  <head>
   
    
    <title>KomanderTPV</title>
    

    <script type="text/javascript" src="../js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
    <script type="text/javascript" src="../js/jscolor.js"></script>
    <link type="text/css" href="../styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
     <script type="text/javascript" src="../js/jquery.keyboard.js"></script>
    <script type="text/javascript" src="../js/jquery.keyboard.extension-typing.js"></script>
    <link rel="stylesheet" type="text/css" href="../styles/keyboard.css" />
    <!--<link rel="stylesheet" type="text/css" href="../styles/style.css" />-->
    <link rel="stylesheet" type="text/css" href="styles/familias.css" />
    <script>
        $(document).ready(function(){
            $(".qwerty").keyboard({
                    position:{
                        at: 'center bottom'
                    }
                });
            
         
          
        });
</script>

    </script>
     
    
    <script TYPE="text/javascript">
        
         
        
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
        
    
        
      </script>
    
<?php
 echo '<script type="text/javascript">
        
              
        function nueva(){
//                alert(tcolor.color.rgb[0]);
            if (document.getElementById("nueva").value != ""){
                location.href="familias.php?nueva="+document.getElementById("nueva").value;
            }
        }
        
        function infofamilia(){

            if (document.getElementById("nombre").value != ""){
                location.href="familias.php?familia="+document.getElementById("nombre").value;
            }
        }
        
        function mod(){

            if (document.getElementById("nombre").value != ""){
                location.href="familias.php?mod=S&nombre="+document.getElementById("nombre").value+"&padre="+document.getElementById("padre").value+"&grupo="+document.getElementById("grupo").value+"&color="+document.getElementById("tcolor").value+"&preferencia="+document.getElementById("preferencia").value+"&orden="+document.getElementById("torden").value+"&imagen="+document.getElementById("timagen").value;
            }
        }
        
        function del(){

            if (document.getElementById("nombre").value != ""){
               var temp = confirm("Seguro que desea eliminar la familia?");
               if (temp){
                    location.href="familias.php?del=S&familia="+document.getElementById("nombre").value;
   
               }
             }
        }

      
       
 </script>   '; 

 
 
 

?>
    </head>

  <body>
      
      <div id="page-wrap">
          
      
    
      
<?php
if (isset($_GET['del'])){
    echo $fam->d_familia($_GET['familia']);
} 


if (isset($_GET['nueva'])){
    $fam->i_familia($_GET['nueva']);
    
} 

if (isset($_GET['mod'])){
    $fam->m_familia($_GET['nombre'], $_GET['padre'], $_GET['grupo'], $_GET['preferencia'], $_GET['color'], $_GET["orden"], $_GET["imagen"]);
}

if (isset($_GET['familia'])){
    echo $fam->g_familia($_GET['familia']);
} else{
    echo $fam->panel();
}




?>

      </div>
  </body>

</html>
