<?php

/**
 * Description of pagina
 *
 * @author Administrador
 */
class pagina {
    
    
   
public function encabezado() {

    $sql = <<<Enc

<div id="encabezado">
    NOMBRE Y FOTO EMPRESA
</div>

Enc;

    return $sql;
  }
  
public function menu() {

    $sql = <<<Enc

<div id="menu_main">
    <a href="index.php">INICIO</a>
    <a href="pte.php">CARTA</a>
    <a href="appsegura.php">PEDIDO</a>
    <a href="">RESERVAS</a>
    <a href="acceso.php">ACCESO</a>
    <a href="usuarios.php">CONTACTO</a>
    <a href="">SUGERENCIAS</a>
</div>

Enc;

    return $sql;
}
  
public function cuerpo() {

    $sql = <<<Enc

	<div id="cuerpo">
			<div id="noticias" class="scroll">
                            NOTICIAS
                        </div>
			<div id="galeria" class="scroll">
                            GALERIA
			</div>			
	</div>

Enc;

    return $sql;
  }

  public function pie() {

    $sql = <<<Enc

<div id="pie">
    <a href="http://komandertpv.blogspot.com">KomanderTPV luismips@gmail.com</a>
</div>

Enc;

    return $sql;
  }
  
}

?>
