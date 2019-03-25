
               <h2 style="margin-top:0; margin-bottom:35px; display:inline;"><i class="fas fa-server"></i> Hosting Services</h2> <hr>

                <a href="{{url('hosts/create/'.$Cuenta->slug)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-plus"></i> Agregar Hosting Service </button></a>

                 <a href="{{url('ftps/create/'.$Cuenta->slug)}}"><button class="btn btn-default btn-xs"><i class="fas fa-plus"></i> Agregar Cuenta FTP </button></a>

                <ul class="nav nav-tabs" style="margin-top:10px;">
    <li class="active"><a data-toggle="tab" href="#menu0">Hosting Services</a></li>
    <li><a data-toggle="tab" href="#menu1">Cuentas FTP</a></li>

  </ul>

 <div class="tab-content">
    <div id="menu0" class="tab-pane fade in active">

                 <table id="grid2" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                     <tr class="active">
                        <th>Hosting Service</th>
                        <th>cPanel</th>
                        <th>Plan</th>
                        <th>Usuario</th>
                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($hosts as $key)
                     <tr>
                        <td>
                           {{$key->hosting}}
                        </td>
                        <td>
                          <a href="{{$key->url_cpanel}}">{{$key->url_cpanel}}</a>
                        </td>
                        <td>
                           {{$key->plan}}
                        </td>
                        <td>
                           {{$key->user}}
                        </td>
                        <td>
                           <a href="{{url('hosts/edit/'.$Cuenta->slug.'/'.$key->id)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                           <button class="btn btn-xs" data-title="Delete" data-toggle="modal" data-target="#viewhosts<?=$key->id;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                           <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#deletehost<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                          <!-- MODALES PARA ACCIONES EN hosts-->
                        <!-- Modal Editar-->
                        <div id="viewhosts{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">DATOS DEL HOSTING SERVICE</h4>
                                 </div>
                                 <div class="modal-body">
                                    <label>Hosting Service: </label> {{$key->hosting}}<br>
                                    <label>Plan: </label> {{$key->plan}}<br>
                                    <label>URL cPanel: </label> {{$key->url_cpanel}}<br>
                                    <label>Usuario: </label> {{$key->user}}<br>
                                    <label>Contrase&ntilde;a: </label> {{$key->pass}}<br>
                                    <label>Cuenta: </label> {{$key->cuenta}}<br>
                                    <label>PIN: </label> {{$key->pin}}<br>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- MODAL ELIMINAR -->
                        <div id="deletehost{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-body text-center">
                                    <h3> &#191;Est&aacute; seguro que desea eliminar el Hosting Service: <b><?=$key->hosting;?></b>?</h3>
                                 </div>
                                 <div class="modal-footer">


                                    <a href="{{url('hosts/destroy/'.$key->id.'/'.$Cuenta->slug)}}"><button type="submit" class="btn btn-danger">Si</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- FIN MODAL ELIMINAR -->
                        <!-- FIN DE MODALES PARA ACCIONES DE hosts -->
                     </tr>
     @empty
                     <tr>
                        <td>
                           No se ha encontrado registros
                        </td>
                     </tr>
                     @endforelse
                  </tbody>
               </table>
</div>
<div id="menu1" class="tab-pane fade">
   @include('layouts.cuentas.sub.ftps')
</div>
</div>