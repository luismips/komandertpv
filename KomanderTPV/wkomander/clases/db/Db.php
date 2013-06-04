<?php
require 'Conf.class.php';
/* Clase encargada de gestionar las conexiones a la base de datos */
class Db{
    private $servidor;
    private $usuario;
    private $password;
    private $base_datos;
    private $link;
    private $stmt;
    private $array;
    static $_instance;
   
    /*La función construct es privada para evitar que el objeto pueda ser creado mediante new*/
    private function __construct(){
        $this->setConexion();
        $this->conectar();
       
    }
    /*Método para establecer los parámetros de la conexión*/
    private function setConexion(){
        $conf = Conf::getInstance();
        $this->servidor=$conf->getHostDB();
        $this->base_datos=$conf->getDB();
        $this->usuario=$conf->getUserDB();
        $this->password=$conf->getPassDB();
    }
    /*Evitamos el clonaje del objeto. Patrón Singleton*/
    private function __clone(){ }
    
    /*Función encargada de crear, si es necesario, el objeto. Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, y así, poder utilizar sus métodos*/
    public static function getInstance(){
        if (!(self::$_instance instanceof self)){
            self::$_instance=new self();
        }
        return self::$_instance;
    }
    /*Realiza la conexión a la base de datos.*/
    private function conectar(){
        $this->link=mysql_connect($this->servidor, $this->usuario, $this->password);
        mysql_select_db($this->base_datos,$this->link);
    //    @mysql_query(“SET NAMES ‘utf8′”);
        }
    /*Método para ejecutar una sentencia sql*/
    public function ejecutar($sql){
        $this->stmt=mysql_query($sql,$this->link);
        return $this->stmt;
    }
    
    //insertar
//$sql=insert into nombre_tabla (columa1, col2,...) values (valor1, valor2,...)
 public function insertar($sql){ 
      $this->stmt=mysql_query($sql,$this->link); 
      return $this->stmt; 
   } 
   
//actualizar
//$sql=update nombre_tabla set col1=dato1,col2=dato2
 public function actualizar($sql){ 
      $this->stmt=mysql_query($sql,$this->link); 
      return $this->stmt; 
   } 

//borrar
//$sql=delete from nombre_tabla where col1= dato1
 public function borrar($sql){ 
      $this->stmt=mysql_query($sql,$this->link); 
      return $this->stmt; 
   } 



    /*Método para obtener una fila de resultados de la sentencia sql*/
    public function obtener_fila($stmt,$fila){
        if ($fila==0){
            $this->array=mysql_fetch_array($stmt);
        }else{
            mysql_data_seek($stmt,$fila);
            $this->array=mysql_fetch_array($stmt);
        }
        return $this->array;
    }
    
    public function numRows($sql){
	 $this->stmt=mysql_query($sql,$this->link);
         return $this->stmt; 
    }
    //Devuelve el último id del insert introducido
    public function lastID(){
        return mysql_insert_id($this->link);
    }
}
?>