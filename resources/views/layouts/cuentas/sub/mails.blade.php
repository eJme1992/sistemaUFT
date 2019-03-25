
               <h2 style="margin-top:0; margin-bottom:35px; display:inline;"><i class="fa fa-envelope" style="color:#000;"></i> Direcciones de Email</h2> <hr>
                <a href="{{url('mails/create/'.$Cuenta->slug)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-plus"></i> Agregar Email</button></a>
               <table id="grid4" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                     <tr class="active">
                        <th>Contacto</th>
                        <th>Proveedor</th>
                        <th>Correo</th>

                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($mails as $key)
                     <tr>
                         <td>
                           {{$key->nombre}} {{$key->apellido}}
                        </td>

                        <td>
                           {{$key->mail}}
                        </td>
                        <td>
                           {{$key->user}}
                        </td>
                        <td>
                           <a href="{{url('mails/edit/'.$Cuenta->slug.'/'.$key->id)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                           <button class="btn btn-xs" data-title="Delete" data-toggle="modal" data-target="#viewmails<?=$key->id;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                           <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#deletemails<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                          <!-- MODALES PARA ACCIONES EN mails-->
                        <!-- Modal Editar-->
                        <div id="viewmails{{$key->id}}" class="modal fade" role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <div class="modal-content  modal-sm center-block">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">DIRECCION DE EMAIL</h4>
                                 </div>
                                 <div class="modal-body">
                                    <label>Email: </label>
                                    {{$key->user}}<br/>
                                    <label>Contraseña: </label>
                                    {{$key->pass}}

                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- MODAL ELIMINAR -->
                        <div id="deletemails{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-body text-center">
                                    <h3> ¿Est&aacute; seguro que desea eliminar la direcci&oacute;n de Email: <b><?=$key->user;?></b>?</h3>
                                 </div>
                                 <div class="modal-footer">


                                    <a href="{{url('mails/destroy/'.$key->id.'/'.$Cuenta->slug)}}"><button type="submit" class="btn btn-danger">Si</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- FIN MODAL ELIMINAR -->
                        <!-- FIN DE MODALES PARA ACCIONES DE mails -->
                     </tr>

                     @endforeach
                  </tbody>
               </table>