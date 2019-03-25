@extends('layouts.app')

@section('title', 'Software')

@section('content')

<div class="container-fluid cm-container-white">
<div class="row">
<div class="col-sm-6">
<h2>Software</h2>
</div>
<div class="col-sm-6 text-right">
<button onclick="todos();" class="btn-default btn btn-xs" type="button">Todos</button>
<button onclick="mostrar();" class="btn-success btn btn-xs" type="button">Activos</button>
<button onclick="ocultar();" class="btn-danger btn btn-xs" type="button">Inactivos</button>
</div>
<div class="col-md-12">
<hr>
</div>
</div>

    <table id="grid6" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr  class="active" >
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Fecha de Suscripci&oacute;n</th>
                <th>Estado</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Software as $key)
            <tr @if($key->estado=='activo') class="success" @else class="danger"  @endif>
                <td>
                    {{$key->nombre}}
                </td>

                <td>
                    {{$key->tipo}}
                </td>
                <td>
                    {{$key->updated_at}}
                </td>
                <td>
                    {{$key->estado}}
                </td>
                <td>
					<a href="{{url('software/'.$key->id.'/edit')}}">
            <button class="btn  btn-xs">
          <i class="fa fa-eye" aria-hidden="true">
            
          </i>
        </button>
          </a>
                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>

                </td>
                <!-- MODALES PARA ACCIONES EN Software-->
                <!-- Modal Editar-->
                <div id="edit{{$key->id}}" class="modal fade " role="dialog">
                    <div class="modal-dialog" style="margin-top:10vw;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Editar categoría</h4>
                            </div>
                            <div class="modal-body">
                                <form id="editar{{$key->id}}" onsubmit="realizaProceso(
                                $('#id{{$key->id}}').val()
                                );return false; ">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Nombre de la categoría</label>
                                            <input type="text" name="nombre" id="nombre" value="<?=$key->nombre;?>" required="" class="form-control" placeholder="Ej: Anime">
                                            <input type="hidden" name="id" id="id" value="{{$key->id}}">

                                            <input type="hidden" name="id{{$key->id}}" id="id{{$key->id}}" value="{{$key->id}}">
                                        </div>
                                        <div class="col-md-12" id="resultado2{{$key->id}}" style="margin-top:15px;"></div>
                                        <div class="col-sm-12" style="margin-top:20px;">
                                        <button class="btn btn-lg btn-block btn-primary" type="submit">
                                         Editar
                                        </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL ELIMINAR -->
                <div id="delete{{$key->id}}" class="modal fade " role="dialog">
                    <div class="modal-dialog" style="margin-top:10vw;">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <h3> ¿Esta Seguro que desea eliminar Software: <b><?=$key->nombre;?></b>?</h3>
                            </div>
                            <div class="modal-footer">
                                <form method="POST" action="{{url('software/'.$key->id)}}" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Si</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               <!-- FIN MODAL ELIMINAR -->
               <!-- FIN DE MODALES PARA ACCIONES DE Software -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script type="text/javascript">
       $.noConflict();
         jQuery( document ).ready(function( $ ) {

          $('#grid6').DataTable();
         /* $('#grid2').DataTable();
          $('#grid3').DataTable();
          $('#grid4').DataTable();
          $('#grid5').DataTable();
          $('#grid1').DataTable(); */
         });
   function ocultar(){
    $('.danger').removeClass('ocultar');
    $('.success').addClass('ocultar');

   console.log('aki');
   }
   function mostrar(){
   $('.success').removeClass('ocultar');
   $('.danger').addClass('ocultar');
   }
   function todos(){
   $('.success').removeClass('ocultar');
   $('.danger').removeClass('ocultar');
   }
</script>
<style type="text/css">
   .ocultar{
   display: none;
   }
   </style>
@endsection