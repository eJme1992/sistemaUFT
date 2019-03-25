@extends('layouts.app') @section('title', 'Modificar Usuarios') @section('content')
<!--
<div id="baja{{$Usuarios->id}}" class="modal fade " role="dialog">
   <div class="modal-dialog" style="margin-top:10vw;">
      
      <div class="modal-content">
        <form method="POST" action="{{url('Usuarios/baja')}}" >
         <div class="modal-body text-center">
            <h3> ¿Esta Seguro que desea @if($Usuarios->estado!='activo') activar @else dar de baja @endif  al Usuarios: <b><?=$Usuarios->nombre;?></b>?</h3>

         <input type="hidden" name="id" id="id" value='{{$Usuarios->id}}'>
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

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nueva contraseña</h4>
            </div>
            <div class="modal-body">
                <form id="newpass" onsubmit="realizaProceso('#newpass');return false;">
                      @csrf @method('PUT')
                    <label>Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" required="" placeholder="Contrase&ntilde;a">                       
                    <button type="submit" class="btn-primary btn-block btn">
                         Guardar <i class="fas fa-check"></i>
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>




<div class="container-fluid cm-container-white">
    <h2 style="margin-top:0;">Usuario: {{$Usuarios->nombre}}</h2>
    <br>
    <button class="btn btn-success btn-xs" type="button" id="editar" onclick="sidatos();">Editar datos</button>

    <button class="btn btn-warning btn-xs ocultar" type="button" id="cancelar" onclick="nodatos();">Cancelar edicion</button>
    <button class="btn btn-success btn-xs" type="button" data-toggle="modal" data-target="#myModal">Nueva contraseña</button>

    <!--<button type="button" class="btn btn-primary " ata-title="Delete" data-toggle="modal" data-target="#baja<?=$Usuarios->id;?>">
                  @if($Usuarios->estado!='activo') <i class="fas fa-chevron-circle-up"></i> Activar @else <i class="fas fa-chevron-circle-down"></i> Baja @endif

                </button>-->
    <a href="{{url('usuarios')}}"><button class="btn-xs btn btn-primary" type="button"><i class="fas fa-chevron-left"></i> Atrás</button></a>
    <hr> @if ($errors->any()) @foreach($errors->all() as $key)
    <p>{{$key}}</p>
    @endforeach @endif



    <form id="newUsuarios" onsubmit="realizaProceso('#newUsuarios');return false;">
        <!--  <form action="{{url('Usuarios/'.$Usuarios->id)}}" method="POST">-->
        @csrf @method('PUT')
        <div id="resultado"></div>
        <div class="formularios" id="nuevo_Usuarios">
            <div class="col-sm-4">
                <label>Usuario:</label>
                <input type="text" name="name" id="name" class="form-control" required="" placeholder="name" value="{{$Usuarios->name}}">
            </div>


            <div class="col-sm-4">
                <label>Email:</label>
                <input type="mail" name="email" id="email" class="form-control" required="" placeholder="Email" value="{{$Usuarios->email}}">
            </div>


            <div class="col-sm-4">
                <label>Tipo:</label>
                <select name="tipo" id="tipo" class="form-control" required="">
               <option value="1" @if($Usuarios->id_role=='1') selected @endif >ADMIN</option>
               <option value="2" @if($Usuarios->id_role=='2') selected @endif>USER</option>
            </select>
                <input type="hidden" name="tv" id="tv" class="form-control" required="" value="{{$Usuarios->id_role}}">
            </div>





            <div class="col-sm-12" style="margin-top:15px;">
                <div id="resultado1"></div>
                <div id="boton1" class="ocultar">
                    <button type="submit" name="enviar" id="enviar" class="btn-primary btn-block btn">
            Guardar <i class="fas fa-check"></i>
            </button>
                </div>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    function realizaProceso(p) {
    
                 var msj = '1';
             //validaciones con js
    
             if (msj === "1") { //tres igual para decir que es identico
             var formData = new FormData(jQuery(p) [0]); //Se crea el arreglo con los datos del form
             $.ajax({
               url: '{{url('usuarios/'.$Usuarios->id)}}', // Al controlador donde van mis datos
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
    
                 document.getElementById("newUsuarios").reset();
    
                 $("#boton1").html('<button onclick="realizaProceso();return false; " type="button" name="enviar" id="enviar" class="btn-primary btn-block btn">Crear <i class="fas fa-check"></i></button> ');
                 nodatos();
                window.location.href ='{{url('usuarios/'.$Usuarios->id.'/edit')}}';
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
          $('#newUsuarios').find('input, textarea, button, select').prop('disabled',true);
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
       $('#newUsuarios').find('input, textarea, button, select').prop('disabled',false);
       }
       function nodatos(){
       document.getElementById("boton1").className += " ocultar";
       document.getElementById("cancelar").className += " ocultar";
       document.getElementById("editar").className -= " ocultar";
       $('#newUsuarios').find('input, textarea, button, select').prop('disabled',true);
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