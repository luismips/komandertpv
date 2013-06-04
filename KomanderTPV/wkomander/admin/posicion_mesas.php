<?php
 include ("../seguridad.php");
//    session_start();
//    session_name("loginUsuario");
    header('Content-type: text/html; charset=iso-8859-1');
    
    require '../clases/includes.php';
    
    include_once('../clases/_mesas.php');

    $m = new _mesas();
    
       
?>





<html>

  <head>
<!--    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="../styles/style.css" />
    <link href="../styles/mesas.css" rel="stylesheet" type="text/css">
         <!-- styles needed by jScrollPane -->
   
   
    <script type="text/javascript" src="../js/jquery-1.7.1.js"></script>
   
    <script type="text/javascript">
  
//inicio lib
//function $(id){
//   return document.getElementById(id);    
//}
function addEvent(obj, evType, fn, useCapture){
 
  if (obj.addEventListener){
    obj.addEventListener(evType, fn, useCapture);
    
  } else if (obj.attachEvent){
    obj.attachEvent("on"+evType, fn);
   
  } else {
   obj['on'+evType]=fn;
  }
}

function removeEvent(obj, evType, fn, useCapture){
  if (obj.removeEventListener){
    obj.removeEventListener(evType, fn, useCapture);
    return true;
  } else if (obj.detachEvent){
    obj.detachEvent("on"+evType, fn);
  
  } else {
      obj['on'+evType]=function(){};
     
  }
  
}

function stopEvent(e) {
    if (!e) e = window.event;
    if (e.stopPropagation) {
        e.stopPropagation();
        
    } else {
        e.cancelBubble = true;
    }
    
}
function cancelEvent(e) {
    if (!e) e = window.event;
    if (e.preventDefault) {
        e.preventDefault();
    } else {
        e.returnValue = false;
    }
}
//fin lib
arrastrable={};
function mover(e){
e=e || window.event;
o=e.srcElement || e.target;
arrastrable.c2x=e.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
arrastrable.c2y=e.clientY+document.documentElement.scrollTop+document.body.scrollTop;
o.style.left=arrastrable.c2x-arrastrable.c1x+arrastrable.o1x+'px';
o.style.top=arrastrable.c2y-arrastrable.c1y+arrastrable.o1y+'px';
cancelEvent(e);
stopEvent(e);

}
function detener(){
    removeEvent(document, 'mousemove', mover, false);
    removeEvent(document, 'mouseup', detener, false);
    nuevapos(o);//o.id
}
function i(e){
e=e || window.event;
o=e.srcElement || e.target;
if(o.position!="relative"||!o.style.position){
                o.style.position="relative";
                o.style.float="none";
            }
arrastrable.c1x=e.clientX+document.documentElement.scrollLeft+document.body.scrollLeft;
arrastrable.c1y=e.clientY+document.documentElement.scrollTop+document.body.scrollTop;
arrastrable.o1x=!isNaN(parseInt(o.style.left))?parseInt(o.style.left):0;
arrastrable.o1y=!isNaN(parseInt(o.style.top))?parseInt(o.style.top):0;
addEvent(document, 'mousemove',mover, false);
addEvent(document, 'mouseup',detener, false);
cancelEvent(e);
stopEvent(e);

}

function nuevapos(t){
    
    var posx = t.style.top;
    var posy = t.style.left;
    var nombre = t.id;
    nombre = nombre.substring(1, nombre.length);
    posx = posx.substring(0, posx.length -2);
    posy = posy.substring(0, posy.length -2)
//    alert(nombre+ " " +posx + " " + posy);
    savepos(nombre, posx, posy);
}


</script>

        
        
  

  
    
    <script>
        

        
        $(document).ready(function(){
            
                
   <?php
       $idmesas = $m->ids_mover();
       $count = sizeof($idmesas);
       for($i=0;$i<$count;$i++){
           echo 'addEvent(document.getElementById("'.$idmesas[$i].'"), \'mousedown\',i, false);';
              
       }
       
          if (isset($_GET['zona'])){
        $_SESSION["zona"] = $_GET['zona'];
        echo 'document.getElementById("nombre").value ="'.$_GET['zona'].'";';
         } 
   
   ?>
            
              
           
                    
                                   
               


                    
        });    
</script>


  </head>
  
  
  
  <?php
 echo '<script type="text/javascript">
              
        function salir(){
            if ("'.$_SESSION["unico"].'"=="S"){
                
                location.href="acceso.php";
                
             }else{
                location.href="usuarios.php";
            }
        }  
        
        function mesas(){
                location.href="posicion_mesas.php?zona="+document.getElementById("nombre").value;
        }
        
       
        
     
         
         function savepos(nombre, posx, posy){
            
            $.ajax({
                                url: "saveposmesa.php",
                                type: "GET",
                                data: "nombre="+nombre+"&posx="+posx+"&posy="+posy,
                                success: function(datos){
                               
//                                   alert(datos);
                                }
                                
                                    
                                        
                                
                        });
                        


        }
        
         
       
       
    ';
   
         
  echo '</script>'; 
 
 ?>    
       

 
       

  




  <body>

                        
  
       
        
</div>
      
      
   
  	<div id="page-wrap">
        
             <div id="panel_botones_mesas">  
              <?php
                echo $m->zonas_admin();
              ?>


             </div>
<?php


    
    
  
    if (isset($_GET['zona'])){
        $_SESSION["zona"] = $_GET['zona'];
        echo $m->mesas_admin($_GET['zona']);
    }
    

    
    
    
    
  
?>

            </div>
  </body>

</html>
