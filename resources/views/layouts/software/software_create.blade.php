@extends('layouts.app')
@section('title', 'Agregar Software')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;"><i class="fas fa-plus-circle"></i> Agregar Software </h2><hr>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newSoftware" onsubmit="realizaProceso();return false;">
      @csrf
      <div id="resultado"></div>
      <div class="formularios" id="nuevo_Software">
         <div class="col-sm-4">
            <label>Software:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required="" placeholder="Software">
         </div>
          <div class="col-sm-4">
            <label>Estado:</label>
           <select name="estado" id="estado" class="form-control" required="">
               <option value="activo">Activo</option>
               <option value="inactivo">Inactivo</option>
            </select>
         </div>
         <div class="col-sm-4">
            <label>Sitio Web:</label>
            <input type="text" name="sitio_web" id="sitio_web" required="" class="form-control" placeholder="Sitio Web">
         </div>
         <div class="col-sm-12">
            <label>Descripci&oacute;n:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required=""></textarea>
         </div>
         <div class="col-sm-4">
            <label>Email:</label>
            <input type="mail" name="email" id="email" class="form-control" required="" placeholder="Correo">
         </div>
          <div class="col-sm-4">
            <label>Usuario:</label>
             <input type="text" name="usuario" id="usuario" class="form-control" required="" placeholder="Usuario">
         </div>
        <div class="col-sm-4">
            <label>Contrase&ntilde;a:</label>
             <input type="text" name="clave" id="clave" class="form-control" required="" placeholder="Contrase&ntilde;a">
         </div>

         <div class="col-sm-4">
		 		    <label>Tipo:</label>
		 		    <select name="tipo" id="tipo" class="form-control" required="">
		 		       <option value="0">Seleccionar</option>
		 		       <option>Gratis</option>
		 		       <option>Pago</option>
		 		    </select>
		          </div>

         <div class="col-sm-4">
            <label>Modalidad:</label>
            <select name="modalidad" id="modalidad" class="form-control" required="">
               <option value="0">Seleccionar</option>
               <option>Mensual</option>
               <option>Anual</option>
               <option>24 Meses</option>
               <option>36 Meses</option>
               <option>Otro</option>
            </select>
         </div>

         <div class="col-sm-4">
            <label>Medio de Pago:</label>
            <select name="pago" id="pago" class="form-control" required="">
               <option value="0">Seleccionar</option>
               <option>Efectivo</option>
               <option>VISA</option>
               <option>MasterCard</option>
               <option>PayPal</option>
               <option>Otro</option>
            </select>
         </div>


          <div class="col-sm-4">
            <label>Fecha de Suscripci&oacute;n:</label>
            <input type="date" name="fecha_suscripcion" id="fecha_suscripcion" required="" class="form-control" placeholder="Fecha suscripcion">
        </div>

        <div class="col-sm-4">
            <label>Fecha de Renovaci&oacute;n:</label>
            <input type="date" name="fecha_renovacion" id="fecha_renovacion"  class="form-control" placeholder="Fecha renovacion">
        </div>
       
        <div class="col-sm-4">
            <label>Fecha de cancelacion:</label>
            <input type="date" name="fecha_de_cancelacion" id="fecha_de_cancelacion"  class="form-control" placeholder="fecha de Cancelacion">
        </div>

      
		<div class="col-sm-12">
		            <label>Observaciones:</label>
		            <textarea name="observaciones" id="observaciones" class="form-control" required=""></textarea>
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
         var formData = new FormData(jQuery('#newSoftware') [0]); //Se crea el arreglo con los datos del form
         $.ajax({
           url: '{{url('software')}}', // Al controlador donde van mis datos
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

             document.getElementById("newSoftware").reset();

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

   function ocultar(){
   document.getElementById("fpagos").className -= " ocultar";
   }
   function mostrar(){
   document.getElementById("fpagos").className += " ocultar";
   }

   function sidatos(){
   document.getElementById("datos").className -= " ocultar";
   }
   function nodatos(){
   document.getElementById("datos").className += " ocultar";
   }

   $('#tipo').change(function(){
    var valorCambiado =$(this).val();
    if((valorCambiado !== 'Gratis')){
       ocultar();
     }
     else
     {
       mostrar();
     }
    });
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




