@extends('layouts.app')
@section('title', 'Editar redes sociales')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;display:inline;"><i class="fas fa-plus-circle"></i> Editar redes sociales </h2>
   <a href="{{url('cuentas/'.$Cuenta->slug)}}"><button class="btn-xs btn btn-primary" type="button"><i class="fas fa-chevron-left"></i> Atrás</button></a> <hr>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newuser" onsubmit="realizaProceso();return false; " >
     @csrf
      @method('PUT')
      <div class="formularios " id="nuevo_sociales">

         <div class="col-sm-3">
            <label>Red Social:</label>

          <select name="nombre" id="nombre" class="form-control" required="">
           <option @if($sociales->nombre =='Facebook') selected @endif>Facebook</option>
           <option @if($sociales->nombre == 'Facebook Messenger') selected @endif>Facebook Messenger</option>
           <option @if($sociales->nombre =='Instagram') selected @endif>Instagram</option>
           <option @if($sociales->nombre =='LinkedIn') selected @endif>LinkedIn</option>
           <option @if($sociales->nombre =='Pinterest') selected @endif>Pinterest</option>
           <option @if($sociales->nombre =='Reddit') selected @endif>Reddit</option>
           <option @if($sociales->nombre =='Skype') selected @endif>Skype</option>
           <option @if($sociales->nombre =='Snapchat') selected @endif>Snapchat</option>
           <option @if($sociales->nombre =='Tumblr') selected @endif>Tumblr</option>
           <option @if($sociales->nombre =='Twitter') selected @endif>Twitter</option>
           <option @if($sociales->nombre =='Whatsapp') selected @endif>Whatsapp</option>
           <option @if($sociales->nombre =='Youtube') selected @endif>Youtube</option>
          </select>
        </div>
           <div class="col-sm-9">
            <label>URL:</label>
            <input type="text" name="url" id="url" class="form-control" required="" placeholder="URL" value="{{$sociales->url}}">
         </div>
         <div class="col-sm-3" style="margin-top:15px;">
         	<label>Cuenta:</label>
            <input type="text" name="user" id="user" class="form-control" required="" placeholder="Cuenta" value="{{$sociales->user}}">
         </div>
         <div class="col-sm-3" style="margin-top:15px;">
         <label>Contraseña:</label>
            <input type="text" name="pass" id="pass" class="form-control" required="" placeholder="Contraseña" value="{{$sociales->pass}}">
         </div>

            </div>
          <input type="hidden" name="id" id="id" value="{{$sociales->id}}">
         <div class="col-sm-12" style="margin-top:15px;">
            <div id="resultado"></div>
            <button type="submit" name="enviar" id="enviar" class="btn-primary btn-block btn">
            Editar <i class="fas fa-check"></i>
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
           url: '{{url('sociales/'.$sociales->id)}}', // Al controlador donde van mis datos
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
  setTimeout(function(){
    window.location.href ='{{url('sociales/edit/'.$Cuenta->slug.'/'.$sociales->id)}}';
            });
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




