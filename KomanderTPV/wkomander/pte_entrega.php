<?php
include ("seguridad.php");
require 'clases/includes.php';
include 'lang/'.$_SESSION["lang"].'.php';
$bd=Db::getInstance(); 
?>
<html>

  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    
    <title>KomanderTPV</title>
    
    <link rel="stylesheet" type="text/css" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/pte_entrega.css" />
       
    <script type="text/javascript" src="js/jquery-1.7.1.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <link type="text/css" href="styles/le-frog/jquery-ui-1.8.18.custom.css" rel="stylesheet" />

  </head>
  
  <?php
 echo '<script type="text/javascript">
          
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
       
</script>    '; 
 
 
 
 ?>

  
  <body>
          
               
      
<?php

   include_once('clases/conexion.php');

        $ssql = "SELECT articulos.nombre_".$_SESSION["lang"]." AS articulo,
            historial_puntos.punto, historial_puntos.comensal, 
            historial_puntos_descr.cantidad, historial_puntos_descr.id_hist_descr,
            cola.mods, historial_puntos_descr.enviado, historial_puntos_descr.pvp
             FROM historial_puntos_descr 
            INNER JOIN historial_puntos ON
            historial_puntos_descr.id_hist_punto = historial_puntos.id_hist
            INNER JOIN cola ON historial_puntos_descr.id_hist_descr = cola.id_hist_descr
            INNER JOIN articulos ON cola.articulo = articulos.id_articulo
            WHERE historial_puntos_descr.anulado ='N' AND cola.servido = 'S' AND 
            cola.entregado = 'N' 
                    ORDER BY historial_puntos_descr.id_hist_descr DESC";
        
        $rs =$bd->ejecutar($ssql);
        

        $sql = "";
        $info = "";
        
        if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
    

           $sql .= "<div id=\"comanda\">";
           
           $sql .= "<table align=\"center\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"1\">";
           $sql .= '<thead>
		<tr>
                        <th scope="col">ENTR</th>
                        <th scope="col">'.MESA.'</th>
                        <th scope="col">COM</th>
			<th scope="col">'.UDS.'</th>
			<th scope="col">'.ARTICULO.'</th>
			<th scope="col">'.SUMA.'</th>
		</tr>
	 </thead>';
           
           $suma = 0.00;
           $total = 0.00;
           $avg_propina = 0.00;
           $avg_descuento = 0.00;
           
           $servido = "";
           $entregado = "";
           
            while ( $a = $bd->obtener_fila($rs,0)){
                
                                              
                $color = "";
                $mods = "";                                
              //obtener mods en el idioma elegido
                if ($a["mods"]!=""){
                      $ids = explode(" ", $a["mods"] );
                      foreach ($ids as $id)

                        {
                          $serv = "SELECT nombre_".$_SESSION["lang"]." AS nombre
                              FROM modificadores WHERE id_modificador = ".$id;
                           $stmtserv=$bd->ejecutar($serv); 
                           if ($stmtserv !== false && mysql_num_rows($stmtserv) > 0) {
                                 while ($s=$bd->obtener_fila($stmtserv,0)){
                                    $mods .= $s['nombre']. " ";

                                }
                            }
                        }

                  }
                
                $bEntr = "<td  class=\"celda_entr\"><div id=\"".$a['id_hist_descr']."celda\" class=\"botoncillo\" onclick=\"entregado(".$a['id_hist_descr'].")\"></div></td>";
                                  
                if ($a["enviado"]== "S"){  
                    if ($_SESSION["nivel"]=="administrador" || $_SESSION["nivel"]=="encargado"){
                        $sql .= "<tr id=\"".$a['id_hist_descr']."\" class=\"".$color."\">";
                        
                        $sql .= $bEntr;
                        
                         $sql .= "<td>".stripslashes($a['punto'])."</td>";
                         $sql .= "<td>".stripslashes($a['comensal'])."</td>";
                        $sql .= "<td>".preg_replace('/^(\d+)\.0+$/', '$1',$a['cantidad'])."</td>";
                        $sql .= "<td>".stripslashes($a['articulo'])." ".$mods."</td>";

                    }else{
                        $sql .= "<tr class=\"".$color."\">";
                        $sql .= $bEntr;
                          $sql .= "<td>".stripslashes($a['punto'])."</td>";
                          $sql .= "<td>".stripslashes($a['comensal'])."</td>";
                        $sql .= "<td>".preg_replace('/^(\d+)\.0+$/', '$1',$a['cantidad'])."</td>";
                        $sql .= "<td>".stripslashes($a['articulo'])." ".$mods."</td>";
                        
                        
                    }
                  }else{
                    $sql .= "<tr class=\"".$color."\">";
                    
                    $sql .= $bEntr;
                      $sql .= "<td>".stripslashes($a['punto'])."</td>";
                      $sql .= "<td>".stripslashes($a['comensal'])."</td>";
                    $sql .= "<td>".preg_replace('/^(\d+)\.0+$/', '$1',$a['cantidad'])."</td>";
                     $sql .= "<td>".stripslashes($a['articulo'])." ".$mods."</td>";
                  }
                  
                
                $sql .= "<td>".(_DECIMALES_=="S"?number_format($a['pvp'], 2, ',', '.'):number_format($a['pvp'], 0, ',', '.'))."</td></tr>";
               
            }
            
            $sql .= "</table>";
            $sql .= "</div>";
            
    }
    $sql .= '<div id="bVolver" class="boton_izq" onclick="javascript:history.back()">'.VOLVER.'</div>';

        echo $sql;
?>
          
  </body>
</htm