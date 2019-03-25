               <h2 style="margin-top:0; margin-bottom:35px; display:inline;"> <i class="fab fa-affiliatetheme"></i> WISE CRM</h2>
                <hr>
                <a href="{{url('crms/create/'.$Cuenta->slug)}}">
                  <button type="button" class="btn btn-primary btn-xs"><i class="fas fa-plus"></i> Agregar Usuario al CRM
                  </button>
               </a>

               <table id="grid3" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                     <tr class="active">

                        <th>Contacto</th>
                        <th>Usuario de CRM</th>

                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($crms as $key)
                     <tr>

                        <td>
                           {{$key->nombre}} {{$key->apellido}}
                        </td>
                        <td>
						   {{$key->user}}
                        </td>
                        <td>
                           <a href="{{url('crms/edit/'.$Cuenta->slug.'/'.$key->id)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                           <button class="btn btn-xs" data-title="Delete" data-toggle="modal" data-target="#viewcrms<?=$key->id;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                           <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#deletecrm<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                          <!-- MODALES PARA ACCIONES EN crms-->
                        <!-- Modal Editar-->
                        <div id="viewcrms{{$key->id}}" class="modal fade" role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <div class="modal-content modal-sm">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">DATOS DEL USUARIO DE CRM</h4>
                                 </div>
                                 <div class="modal-body">
                                    <label>Usuario: </label> {{$key->user}}<br>
                                    <label>Contrasña: </label> {{$key->pass}}<br>
                                    <label>Roles: </label> {{$key->roles}}<br>
                                    <label>Grupo de Seguridad: </label> {{$key->seguridad}}<br>
                                    <label>Email Asociado: </label> {{$key->user_email}}<br>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- MODAL ELIMINAR -->
                        <div id="deletecrm{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-body text-center">
                                    <h3> ¿Esta seguro que desea eliminar el crm: <b><?=$key->nombre;?></b>?</h3>
                                 </div>
                                 <div class="modal-footer">


                                    <a href="{{url('crms/destroy/'.$key->id.'/'.$Cuenta->slug)}}"><button type="submit" class="btn btn-danger">Si</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- FIN MODAL ELIMINAR -->
                        <!-- FIN DE MODALES PARA ACCIONES DE crms -->
                     </tr>

                     @endforeach
                  </tbody>
               </table>