@extends('layouts.app')
@section('title', 'Modificar Software')



@section('content')
<!-- MODAL ELIMINAR -->
<div id="baja{{$Software->id}}" class="modal fade " role="dialog">
   <div class="modal-dialog" style="margin-top:10vw;">
      <!-- Modal content-->
      <div class="modal-content">
        <form method="POST" action="{{url('software/baja')}}" >
         <div class="modal-body text-center">
            <h3> ¿Esta Seguro que desea @if($Software->estado!='activo') activar @else dar de baja @endif  al Software: <b><?=$Software->nombre;?></b>?</h3>

         <input type="hidden" name="id" id="id" value='{{$Software->id}}'>
         </div>
         <div class="modal-footer">

               @csrf

               <button type="submit" class="btn btn-danger">Si</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

         </div>
           </form>
      </div>
   </div>
</div>
<!-- FIN MODAL ELIMINAR -->




<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;">Software: {{$Software->nombre}}</h2>
<br>
<button class="btn btn-success" type="button" id="editar" onclick="sidatos();">Editar</button>
<button class="btn btn-warning ocultar" type="button" id="cancelar" onclick="nodatos();">Cancelar edicion</button>
<button type="button" class="btn btn-primary " ata-title="Delete" data-toggle="modal" data-target="#baja<?=$Software->id;?>">
                  @if($Software->estado!='activo') <i class="fas fa-chevron-circle-up"></i> Activar @else <i class="fas fa-chevron-circle-down"></i> Baja @endif

                </button>
   <hr>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newSoftware" onsubmit="realizaProceso();return false;">
  <!--  <form action="{{url('software/'.$Software->id)}}" method="POST">-->
      @csrf
      @method('PUT')
      <div id="resultado"></div>
      <div class="formularios" id="nuevo_Software">
         <div class="col-sm-6">
            <label>Software:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required="" placeholder="Software" value="{{$Software->nombre}}">
         </div>
         <div class="col-sm-6">
            <label>Sitio web:</label>
            <input type="text" name="sitio_web" id="sitio_web" required="" class="form-control" placeholder="Sitio web" value="{{$Software->sitio_web}}">
         </div>
          <div class="col-sm-12">
            <label>Descripci&oacute;n:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required="">{{$Software->descripcion}}</textarea>
         </div>
         <div class="col-sm-4">descripcion
            <label>Email:</label>
            <input type="mail" name="email" id="email" class="form-control" required="" placeholder="Email" value="{{$Software->email}}">
         </div>

          <div class="col-sm-4">
            <label>Usuario:</label>
             <input type="text" name="usuario" id="usuario" class="form-control" required="" placeholder="Usuario" value="{{$Software->usuario}}">
         </div>

        <div class="col-sm-4">
            <label>Contrase&ntilde;a:</label>
             <input type="text" name="clave" id="clave" class="form-control" required="" placeholder="Contrase&ntilde;a" value="{{$Software->clave}}">
         </div>

         <div class="col-sm-4">
            <label>Tipo:</label>
            <select name="tipo" id="tipo" class="form-control" required="">
               <option @if($Software->tipo=='Gratis') selected @endif>Gratis</option>
               <option @if($Software->tipo=='Pago') selected @endif>Pago</option>
            </select>
         </div>
         <div class="col-sm-4">
            <label>Modalidad:</label>
            <select name="modalidad" id="modalidad" class="form-control" required="">
               <option @if($Software->modalidad=='Mensual') selected @endif>Mensual</option>
               <option @if($Software->modalidad=='Anual') selected @endif>Anual</option>
               <option @if($Software->modalidad=='24 Meses') selected @endif>24 Meses</option>
               <option @if($Software->modalidad=='36 Meses') selected @endif>36 Meses</option>
               <option @if($Software->modalidad=='Otro') selected @endif>Otro</option>
            </select>
         </div>

         <div class="col-sm-4">
            <label>Medio de Pago:</label>
            <select name="pago" id="pago" class="form-control" required="">
               <option @if($Software->pago=='Efectivo') selected @endif>Efectivo</option>
               <option @if($Software->pago=='VISA') selected @endif>VISA</option>
               <option @if($Software->pago=='MasterCard') selected @endif>MasterCard</option>
               <option @if($Software->pago=='PayPal') selected @endif>
                PayPal
               </option>
               <option @if($Software->pago=='Otro') selected @endif>Otro</option>
            </select>
         </div>


          <div class="col-sm-4">
            <label>Fecha suscripcion:</label>
            <input type="date" name="fecha_suscripcion" id="fecha_suscripcion" required="" class="form-control" placeholder="Fecha suscripcion" value="{{$Software->fecha_suscripcion}}">
        </div>

        <div class="col-sm-4">
            <label>Fecha renovacion:</label>
            <input type="date" name="fecha_renovacion" id="fecha_renovacion"  class="form-control" placeholder="Fecha renovacion" value="{{$Software->fecha_renovacion}}">
        </div>
        
        <div class="col-sm-4">
            <label>Fecha de cancelacion:</label>
            <p>{{$Software->fecha_de_cancelacion}}</p>
        </div>

       <div class="col-sm-12">
            <label>Observaciones:</label>
            <textarea name="observaciones" id="observaciones" class="form-control" required="">{{$Software->observaciones}}</textarea>
         </div>

	   <div class="col-sm-12" style="margin-top:15px;">
            <div id="resultado1"></div>
            <div id="boton1" class="ocultar">
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
           url: '{{url('software/'.$Software->id)}}', // Al controlador donde van mis datos
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
             nodatos();
            window.location.href ='{{url('software/'.$Software->id.'/edit')}}';
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

$( document ).ready(function() {
      $('#newSoftware').find('input, textarea, button, select').prop('disabled',true);
});
   function ocultar(){
   document.getElementById("fpagos").className -= " ocultar";
   }
   function mostrar(){
   document.getElementById("fpagos").className += " ocultar";
   }

   function sidatos(){
   document.getElementById("boton1").className -= " ocultar";
   document.getElementById("cancelar").className -= " ocultar";
   document.getElementById("editar").className += " ocultar";
   $('#newSoftware').find('input, textarea, button, select').prop('disabled',false);
   }
   function nodatos(){
   document.getElementById("boton1").className += " ocultar";
   document.getElementById("cancelar").className += " ocultar";
   document.getElementById("editar").className -= " ocultar";
   $('#newSoftware').find('input, textarea, button, select').prop('disabled',true);
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




