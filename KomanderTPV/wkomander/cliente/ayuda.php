<?php
header('Content-type: text/html; charset=iso-8859-1');
session_start();
session_name("cliente"); 
    
if (isset($_SESSION["lang"])){
          
         include('lang/'.$_SESSION["lang"].'.php');   
          
      }
?>
<html>
    <head>
        <title>KomanderTPV - <?php echo CH_AYUDA; ?></title>
        
        <link href="ayuda.css" rel="stylesheet" type="text/css">
    </head>
    
    
    <body>
        <table width="100%">
        <table width="100%">
            <tr><td><div style="background:  #ddFFdd" onclick="location.href='#hacerPedido'" class="enlace"><?php echo CH_B1; ?></div></td>
            <td><div style="background: #ffdddd" onclick="location.href='#Borrar'" class="enlace"><?php echo CH_B2; ?></div></td>
            <td><div style="background: #ddddff" onclick="location.href='#texto'" class="enlace"><?php echo CH_B3; ?></div></td>
            <td><div style="background: #f9dd34" onclick="location.href='#estado'" class="enlace"><?php echo CH_B4; ?></div></td>
            <td><div style="background: yellow" onclick="location.href='comandacli.php?mesa=<?php echo $_SESSION["mesa"];?>&comensal=<?php echo $_SESSION["comensal"];?>&padre=0'" class="enlace"><?php echo CH_B5; ?></div></td></tr>
        </table>
        
        <table id="tabla1">
            <tr><td colspan="3"><A name="hacerPedido"></A><h1><?php echo CH_B1; ?></h1></td></tr>
            <tr><td colspan="3"><p><?php echo CH_1_1; ?></p></td></tr>
            <tr><td colspan="3"><p><?php echo CH_1_2; ?></p></td></tr>
            <tr><td><?php echo CH_1_3; ?></td>
                <td><?php echo CH_1_4; ?></td>
                <td><?php echo CH_1_5; ?></td></tr>
            <tr><td><img src="images/img1.png"></td><td><img src="images/img2.png"><td><img src="images/img3.png"></tr>
            
            
            
            <tr><td><?php echo CH_1_6; ?></td>
                <td><?php echo CH_1_7; ?></td>
                <td><?php echo CH_1_8; ?></td></tr>
            <tr><td><img src="images/img4.png"></td><td><img src="images/img5.png"><td><img src="images/img6.png"></tr>
            
            <tr><td colspan="3">
                <p><?php echo CH_1_9; ?></p>
                <p><?php echo CH_1_10; ?></p>
                <p><?php echo CH_1_11; ?></p>
                <p><?php echo CH_1_12; ?></p>
                </td></tr>
        </table>
        
        
        
        
        <table id="tabla2">
            <tr><td colspan="3"><A name="Borrar"></A><h1>BORRAR UN ARTICULO</h1></td></tr>
            <tr><td colspan="3"><p>Se puede borrar un plato o bebida de la lista de pedidos siempre que NO se haya
                        enviado.</p></td></tr>
            <tr><td colspan="3"><p>En el siguiente ejemplo, eliminaremos de la lista
                        un SOLOMILLO DE CERDO con ENSALADA que acabamos de pedir:</p></td></tr>
            <tr><td>Pulsamos sobre el plato o bebida en la lista del pedido...</td>
                <td>...en el cuadro de dialogo que aparece, pulsamos BORRAR...</td>
                <td>...y desaparece de la lista.</td></tr>
            <tr><td><img src="images/img7.png"></td><td><img src="images/img8.png"><td><img src="images/img9.png"></tr>
            
            <tr><td colspan="3"><p>Consulte a su camarero si necesita eliminar algun plato o bebida que ya hayan sido enviados.</p></td></tr>
            
            
           
        </table>
        
        
        <table id="tabla3">
            <tr><td colspan="3"><A name="texto"></A><h1>TEXTO ADICIONAL</h1></td></tr>
            <tr><td colspan="3"><p>Si lo necesita, puede agregar comentarios a los platos o bebidas.
                    De ese modo nuestro personal puede saber como debe ir preparado su pedido.</p></td></tr>
            <tr><td colspan="3"><p>En el ejemplo, adjuntamos un comentario a una botella de agua para que
                    el camarero de la barra sepa que la queremos del tiempo:</p></td></tr>
            <tr><td>Pulsamos sobre el plato o bebida en la lista del pedido...</td>
                <td>...en el cuadro de dialogo que aparece, pulsamos TEXTO...</td>
                <td>...introducimos nuestro comentario y pulsamos OK.</td></tr>
            <tr><td><img src="images/img10.png"></td><td><img src="images/img11.png"><td><img src="images/img12.png"></tr>
            
            <tr><td colspan="3"><p>Ahora el camarero de barra puede ver que usted necesita una
                         botella de agua, pero sin enfriar.</p></td></tr>
            
            
           
        </table>
        
        
        <table id="tabla4">
            <tr><td colspan="3"><A name="estado"></A><h1>ESTADO DE LOS PEDIDOS</h1></td></tr>
            <tr><td colspan="3"><p>Puede controlar en que estado se encuentra su pedido revisando la lista.</p></td></tr>
            <tr><td colspan="3"><p>Dependiendo del color de fondo de cada linea se puede saber su estado:</p></td></tr>
        
            
            <tr><td colspan="2"><img src="images/img13.png"></p></td>
                <td>
            <p>BLANCO: El pedido se esta preparando o aun no se ha enviado.</p>
            <p>VERDE: El pedido esta preparado en barra o cocina.</p>
            <p>GRIS: El pedido se ha entregado en mesa.</p>
                </td>
            </tr>
            
            
           
        </table>
        
        
        
        </table> 
    </body>
    
    
    
    
    
</html>