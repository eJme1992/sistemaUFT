@extends('layouts.app')
@section('title', 'Modificar Cuenta')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;">Modificar Cuenta</h2><hr>
   <form id="editcuenta" class="row"  method="POST">
      @csrf
      @method('PUT')
      <div class="col-md-4">
          <img src="{{url('/img/programa/'.$Cuenta->logo)}}" alt="" class="img-responsive">
          <div class="col-sm-12">
            <label>Logo:</label>
            <input type="file" name="logo" id="logo" class="form-control">
         </div>
      </div>
      <div class="col-md-8" id="nuevo_Cuenta">
        <div class="col-sm-4">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required="" placeholder="Cuenta" value="{{$Cuenta->nombre}}">
         </div>
         <div class="col-sm-4">
            <label>Tipo:</label>
            <select name="tipo" id="tipo" class="form-control" required="">

             <option @if($Cuenta->tipo=='Persona Física') selected @endif>
               Persona Física
               </option>
             <option @if($Cuenta->tipo=='Persona Jurídica') selected @endif>
               Persona Jurídica
               </option>
            </select>
         </div>
          <div class="col-sm-4">
            <label>WISE CRM:</label>
            <select name="crm" id="crm" class="form-control" required="">
               <option @if($Cuenta->crm=='Si') selected @endif>Si</option>
               <option @if($Cuenta->crm=='No') selected @endif>No</option>
            </select>
         </div>
         <div class="col-sm-6">
            <label>Industria:</label>
            <select name="industria" id="industria" class="form-control" required="">
         <option @if($Cuenta->industria=='Agrícola') selected @endif>Agrícola</option>
         <option @if($Cuenta->industria=='Banca') selected @endif>Banca</option>
         <option @if($Cuenta->industria=='Biotecnología') selected @endif>Biotecnología</option>
         <option @if($Cuenta->industria=='Comunicaciones') selected @endif>Comunicaciones</option>
         <option @if($Cuenta->industria=='Construcción') selected @endif>Construcción</option>
         <option @if($Cuenta->industria=='Consultoría') selected @endif>Consultoría</option>
         <option @if($Cuenta->industria=='Educación') selected @endif>Educación</option>
         <option @if($Cuenta->industria=='Entretenimiento') selected @endif>Entretenimiento</option>
         <option @if($Cuenta->industria=='Fabricación') selected @endif>Fabricación</option>
         <option @if($Cuenta->industria=='Finanzas') selected @endif>Finanzas</option>
         <option @if($Cuenta->industria=='Medios de Comunicación') selected @endif>Medios de Comunicación</option>
         <option @if($Cuenta->industria=='Minoristas') selected @endif>Minoristas</option>
         <option @if($Cuenta->industria=='Ocio') selected @endif>Ocio</option>
         <option @if($Cuenta->industria=='Otros') selected @endif>Otros</option>
         <option @if($Cuenta->industria=='Seguros') selected @endif>Seguros</option>
         <option @if($Cuenta->industria=='Servicios Públicos') selected @endif>Servicios Públicos</option>
         <option @if($Cuenta->industria=='Tecnología') selected @endif>Tecnología</option>
         <option @if($Cuenta->industria=='Telecomunicaciones') selected @endif>Telecomunicaciones</option>
         <option @if($Cuenta->industria=='Textil') selected @endif>Textil</option>
         <option @if($Cuenta->industria=='Tranporte') selected @endif>Tranporte</option>
            </select>
         </div>
         <div class="col-sm-6">
            <label>Toma de Contacto:</label>
            <select name="tema" id="tema" class="form-control" required="">
           <option @if($Cuenta->tema=='Sitio Web') selected @endif>Sitio Web</option>
           <option @if($Cuenta->tema=='Recomendado') selected @endif>Recomendado</option>
           <option @if($Cuenta->tema=='Email') selected @endif>Email</option>
           <option @if($Cuenta->tema=='Campaña') selected @endif>Campaña</option>
           <option @if($Cuenta->tema=='Otro') selected @endif>Otro</option>
            </select>
         </div>
          <div class="col-sm-6">
            <label>Referido Por:</label>
            <input type="text" name="referido" id="referido" required="" class="form-control" placeholder="Referido Por" value="{{$Cuenta->referido}}">
         </div>
         <div class="col-sm-12">
            <label>Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required="">{{$Cuenta->descripcion}}</textarea>
         </div>


      </div>
      <div class="col-md-12">
          <div class="col-sm-12">
         <h4>Dirección</h4><hr>
         </div>
           <div class="col-sm-4">
            <label>Calle:</label>
            <input type="text" name="calle" id="calle" required="" class="form-control" placeholder="Calle" value="{{$Cuenta->calle}}">
         </div>
          <div class="col-sm-4">
            <label>Ciudad:</label>
            <input type="text" name="ciudad" id="ciudad" required="" class="form-control" placeholder="Ciudad" value="{{$Cuenta->ciudad}}">
         </div>
        <div class="col-sm-4">
            <label>Provincia:</label>
            <input type="text" name="provincia" id="provincia" required="" class="form-control" placeholder="Provincia" value="{{$Cuenta->provincia}}">
        </div>
        <div class="col-sm-4">
            <label>País:</label>
             @include('layouts.cuentas.sub.paises')
        </div>
          <div class="col-sm-4">
            <label>Código Postal:</label>
            <input type="text" name="codigo_postal" id="codigo_postal" required="" class="form-control" placeholder="Código Postal" value="{{$Cuenta->codigo_postal}}">
        </div>

         <div class="col-sm-4">
            <label>Email:</label>
            <input type="mail" name="correo" id="correoc" class="form-control" required="" placeholder="Email" value="{{$Cuenta->correo}}">
         </div>
         <div class="col-sm-4">
            <label>Teléfono:</label>
            <input type="number" name="telefono" id="telefonoc" class="form-control" required="" placeholder="Teléfono" value="{{$Cuenta->telefono}}">
         </div>
           <div class="col-sm-12" style="margin-top:15px;">
            <div class="resultado"></div>
            <button type="submit"  name="enviar" id="enviar" class="btn-primary btn-block btn">
            Guardar <i class="fas fa-pencil-alt"></i>
            </button>
         </div>

      </div>
   </form>
</div>
<script >
         $(document).ready(function() {
               $("#editcuenta").submit(function(event) {
               event.preventDefault();

             var msj = '1';
         //validaciones con js

        if (msj === "1") {
         var formData = new FormData($('#editcuenta') [0]);
         $.ajax({
           url: '{{url('cuentas/'.$Cuenta->slug)}}',
           type: 'POST',
           contentType: false,
           processData: false,
           dataType: 'json',
           data: formData,
           beforeSend: function() {
             $("#resultado").html('<div class="alert alert-success">Procesando...!</div>');
           }
         })
         .done(function(data, textStatus, jqXHR) {
            var getData = jqXHR.responseJSON; // dejar esta linea
           if(data.status=='ok'){ //ver controlador, status es el nombre la clave cuando se creo
            $("#resultado").html('<div class="alert alert-success">'+data.mensaje+'</div>'); //
            window.location.href ='{{url('cuentas/'.$Cuenta->slug.'/edit')}}';
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
               });
          // Fin de ajax
          } else {
              swal("¡Error! ", msj, "error");
          }
          });

         });//fin ready
      </script>
@endsection




