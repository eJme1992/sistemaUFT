

                 <table id="grid2" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                     <tr class="active">

                        <th>Usuario</th>
                        <th>Carpeta</th>
                        <th>Host</th>
                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>
                     @forelse($ftps as $key)
                     <tr>
                        <td>
                           {{$key->user}}
                        </td>
                         <td>
                           {{$key->carpeta}}
                        </td>
                        <td>
                          <a href="{{$key->url_cpanel}}">{{$key->url_cpanel}}</a>
                        </td>
                        <td>
                           <a href="{{url('ftps/edit/'.$Cuenta->slug.'/'.$key->id)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                           <button class="btn btn-xs" data-title="Delete" data-toggle="modal" data-target="#viewftps<?=$key->id;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                           <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#deleteftp<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                          <!-- MODALES PARA ACCIONES EN ftps-->
                        <!-- Modal Editar-->
                        <div id="viewftps{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">DATOS DE LA CUENTA DE FTP</h4>
                                 </div>
                                 <div class="modal-body">
                                    <label>Usuario: </label> {{$key->user}}<br>
                                    <label>Contrase&ntilde;a: </label> {{$key->pass}}<br>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- MODAL ELIMINAR -->
                        <div id="deleteftp{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-body text-center">
                                    <h3> &#191;Est&aacute; seguro que desea eliminar la Cuenta de FTP: <b><?=$key->user;?></b>?</h3>
                                 </div>
                                 <div class="modal-footer">


                                    <a href="{{url('ftps/destroy/'.$key->id.'/'.$Cuenta->slug)}}"><button type="submit" class="btn btn-danger">Si</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- FIN MODAL ELIMINAR -->
                        <!-- FIN DE MODALES PARA ACCIONES DE ftps -->
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


