<?php


/**
 * Description of conexion
 *
 * @author luismips
 */
class conexion {

  
   public function parse_decimal($num){
        if (_DECIMALES_=="S"){
            $num = number_format($num, 2, ',', '.');
        }else{
            $num = number_format($num, 0, ',', '.');
        }
        
        return $num;
        
    }
    //271212 1120 - creada para cuando se inserta numero en la db, ya ke
    //el simbolo decimal mysql debe ser . y no ,
    public function knumber($num){
        if (_DECIMALES_=="S"){
            
            $num = number_format($num, 2, '.', ',');
        }else{
            $num = number_format($num, 0, '.', ',');
        }
        
        return $num;
        
    }
    
    function rand_string( $length ) {
	$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

	$size = strlen( $chars );
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}


}

?>
