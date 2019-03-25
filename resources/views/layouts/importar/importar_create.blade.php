@extends('layouts.app')
@section('title', 'Nuevo cliente')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;display:inline;"><i class="fas fa-upload"></i> Importar registros </h2>
   <a href="{{url('/home')}}"><button class="btn-xs btn btn-primary" type="button"><i class="fas fa-chevron-left"></i> Atrás</button></a><hr>





<form id="newuser" onsubmit="realizaProceso();return false; " >
     @csrf
    
      <div class="col-md-12">
        <label>
          Cuentas de clientes 
        </label> <p> (El archivo que se suba debe ser un CVS-archivo separado por comas con el siguiente formato <a href="{{url('/archivos/ejemplo.csv')}}"><b>Archivo_ejemplo</b></a> el cual debe tener todos sus campos llenos.) </p>
        <input type="file" name="excel" id="excel" class="form-control" required="">      
      </div>
    
         <div class="col-sm-12" style="margin-top:15px;">
            <div id="resultado"></div>
            <div id="boton1">
            <button type="submit" name="enviar" id="enviar" class="btn-primary btn-block btn">
            Procesar <i class="fas fa-check"></i>
            </button> 
            </div>
         </div>
   
   </form>
</div>


<script type="text/javascript"> 
  function realizaProceso() {
         
             var msj = '1'; 
         //validaciones con js
         
         if (msj === "1") { //tres igual para decir que es identico
         var formData = new FormData(jQuery('#newuser') [0]); //Se crea el arreglo con los datos del form
         $.ajax({
           url: '{{url('cuentas/cargar')}}', // Al controlador donde van mis datos 
           type: 'POST', 
           contentType: false,
           processData: false, //Le dice que tipo de dato va a recibir
           dataType: 'json',
           data: formData,  
           beforeSend: function() {
             $("#resultado").html('<div class="alert alert-success">Procesando...!</div>');
             $("#boton1").html('<button disabled="" onclick="realizaProceso();return false; " type="button" name="enviar" id="enviar" class="btn-primary btn-block btn">Procesando <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></button> ');
           }
         })
         .done(function(data, textStatus, jqXHR) {
           var getData = jqXHR.responseJSON; // vguarda los errores si los hay en la ejecucion del js
         
           if(data.status=='ok'){ //ver controlador, status es el nombre la clave cuando se creo
            $("#resultado").html('<div class="alert alert-success">'+data.mensaje+'</div>'); 
            setTimeout(function(){
             $("#boton1").html('<button type="submit" name="enviar" id="enviar" class="btn-primary btn-block btn">Procesar <i class="fas fa-check"></i></button>');
            },2000); // 3000ms = 3s
            
           }else{
           $("#resultado").html('<div class="alert alert-danger"><strong>ERROR!</strong>'+data.mensaje+'</div>');
              $("#boton1").html('<button type="submit" name="enviar" id="enviar" class="btn-primary btn-block btn">Procesar <i class="fas fa-check"></i></button>');
           }
         })
                .fail(function(data, textStatus, errorThrown) { //Si ocurre errores el jquery
                    var errorsHtml = '';
                                var errors = data.responseJSON;
                                $.each(errors, function (key, value) {
                                   if(key!='message') {
                                    $.each(value, function (key1, value1){
                                    errorsHtml += value1;
                                  });
                                  }
                                });
                                
                 $("#resultado1").html('<div class="alert alert-danger"><strong>ERROR! </strong>'+errorsHtml +' </div>');        
               })
          // Fin de ajax
          } else {
              swal("¡Error! ", msj, "error");
          }
           };
</script>
<style type="text/css">
   .ocultar{
   display: none;
   }
   span{
   margin-right:15px; margin-left:15px;
   }
   .col-sm-6,.col-sm-12,.col-sm-4{
   margin-top:15px;
   }
</style>
@endsection




