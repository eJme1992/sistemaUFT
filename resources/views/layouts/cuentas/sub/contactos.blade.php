               <h2 style="margin-top:0; margin-bottom:35px; display:inline;"><i class="glyphicon glyphicon-user"></i> Contactos</h2> <hr>
                <a href="{{url('contactos/create/'.$Cuenta->slug)}}"><button class="btn btn-primary btn-xs">Agregar Contacto <i class="fas fa-plus"></i></button></a>
               <table id="grid6" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                     <tr class="active">

                        <th>Nombre y Apellido</th>
                        <th>Cargo</th>
                        <th>Tel&eacute;fono</th>
                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($contactos as $key)
                     <tr>

                        <td>
                           {{$key->nombre}}   {{$key->apellido}}
                        </td>
                        <td>
                           {{$key->cargo}}
                        </td>
                        <td>
                           {{$key->telefono}}
                        </td>
                        <td>
                           <a href="{{url('contactos/edit/'.$Cuenta->slug.'/'.$key->id)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                           <button class="btn btn-xs" data-title="Delete" data-toggle="modal" data-target="#view<?=$key->id;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                           <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#deleteuser<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                          <!-- MODALES PARA ACCIONES EN contactos-->
                        <!-- Modal Editar-->
                        <div id="view{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">DATOS DEL CONTACTO</h4>
                                 </div>
                                 <div class="modal-body">
                                    <label>Nombre y Apellido: </label> {{$key->nombre}} {{$key->apellido}}<br>
                                    <label>Cargo: </label> {{$key->cargo}}<br>
                                    <label>Tel&eacute;fono: </label> {{$key->telefono}}<br>
                                    <label>Tipo: </label> {{$key->tipo}}<br>
                                    <h4>EMAILS</h4>
                                    <ul>
                                    @foreach($mails as $key2)

                                      @if($key2->contacto_id == $key->id)

                                        <li>{{$key2->user}}</li>
                                      @endif
                                    @endforeach
                                    </ul>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- MODAL ELIMINAR -->
                        <div id="deleteuser{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-body text-center">
                                    <h3> &#191;Est&aacute; Seguro que desea eliminar a este contacto: <b><?=$key->nombre;?></b>?</h3>
                                 </div>
                                 <div class="modal-footer">


                                    <a href="{{url('contacto/destroy/'.$key->id.'/'.$Cuenta->slug)}}"><button type="submit" class="btn btn-danger">Si</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- FIN MODAL ELIMINAR -->
                        <!-- FIN DE MODALES PARA ACCIONES DE contactos -->
                     </tr>

                     @endforeach
                  </tbody>
               </table>