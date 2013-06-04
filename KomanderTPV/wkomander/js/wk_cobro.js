        $(document).ready(function(){
            $(".qwerty").keyboard({
                    position:{
                        at: 'center bottom'
                    }
                });
            
           $("#body_cobro").ready(function(){
             
 
               $("#tTarjeta").hide("normal"); //slow, normal y fast
               $("#lTarjeta").hide("normal");
               $("#tEfectivo").hide("normal");
               $("#lEfectivo").hide("normal");
               $("#tEntregado").hide("normal");
               $("#lEntregado").hide("normal");
               $("#tCambio").hide("normal");
               $("#lCambio").hide("normal");    
               
           });
           
           
           
           $("#bEfectivo").click(function(evento){
               $("#tipo_cobro").val("E");

               $("#tTarjeta").hide("normal"); //slow, normal y fast
               $("#lTarjeta").hide("normal");
               $("#tEfectivo").hide("normal");
               $("#lEfectivo").hide("normal");
               $("#tEntregado").show("normal");
               $("#lEntregado").show("normal");
               $("#tCambio").show("normal");
               $("#lCambio").show("normal");

           });
           
           $("#bTarjeta").click(function(evento){
                $("#tipo_cobro").val("T");
               $("#tTarjeta").hide("normal"); //slow, normal y fast
               $("#lTarjeta").hide("normal");
               $("#tEfectivo").hide("normal");
               $("#lEfectivo").hide("normal");
               $("#tEntregado").hide("normal");
               $("#lEntregado").hide("normal");
               $("#tCambio").hide("normal");
               $("#lCambio").hide("normal");
               
           });
           
           
           $("#bParcial").click(function(evento){
               $("#tipo_cobro").val("P");
               $("#tTarjeta").show("normal"); //slow, normal y fast
               $("#lTarjeta").show("normal");
               $("#tEfectivo").show("normal");
               $("#lEfectivo").show("normal");
               $("#tEntregado").show("normal");
               $("#lEntregado").show("normal");
               $("#tCambio").show("normal");
               $("#lCambio").show("normal");
               
           });
           
        });
        
        
function entregado(decimal){        


       var total = parseFloat(tTotal.value.replace(/,/g,""));
       var entregado = parseFloat(tEntregado.value.replace(/,/g,""));
        var efectivo = parseFloat(tEfectivo.value.replace(/,/g,""));
        var cambio = 0.00;

       if (tipo_cobro.value == "E"){
           cambio = parseFloat(entregado - total);
       }else{
           cambio = parseFloat(entregado - efectivo);
       }
       
       
       if (decimal == 'S'){
         tCambio.value = cambio.toFixed(2);  
       }else{
         tCambio.value = cambio.toFixed(0);  
       }
      

    
}

function efectivo(decimal){  

   var total = parseFloat(tTotal.value.replace(/,/g,""));
   var efectivo = parseFloat(tEfectivo.value.replace(/,/g,""));
   var tarjeta = parseFloat(tTarjeta.value.replace(/,/g,""));
   var entregado = parseFloat(tEntregado.value.replace(/,/g,""));

   //alert(tTotal.value.replace(/,/g,""));
    if (decimal == 'S'){
         tTarjeta.value = (total - efectivo).toFixed(2); 
       }else{
         tTarjeta.value = (total - efectivo).toFixed(0);  
       }

}
           
        
function mesas(){
        location.href="mesas.php";
}

function tiket(){
      location.href="tiket.php";
}

function volver(){
        location.href="controltrasp.php?&desdecobro=si";
}
