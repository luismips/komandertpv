<?php


class _acceso {
    public function panel_acceso() {

    $sql = '

<div id="panel_titulo">KomanderTPV
 <table id="tabla_idiomas"><tr> 
          <td><div class="idiomacli" style="background-image: url(\'images/es.png\');" onclick="location.href=\'?lg=es\'"></div></td>
          <td><div class="idiomacli" style="background-image: url(\'images/en.png\');" onclick="location.href=\'?lg=en\'"></div></td>
          <td><div class="idiomacli" style="background-image: url(\'images/de.png\');" onclick="location.href=\'?lg=de\'"></div></td>
          <td><div class="idiomacli" style="background-image: url(\'images/fr.png\');" onclick="location.href=\'?lg=fr\'"></div></td>
              </tr></table>  
</div>
    <form id="f_acceso" name="form_acceso" method="post" action="control.php">
        <table id="tabla_datos">
        <tr>
            <td colspan="2" align="center">
            <?
            if (isset(\$_GET["errorusuario"]))
            {
                if (\$_GET["errorusuario"]=="si")
                {
                    echo "Datos incorrectos" ;
                }
                else
                {
                    echo "Introduce tu clave de acceso ";
                }
            }
            else
            {
            echo "Esperando datos";
}
?>
</td>
        </tr>
        <tr>
            <td align="right">' .USUARIO .':</td>
            <td><input type="text" id="tusuario" name="usuario" value="" required></td>
        </tr>
        <tr>
            <td align="right">' .PASS .':</td>
            <td><input type="password" id="tcontrasena" name="contrasena" value=""></td>
        </tr>
        

        <tr>
            <td align="center"><input type="checkbox" id="chunico" name="usuariounico" value="unico" />' .RECORDAR .'</td>
            <td align="center"><input type="checkbox" id="teclado" name="teclado" value="teclado" />' .TECLADO .'</td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" id="bok" value="' .ENTRAR .'"></td>
           
        </tr>
        
        
        </table> 
    </form>



';

    return $sql;
  }
}

?>
