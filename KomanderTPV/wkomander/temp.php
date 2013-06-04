
require 'clases/includes.php';


$bd=Db::getInstance(); 

$bd->ejecutar($ssql);


if ( $rs !== false && mysql_num_rows($rs) > 0 ) {


$bd->obtener_fila($rs,0)){