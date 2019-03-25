@extends('layouts.app')
@section('title', 'Agregar usuarios')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;"><i class="fas fa-plus-circle"></i> Agregar usuario </h2><hr>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newusuarios" onsubmit="realizaProceso();return false;">
      @csrf
      <div id="resultado"></div>
      <div class="formularios" id="nuevo_usuarios">
      
            <div class="col-sm-6">
                <label>Usuarios:</label>
                <input type="text" name="name" id="name" class="form-control" required="" placeholder="Usuarios">
            </div>


            <div class="col-sm-6">
                <label>Email:</label>
                <input type="mail" name="email" id="email" class="form-control" required="" placeholder="Email">
            </div>



            <div class="col-sm-6">
                <label>Contrase&ntilde;a:</label>
                <input type="password" name="password" id="password" class="form-control" required="" placeholder="Contrase&ntilde;a">
            </div>

            <div class="col-sm-6">
               <label>Tipo:</label>
               <select name="tipo" id="tipo" class="form-control" required="">
               <option value="1">ADMIN</option>
               <option value="2">USER</option>
            </select>
            </div>

         <div class="col-sm-12" style="margin-top:15px;">
            <div id="resultado1"></div>
            <div id="boton1">
            <button  type="submit" name="enviar" id="enviar" class="btn-primary btn-block btn">
            Guardar <i class="fas fa-check"></i>
            </button>
           </div>
         </div>
     
      </div>
   </form>
</div>


<script type="text/javascript">
  function realizaProceso() {

             var msj = '1';
         //validaciones con js

         if (msj === "1") { //tres igual para decir que es identico
         var formData = new FormData(jQuery('#newusuarios') [0]); //Se crea el arreglo con los datos del form
         $.ajax({
           url: '{{url('usuarios')}}', // Al controlador donde van mis datos
           type: 'POST',
           contentType: false,
           processData: false, //Le dice que tipo de dato va a recibir
           dataType: 'json',
           data: formData,
           beforeSend: function() {
             $("#resultado1").html('<div class="alert alert-success">Procesando...!</div>');
             $("#boton1").html('<button disabled="" onclick="realizaProceso();return false; " type="button" name="enviar" id="enviar" class="btn-primary btn-block btn">Crear <i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></button> ');
           }
         })
         .done(function(data, textStatus, jqXHR) {
           var getData = jqXHR.responseJSON; // vguarda los errores si los hay en la ejecucion del js

           if(data.status=='ok'){ //ver controlador, status es el nombre la clave cuando se creo
            $("#resultado1").html('<div class="alert alert-success">'+data.mensaje+'</div>'); //

             document.getElementById("newusuarios").reset();

             $("#boton1").html('<button onclick="realizaProceso();return false; " type="button" name="enviar" id="enviar" class="btn-primary btn-block btn">Crear <i class="fas fa-check"></i></button> ');
           }else{
           $("#resultado1").html('<div class="alert alert-danger"><strong>ERROR!</strong>'+data.error+'</div>');
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
                 $("#boton1").html('<button onclick="realizaProceso();return false; " type="button" name="enviar" id="enviar" class="btn-primary btn-block btn">Crear <i class="fas fa-check"></i></button> ');

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




