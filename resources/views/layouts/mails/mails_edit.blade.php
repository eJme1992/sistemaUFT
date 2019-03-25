@extends('layouts.app')
@section('title', 'Modificar Direcci&oacute;n de Email')




@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;display:inline;"><i class="fas fa-plus-circle"></i> Modificar Direcci&oacute;n de Email </h2>
   <a href="{{url('cuentas/'.$Cuenta->slug)}}"><button class="btn-xs btn btn-primary" type="button"><i class="fas fa-chevron-left"></i> Atrás</button></a><hr>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newuser" onsubmit="realizaProceso();return false; " >
     @csrf
      @method('PUT')
      <div class="formularios " id="nuevo_mail">

        <div class="col-sm-3">
            <label>Provedor:</label>
            <select name="mail" id="mail" class="form-control" required="">
              <option  @if($mail->nombre =='Gmail') selected @endif>Gmail</option>
              <option  @if($mail->nombre =='Hotmail') selected @endif>Hotmail</option>
              <option  @if($mail->nombre =='Yahoo') selected @endif>Yahoo</option>
              <option  @if($mail->nombre =='Mi Hosting') selected @endif>Mi Hosting</option>
              <option  @if($mail->nombre =='Otro Hosting') selected @endif>Otro Hosting</option>
              <option  @if($mail->nombre =='Otro Servicio') selected @endif>Otro Servicio</option>
            </select>
         </div>
         <div class="col-sm-3">
            <label>Email:</label>
            <input type="mail" name="user" id="user" class="form-control" required="" placeholder="Email" value="{{$mail->user}}">
         </div>
         <div class="col-sm-3">
            <label>Contraseña:</label>
            <input type="text" name="pass" id="pass" class="form-control" required="" placeholder="Contraseña" value="{{$mail->pass}}">
         </div>

        <div class="col-sm-3">
            <label>Contacto:</label>
            <select name="contacto_id" id="contacto_id" class="form-control" required="">
              @foreach($contactos AS $key)
              <option value="{{$key->id}}" @if($mail->contacto_id == $key->id) selected @endif>{{$key->nombre}} {{$key->apellido}}</option>
              @endforeach
            </select>
         </div>



          <input type="hidden" name="id_Cuenta" id="id_Cuenta" value="{{$Cuenta->id}}">
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
           url: '{{url('mails/'.$mail->id)}}', // Al controlador donde van mis datos
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
                window.location.href ='{{url('mails/edit/'.$Cuenta->slug.'/'.$mail->id)}}';

            },2000); // 3000ms = 3s

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




