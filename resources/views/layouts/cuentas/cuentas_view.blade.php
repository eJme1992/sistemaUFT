@extends('layouts.app')
@section('title', 'Cuenta')
@section('content')
<!-- MODAL ELIMINAR -->
<div id="delete{{$Cuenta->id}}" class="modal fade " role="dialog">
   <div class="modal-dialog" style="margin-top:10vw;">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body text-center">
            <h3> ¿Está seguro que desea eliminar a: <b><?=$Cuenta->nombre;?></b>?</h3>
         </div>
         <div class="modal-footer">
            <form method="POST" action="{{url('cuentas/'.$Cuenta->slug)}}" >
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger">Si</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- MODAL ELIMINAR -->
<div id="baja{{$Cuenta->id}}" class="modal fade " role="dialog">
   <div class="modal-dialog" style="margin-top:10vw;">
      <!-- Modal content-->
      <div class="modal-content">
        <form method="POST" action="{{url('cuentas/baja')}}" >
         <div class="modal-body text-center">
            <h3> ¿Está seguro que desea @if($Cuenta->estado!='activo') activar @else dar de baja @endif  al cliente: <b><?=$Cuenta->nombre;?></b>?</h3>
         @if($Cuenta->estado=='activo')
         <label>¿Razón por la cuál el cliente nos deja?</label>
         <input type="text" name="baja" id="baja" placeholder="motivo" required="" class="form-control">
         @endif
         <input type="hidden" name="slug" id="slug" value='{{$Cuenta->slug}}'>
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
<div class="container-fluid">
   <div class="row profile">
      <div class="col-md-3">
         <div class="profile-sidebar panel panel-default">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic panel-body">
               <img src="{{url('/img/programa/'.$Cuenta->logo)}}" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
               <div class="profile-usertitle-name">
                  {{$Cuenta->nombre}}
               </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->

            <div class="row ">
              <div class="col-md-12" style="margin-top:5px;">
               <a href="{{url('cuentas/'.$Cuenta->slug.'/edit')}}">
               <button type="button" class="btn btn-success btn-xs btn-block"><i class="fas fa-pencil-alt"></i> Modificar</button></a>
              </div>
              <div class="col-md-12" style="margin-top:5px;">
                <button type="button" class="btn btn-primary btn-xs btn-block" ata-title="Delete" data-toggle="modal" data-target="#baja<?=$Cuenta->id;?>">
                  @if($Cuenta->estado!='activo') <i class="fas fa-chevron-circle-up"></i> Activar @else <i class="fas fa-chevron-circle-down"></i> Baja @endif

                </button>
               </div>
               <div class="col-md-12" style="margin-top:5px;">
               <button type="button" class="btn btn-danger btn-xs btn-block" ata-title="Delete" data-toggle="modal" data-target="#delete<?=$Cuenta->id;?>"><i class="fas fa-trash-alt"></i> Eliminar</button>
               </div>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->

            <div class="profile-usermenu">
               <ul class="nav">
                  <li class="active">
                     <a data-toggle="tab" href="#home">
                     <i class="glyphicon glyphicon-home"></i>
                     Cuenta
                     </a>
                  </li>
                    <li>
                     <a data-toggle="tab" href="#t2">
                     <i class="fab fa-edge"></i>
                     Sitios Web </a>
                  </li>
                    <li>
                     <a data-toggle="tab" href="#t3">
                     <i class="fas fa-server"></i>
                     Hosting Services </a>
                  </li>
                    <li>
                     <a data-toggle="tab" href="#t4">
                     <i class="fas fa-database"></i>
                     Bases de Datos </a>
                  </li>
                    <li>
                     <a data-toggle="tab" href="#t5">
                     <i class="fa fa-envelope"></i>
                     Emails </a>
                  </li>
                 <li>
                     <a data-toggle="tab" href="#t6">
                     <i class="fab fa-facebook-f"></i>
                     Redes Sociales </a>
                  </li>
                  @if($Cuenta->crm=='Si')
                  <li>
                     <a data-toggle="tab" href="#t7"><i class="fab fa-affiliatetheme"></i>WISE CRM </a>
                  </li>
                  @endif
                  <li>
                     <a data-toggle="tab" href="#t1">
                     <i class="glyphicon glyphicon-user"></i>
                      Contactos </a>
                  </li>
               </ul>
            </div>
            <!-- END MENU -->
         </div>
      </div>
      <div class="col-md-9">
         <div class="panel panel-default tab-content">
            <div id="home" class="profile-content tab-pane fade in active" >
               @include('layouts.cuentas.sub.ficha_cuenta')
            </div>
            <div id="t1" class="profile-content tab-pane fade" >
               @include('layouts.cuentas.sub.contactos')
            </div>
              <div id="t2" class="profile-content tab-pane fade" >
               @include('layouts.cuentas.sub.web')
            </div>
              <div id="t3" class="profile-content tab-pane fade" >
               @include('layouts.cuentas.sub.hosts')
            </div>
              <div id="t4" class="profile-content tab-pane fade" >
               @include('layouts.cuentas.sub.dbs')
            </div>
              <div id="t5" class="profile-content tab-pane fade" >
               @include('layouts.cuentas.sub.mails')
            </div>
              <div id="t6" class="profile-content tab-pane fade" >
               @include('layouts.cuentas.sub.redes')
            </div>
              <div id="t7" class="profile-content tab-pane fade" >
               @include('layouts.cuentas.sub.crms')
            </div>
         <!-- REDES SOCIALES -->






         </div>
      </div>
   </div>
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
</script>
 <link rel="stylesheet" type="text/css" href="{{asset('assets/css/perfil_cliente.css')}}">
@endsection
