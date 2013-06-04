<?php
 session_start();
 session_name("loginUsuario");
header('Content-type: text/html; charset=iso-8859-1');
 require 'clases/includes.php';
 include 'lang/'.$_SESSION["lang"].'.php';
$bd=Db::getInstance(); 

 $articulos = "";

$sql = "NO";

$ssql="SELECT articulos.nombre_".$_SESSION["lang"]." AS articulo,
    articulos.id_articulo, cola.uds FROM relacion_visores_cola 
    INNER JOIN cola ON relacion_visores_cola.id_cola=cola.id_cola
    INNER JOIN articulos ON cola.articulo = articulos.id_articulo 
    INNER JOIN familias ON articulos.id_familia = familias.id_familia 
    INNER JOIN visores ON relacion_visores_cola.id_visor=visores.id_visor
    WHERE visores.id_visor=".$_GET["visor"]." 
        AND cola.servido = 'N' ORDER BY familias.preferencia ASC";


$rs = $bd->ejecutar($ssql);




if ( $rs !== false && mysql_num_rows($rs) > 0 ) {
     $sql .= '<tr>

                <td id="g1_uds">'.UDS.'</td>
                <td class="g1_articulo">'.ARTICULO.'</td>


        </tr>';

    $i =0;
    while ( $a = $bd->obtener_fila($rs,0)){
            
           if (isset($articulos[$a["articulo"]])){
              $articulos[$a["articulo"]] = $articulos[$a["articulo"]] + $a["uds"]; 
           }else{

            $articulos[$a["articulo"]] = preg_replace('/^(\d+)\.0+$/', '$1',$a["uds"]);
            $ids[$i] = $a["id_articulo"];
            $i++;
           }
    }
    
    $i=0;
     foreach ($articulos as $clave => $valor1) {
         
//                $sql .= '<tr onclick=infomods(\''.str_replace(" ", "%20", $clave).'\')>';
                 $sql .= '<tr onclick=infomods('. $ids[$i].')>';
                                
                $sql .= "<td class=\"g1_uds\">".$valor1."</td>";
                $sql .= "<td class=\"g1_articulo\">".$clave."</td>";


                $sql .= "</tr>"; 
                
                $i++;

        }


}

echo $sql;
    
    
?>