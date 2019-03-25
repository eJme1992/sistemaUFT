@extends('layouts.app')
@section('title', 'Modificar Sitio Web')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;display:inline;"><i class="fas fa-plus-circle"></i> Modificar Sitio Web </h2>
   <a href="{{url('cuentas/'.$Cuenta->slug)}}"><button class="btn-xs btn btn-primary" type="button"><i class="fas fa-chevron-left"></i> Atrás</button></a><hr>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newuser" onsubmit="realizaProceso();return false; " >
     @csrf
      @method('PUT')
      <div class="formularios " id="nuevo_web">

        <div class="col-sm-4">
            <label>Hosting Service:</label>
            <select name="host_id" id="host_id" class="form-control" required="">
              @foreach($hosts AS $key)
               <option value="{{$key->id}}" @if($web->host_id == $key->id) selected @endif >{{$key->hosting}}</option>
              @endforeach
            </select>
         </div>

         <div class="col-sm-4">
            <label>Base de Datos:</label>
            <select name="db_id" id="db_id" class="form-control" required="">
              @foreach($dbs AS $key)
              <option value="{{$key->id}}" @if($web->db_id == $key->id) selected @endif> {{$key->name}}</option>
              @endforeach
            </select>
         </div>

         <div class="col-sm-4">
            <label>Desarrollo:</label>
            <select name="tipo" id="tipo" class="form-control" required="">
              <option @if($web->tipo =='Wordpress') selected @endif>Wordpress</option>
              <option @if($web->tipo =='Drupal') selected @endif>Drupal</option>
              <option @if($web->tipo =='Joomla') selected @endif>Joomla</option>
              <option @if($web->tipo =='PrestaShop') selected @endif>PrestaShop</option>
              <option @if($web->tipo =='Magento') selected @endif>Magento</option>
              <option @if($web->tipo =='Tienda Nube') selected @endif>Tienda Nube</option>
              <option @if($web->tipo =='.NET') selected @endif>.NET</option>
              <option @if($web->tipo =='PHP') selected @endif>PHP</option>
              <option @if($web->tipo =='HTML5') selected @endif>HTML5</option>
              <option @if($web->tipo =='Desarrollo Web') selected @endif>Desarrollo Web</option>
              <option @if($web->tipo =='Otro') selected @endif>Otro</option>
            </select>
         </div>

         <div class="col-sm-4">
            <label>Tipo:</label>
            <select name="tipo_p" id="tipo_p" class="form-control" required="">
              
      <option @if($web->tipo_p =='Página Web') selected @endif>Página Web</option>
      <option @if($web->tipo_p =='Página Landing') selected @endif>Página Landing</option>
      <option @if($web->tipo_p =='Micro Sitio') selected @endif>Micro Sitio</option>
      <option @if($web->tipo_p =='Ecommerce') selected @endif>Ecommerce</option>
      <option @if($web->tipo_p =='Otro') selected @endif>Otro</option>
            </select>
         </div>

 
      <div class="col-sm-4" id="pagoss" @if($web->tipo_p !=='Ecommerce') style="display:none" @endif>
            <label>Pago:</label>
            <select name="pagos" id="pagos" class="form-control" required="">
              
      <option @if($web->pagos =='Mercado Pago') selected @endif>Mercado Pago</option>
      <option @if($web->pagos =='Todo Pago') selected @endif>Todo Pago</option>
      <option @if($web->pagos =='PayPal') selected @endif>PayPal</option>
      <option @if($web->pagos =='Otro') selected @endif>Otro</option>
            </select>
         </div>

         <div class="col-sm-4">
            <label>URL:</label>
            <input type="text" name="url" id="url" class="form-control" required="" placeholder="URL" value="{{$web->url}}">
         </div>

         <div class="col-sm-4">
            <label>URL Admin:</label>
            <input type="text" name="url_admin" id="url_admin" class="form-control" required="" placeholder="URL Admin" value="{{$web->url_admin}}">
         </div>

          <div class="col-sm-4">
            <label>Usuario:</label>
            <input type="text" name="user" id="user" class="form-control" required="" placeholder="Usuario" value="{{$web->user}}">
         </div>

         <div class="col-sm-4">
            <label>Contraseña:</label>
            <input type="text" name="pass" id="pass" class="form-control" required="" placeholder="Contraseña" value="{{$web->pass}}">
         </div>


          <input type="hidden" name="id" id="id" value="{{$web->id}}">
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
  $(document).ready(function(){
     $("#tipo_p").change(function(){cambiar();});
  function cambiar(){
  var valor = $('#tipo_p').val();
  if (valor==='Ecommerce') {
    
    $('#pagoss').show("slow");
  }else{
        console.log('ocultar')
    $('#pagoss').hide("slow"); //oculto mediante id
  }
}
});
</script>

<script type="text/javascript">
  function realizaProceso() {

             var msj = '1';
         //validaciones con js

         if (msj === "1") { //tres igual para decir que es identico
         var formData = new FormData(jQuery('#newuser') [0]); //Se crea el arreglo con los datos del form
         $.ajax({
           url: '{{url('webs/'.$web->id)}}', // Al controlador donde van mis datos
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
              window.location.href ='{{url('webs/edit/'.$Cuenta->slug.'/'.$web->id)}}';
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




