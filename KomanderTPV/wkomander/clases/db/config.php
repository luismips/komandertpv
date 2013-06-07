<?php
//datos db
$host='localhost'; //ruta MySQL
$user='root';//usuario MySQL
$password='zxcvbnm';//contraseña usuario
$db='wkomander';//nombre de la base de datos
$domain = 'localhost'; //no usado

define('_WK_VERSION_', '0.9.1.130607');//versión
define('_FECHA_VERSION_', '07/06/2013');//fecha de la version

define('_IDIOMA_', 'es');//idioma por defecto [es, en, de, fr]

define('_DOMAIN_', '192.168.1.100');//URL del sistema (IP o dominio)
define('_APP_FOLDER_', 'wkomander');//nombre de la carpeta principal en www
define('_IMAGES_PATH_', 'images');//directorio de imagenes
define('_COBRO_EFECTIVO_', 'S');//no usado
define('_TECLADO_VIRTUAL_', 'S');//si accede desde un PC táctil sin teclado
define('_IMPRESORAS_', 'S');//si usa impresoras para recibir pedidos 
define('_PROPINA_', 0);//propina por defecto en %
define('_DESCUENTO_', 0);//descuento por defecto en %
define('_DECIMALES_', 'S');//si usa decimales S/N
define('_MONEDA_', '&#8364'); //poner codigo html para moneda
define('_EMPRESA_', 2);//id de la empresa seleccionada en tabla empresa
define('_CLAVE_WIFI_', '12345abcd');
define('_NOMBRE_WIFI_', 'KomanderTPV');
define('_WEB_CLIENTE_', 'http://192.168.1.100');

//VISORES
define('_LINEAS_VISOR_', 20);//numero de líneas que aparecen en el visor
define('_TIMER_VISOR_', 10000);//tiempo de refresco del visor

//REPARTO
define('_PRECIO_REPARTO_', 1);//precio adicional a incluir si es un reparto


//GSPRINT PATH
define('_GSPRINT_', 'C:\Ghostgum\gsview\gsprint.exe');
?>
