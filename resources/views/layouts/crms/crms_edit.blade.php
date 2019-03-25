@extends('layouts.app')
@section('title', 'Modificar Usuario de CRM')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;display:inline;"><i class="fas fa-plus-circle"></i> Modificar Usuario de CRM </h2>
   <a href="{{url('cuentas/'.$Cuenta->slug)}}"><button class="btn-xs btn btn-primary" type="button"><i class="fas fa-chevron-left"></i> Atrás</button></a>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newuser" onsubmit="realizaProceso();return false; " >
     @csrf
      @method('PUT')
      <div class="formularios " id="nuevo_crm">
        <div class="formularios " id="nuevo_crm">
        <div class="col-sm-4">
            <label>Contacto:</label>
            <select name="contacto_id" id="contacto_id" class="form-control" required="">
              @foreach($contactos AS $key)
              <?php
              if($crm->contacto_id == $key->id){
                $var = 'selected ';
                 }else{
                $var = '';} ?>
              <option value="{{$key->id}}" {{$var}}>{{$key->nombre}} {{$key->apellido}}</option>
              @endforeach
            </select>
        </div>

         <div class="col-sm-4">
            <label>Usuario:</label>
            <input type='text' name="user" id="user" class="form-control" required="" placeholder="Usuario" value="{{$crm->user}}">
         </div>
         <div class="col-sm-4">
            <label>Contraseña:</label>
            <input type="text" name="pass" id="pass" class="form-control" required="" placeholder="Contraseña" value="{{$crm->pass}}">
         </div>

          <div class="col-sm-4">
            <label>Roles:</label>
            <input type="text" name="roles" id="roles" class="form-control" required="" placeholder="Roles" value="{{$crm->roles}}">
         </div>

          <div class="col-sm-4">
            <label>Grupo de Seguridad:</label>
            <input type="text" name="seguridad" id="seguridad" class="form-control" required="" placeholder="Grupo de Seguridad" value="{{$crm->seguridad}}">
         </div>

         <div class="col-sm-4">
            <label>Email Asociado:</label>
                    <select class="form-control text" id="mail_id" name="mail_id" required="">
                      @foreach($mails AS $key)
                       <option value="{{$key->id}}" @if($crm->mail_id == $key->id) selected @endif> {{$key->user}}</option>
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
           url: '{{url('crms/'.$crm->id)}}', // Al controlador donde van mis datos
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

            window.location.href ='{{url('crms/edit/'.$Cuenta->slug.'/'.$crm->id)}}';

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

<script type="text/javascript">
  $( document ).ready(function() {
 $("#contacto_id").change(function (event) {
   var id = $("#contacto_id").find(':selected').val();

     //$.get('backoffice/Regiones/select?id2=' + id, function (data) {
     $.get(' {{url('crms/mails')}}' + '/' + id, function (data) {
       var texto = data;
        var textoUtf8 = "";
          try {
           textoUtf8 = decodeURIComponent(escape(texto));
            } catch (err) {
             alert(err.message);
              textoUtf8 = texto;
            }
                $("#mail_id").html(textoUtf8);
                console.log(data);

            });
  });
});
</script>
@endsection




