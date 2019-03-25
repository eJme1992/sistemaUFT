@extends('layouts.app')
@section('title', 'Agregar Cuenta')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;"><i class="fas fa-plus-circle"></i> Agregar Cuenta </h2><hr>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newCuenta">
      @csrf
      <div id="resultado"></div>
      <div class="formularios" id="nuevo_Cuenta">
         <div class="col-sm-4">
            <label>Cuenta:</label>
            <input type="text" name="nombrec" id="nombrec" class="form-control" required="" placeholder="Cuenta">
         </div>
         <div class="col-sm-4">
            <label>Tipo:</label>
            <select name="tipo" id="tipo" class="form-control" required="">
            	<option value="0">Seleccionar</option>
               <option>Persona Física</option>
               <option>Persona Jurídica</option>
            </select>
         </div>
         <div class="col-sm-4">
            <label>WISE CRM:</label>
            <select name="crm" id="crm" class="form-control" required="">
            	<option value="0">Seleccionar</option>
               <option>Si</option>
               <option>No</option>
            </select>
         </div>
         <div class="col-sm-6">
            <label>Industria:</label>
            <select name="industria" id="industria" class="form-control" required="">
            	<option value="0">Seleccionar</option>
              <option>Agrícola</option>
              <option>Banca</option>
              <option>Biotecnología</option>
              <option>Comunicaciones</option>
              <option>Construcción</option>
              <option>Consultoría</option>
              <option>Educación</option>
              <option>Entretenimiento</option>
              <option>Fabricación</option>
              <option>Finanzas</option>
              <option>Medios de Comunicación</option>
              <option>Minoristas</option>
              <option>Ocio</option>
              <option>Otros</option>
              <option>Seguros</option>
              <option>Servicios Públicos</option>
              <option>Tecnología</option>
              <option>Telecomunicaciones</option>
              <option>Textil</option>
              <option>Tranporte</option>
            </select>
         </div>
         <div class="col-sm-6">
            <label>Toma de Contacto:</label>
            <select name="tema" id="tema" class="form-control" required="">
             <option value="0">Seleccionar</option>
             <option>Sitio Web</option>
             <option>Recomendado</option>
             <option>Email</option>
             <option>Campaña</option>
             <option>Otro</option>
            </select>
         </div>
          <div class="col-sm-6">
            <label>Referido Por:</label>
            <input type="text" name="referido" id="referido" required="" class="form-control" placeholder="Referido Por">
         </div>
          <div class="col-sm-6">
            <label>Logo:</label>
            <input type="file" name="logo" id="logo" class="form-control" required="">
         </div>

         <div class="col-sm-12">
            <label>Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required=""></textarea>
         </div>
         <div class="col-sm-12">
         <h4>Direcci&oacute;n</h4><hr>
         </div>
           <div class="col-sm-4">
            <label>Calle:</label>
            <input type="text" name="calle" id="calle" required="" class="form-control" placeholder="Calle">
         </div>
          <div class="col-sm-4">
            <label>Ciudad:</label>
            <input type="text" name="ciudad" id="ciudad" required="" class="form-control" placeholder="Ciudad">
         </div>
        <div class="col-sm-4">
            <label>Provincia:</label>
            <input type="text" name="provincia" id="provincia" required="" class="form-control" placeholder="Provincia">
        </div>
        <div class="col-sm-4">
            <label>País:</label>
             @include('layouts.cuentas.sub.paises')
        </div>
          <div class="col-sm-4">
            <label>C&oacute;digo Postal:</label>
            <input type="text" name="codigo_postal" id="codigo_postal" required="" class="form-control" placeholder="C&oacute;digo Postal">
        </div>





         <div class="col-sm-4">
            <label>Email:</label>
            <input type="mail" name="correoc" id="correoc" class="form-control" required="" placeholder="Email">
         </div>
         <div class="col-sm-4">
            <label>Teléfono:</label>
            <input type="number" name="telefonoc" id="telefonoc" class="form-control" required="" placeholder="Teléfono">
         </div>
         <div class="col-sm-12" style="margin-top:15px;">

              <div id="boton">
            <button type="button" onclick="Cuenta();" name="siguiente" id="siguiente" class="btn-primary btn-block btn">
            Siguiente <i class="fas fa-chevron-right"></i>
            </button>
             </div>
         </div>
      </div>
      <div class="formularios ocultar" id="nuevo_usuario">
         <div class="col-sm-12">
            <h4 style="display:inline;">Contacto Principal</h4>
            <button class="btn-xs btn btn-primary" type="button" onclick="mostrar()"> <i class="fas fa-chevron-left"></i> Atrás</button>
         </div>
         <div class="col-sm-6">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required="" placeholder="Nombre">
         </div>
         <div class="col-sm-6">
            <label>Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required="" placeholder="Apellido">
         </div>
         <div class="col-sm-4">
            <label>Cargo:</label>
            <input type="text" name="cargo" id="cargo" class="form-control" required="" placeholder="Cargo">
         </div>



            <div class="col-sm-4">
               <label>Teléfono</label>
               <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Teléfono">
            </div>

         <div class="col-sm-12" style="margin-top:15px;">
            <div id="resultado1"></div>
            <div id="boton1">
            <button  onclick="realizaProceso();return false; " type="button" name="enviar" id="enviar" class="btn-primary btn-block btn">
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
         var formData = new FormData(jQuery('#newCuenta') [0]); //Se crea el arreglo con los datos del form
         $.ajax({
           url: '{{url('cuentas')}}', // Al controlador donde van mis datos
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
            $("#resultado").html('<div class="alert alert-success">'+data.mensaje+'</div>'); //
             document.getElementById("nuevo_Cuenta").className -= " ocultar";
             document.getElementById("nuevo_usuario").className += " ocultar";
             document.getElementById("newCuenta").reset();
             mostrar();
             $("#boton1").html('<button onclick="realizaProceso();return false; " type="button" name="enviar" id="enviar" class="btn-primary btn-block btn">Crear <i class="fas fa-check"></i></button> ');
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
                 $("#boton1").html('<button onclick="realizaProceso();return false; " type="button" name="enviar" id="enviar" class="btn-primary btn-block btn">Crear <i class="fas fa-check"></i></button> ');

               })
          // Fin de ajax
          } else {
              swal("¡Error! ", msj, "error");
          }
           };

   function Cuenta(){
   document.getElementById("nuevo_Cuenta").className += " ocultar";
   document.getElementById("nuevo_usuario").className -= " ocultar";
   $("#resultado").html('<div></div>');
   $("#resultado1").html('<div></div>');
   }
   function mostrar(){
   document.getElementById("nuevo_Cuenta").className -= " ocultar";
   document.getElementById("nuevo_usuario").className += " ocultar";
   }

   function sidatos(){
   document.getElementById("datos").className -= " ocultar";
   }
   function nodatos(){
   document.getElementById("datos").className += " ocultar";
   }
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




