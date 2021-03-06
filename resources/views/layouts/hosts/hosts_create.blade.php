@extends('layouts.app')
@section('title', 'Agregar Hosting Service')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;display:inline;"><i class="fas fa-plus-circle"></i> Agregar Hosting Service </h2>
   <a href="{{url('cuentas/'.$id)}}"><button class="btn-xs btn btn-primary" type="button"><i class="fas fa-chevron-left"></i> Atrás</button></a><hr>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newhost" onsubmit="realizaProceso();return false; " >
      @csrf

      <div class="formularios " id="nuevo_host">

        <div class="col-sm-4">
            <label>Hosting Service:</label>
            <input type="text" name="hosting" id="hosting" class="form-control" required="" placeholder="Hosting Service">
         </div>

           <div class="col-sm-4">
            <label>Plan:</label>
            <input type="text" name="plan" id="plan" class="form-control" required="" placeholder="Plan">
         </div>

           <div class="col-sm-4">
            <label>URL cPanel:</label>
            <input type="text" name="url_cpanel" id="url_cpanel" class="form-control" required="" placeholder="URL cPanel">
         </div>

         <div class="col-sm-4">
            <label>Usuario:</label>
            <input type="text" name="user" id="user" class="form-control" required="" placeholder="Usuario">
         </div>
         <div class="col-sm-4">
            <label>Contraseña:</label>
            <input type="text" name="pass" id="pass" class="form-control" required="" placeholder="Contraseña">
         </div>

         <div class="col-sm-4">
            <label>Cuenta:</label>
            <input type="text" name="cuenta" id="cuenta" class="form-control" required="" placeholder="Cuenta">
         </div>

         <div class="col-sm-4">
            <label>PIN:</label>
            <input type="text" name="pin" id="pin" class="form-control" required="" placeholder="PIN">
         </div>

            <input type="hidden" name="id_Cuenta" id="id_Cuenta" value="{{$id}}">

         <div class="col-sm-12" style="margin-top:15px;">
            <div id="resultado"></div>
            <button type="submit" name="enviar" id="enviar" class="btn-primary btn-block btn">
            Guardar <i class="fas fa-check"></i>
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
         var formData = new FormData(jQuery('#newhost') [0]); //Se crea el arreglo con los datos del form
         $.ajax({
           url: '{{url('hosts')}}', // Al controlador donde van mis datos
           type: 'POST',
           contentType: false,
           processData: false, //Le dice que tipo de dato va a recibir
           dataType: 'json',
           data: formData,
           beforeSend: function() {
             $("#resultado").html('<div class="alert alert-success">Procesando...!</div>');
           }
         })
         .done(function(data, textStatus, jqXHR) {
           var getData = jqXHR.responseJSON; // vguarda los errores si los hay en la ejecucion del js

           if(data.status=='ok'){ //ver controlador, status es el nombre la clave cuando se creo
            $("#resultado").html('<div class="alert alert-success">'+data.mensaje+'</div>');
             document.getElementById("newhost").reset();
           }else{
           $("#resultado").html('<div class="alert alert-danger"><strong>ERROR!</strong>'+data.error+'</div>');
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




