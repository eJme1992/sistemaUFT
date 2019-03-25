@extends('layouts.app')
@section('title', 'Modificar Contacto')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;display:inline;"><i class="fas fa-plus-circle"></i> Modificar Contacto </h2>
   <a href="{{url('cuentas/'.$Cuenta->slug)}}"><button class="btn-xs btn btn-primary" type="button"><i class="fas fa-chevron-left"></i> Atrás</button></a>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newuser" onsubmit="realizaProceso();return false; " >
     @csrf
      @method('PUT')
      <div class="formularios " id="nuevo_contacto">

         <div class="col-sm-6">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required="" placeholder="Nombre" value="{{$contacto->nombre}}">
         </div>
         <div class="col-sm-6">
            <label>Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required="" placeholder="Apellido" value="{{$contacto->apellido}}">
         </div>
         <div class="col-sm-6">
            <label>Tipo</label>
            <select class="form-control" id="tipo" name="tipo" required="">
              <option value="Principal"   @if($contacto->tipo==='Principal') selected @endif>Principal</option>
              <option value="Secundario" @if($contacto->tipo==='Secundario') selected @endif>Secundario</option>
            </select>
         </div>
       <div class="col-sm-6">
            <label>Cargo:</label>
            <input type="text" name="cargo" id="cargo" class="form-control" required="" placeholder="Cargo" value="{{$contacto->cargo}}">
         </div>
         <div class="col-sm-6">
           <label>Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" value="{{$contacto->telefono}}">
         </div>

        <input type="hidden" name="id_Cuenta" id="id_Cuenta" value="{{$Cuenta->id}}">

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
         var formData = new FormData(jQuery('#newuser') [0]); //Se crea el arreglo con los datos del form
         $.ajax({
           url: '{{url('contactos/'.$contacto->id)}}', // Al controlador donde van mis datos
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
             document.getElementById("newuser").reset();
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




