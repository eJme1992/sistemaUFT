               <h2 style="margin-top:0; margin-bottom:35px; display:inline;"><i class="fab fa-facebook-f"></i> Redes Sociales</h2> <hr>
                <a href="{{url('sociales/create/'.$Cuenta->slug)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-plus"></i> Agregar Red Social </button></a>
               <table id="grid5" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                  <tr class="active">

                        <th>Red Social</th>
                        <th>URL</th>
                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($sociales as $key)
                     <tr>

                        <td>
                           {{$key->nombre}}
                        </td>
                        <td>
                           {{$key->url}}
                        </td>

                        <td>
                           <a href="{{url('sociales/edit/'.$Cuenta->slug.'/'.$key->id)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                           <button class="btn btn-xs" data-title="Delete" data-toggle="modal" data-target="#viewredes<?=$key->id;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                           <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#deleteredes<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                          <!-- MODALES PARA ACCIONES EN sociales-->
                        <!-- Modal Editar-->
                        <div id="viewredes{{$key->id}}" class="modal fade" role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <div class="modal-content  modal-sm center-block">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">RED SOCIAL</h4>
                                 </div>
                                 <div class="modal-body">
                                 	<label>Red Social: </label> {{$key->nombre}}<br>
                                    <label>URL: </label> {{$key->url}}
                                    <label>Cuenta: </label> {{$key->user}}<br>
                                    <label>Contraseña: </label> {{$key->pass}}
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- MODAL ELIMINAR -->
                        <div id="deleteredes{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-body text-center">
                                    <h3> ¿Est&aacute; seguro que desea eliminar la Red Social: <b><?=$key->nombre;?></b>?</h3>
                                 </div>
                                 <div class="modal-footer">


                                    <a href="{{url('sociales/destroy/'.$key->id.'/'.$Cuenta->slug)}}"><button type="submit" class="btn btn-danger">Si</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- FIN MODAL ELIMINAR -->
                        <!-- FIN DE MODALES PARA ACCIONES DE sociales -->
                     </tr>

                     @endforeach
                  </tbody>
               </table>