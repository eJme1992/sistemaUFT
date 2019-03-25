               <h2 style="margin-top:0; margin-bottom:35px; display:inline;"><i class="fas fa-database"></i> Bases de Datos</h2>
             <hr>
                <a href="{{url('dbs/create/'.$Cuenta->slug)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-plus"></i> Agregar Base de Datos</button></a>
                <table id="grid3" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                     <tr class="active">

                        <th>Dominio</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($dbs as $key)
                     <tr>

                        <td>
                           {{$key->dominio}}
                        </td>
                        <td>
                           {{$key->name}}
                        </td>
                        <td>
                           {{$key->user}}
                        </td>
                        <td>
                           <a href="{{url('dbs/edit/'.$Cuenta->slug.'/'.$key->id)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                           <button class="btn btn-xs" data-title="Delete" data-toggle="modal" data-target="#viewdbs<?=$key->id;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                           <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#deletedb<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                          <!-- MODALES PARA ACCIONES EN dbs-->
                        <!-- Modal Editar-->
                        <div id="viewdbs{{$key->id}}" class="modal fade" role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <div class="modal-content  modal-sm center-block">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">DATOS DE LA BASE DE DATOS</h4>
                                 </div>
                                 <div class="modal-body">
                                 	<label>Dominio: </label> {{$key->dominio}}<br>
                                 	<label>Nombre: </label> {{$key->name}}<br>
                                 	<label>Usuario: </label> {{$key->user}}<br>
                                 	<label>Contrase&ntilde;a: </label> {{$key->pass}}
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- MODAL ELIMINAR -->
                        <div id="deletedb{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-body text-center">
                                    <h3> &#191;Est&aacute; seguro que desea eliminar la Base de Datos: <b><?=$key->name;?></b>?</h3>
                                 </div>
                                 <div class="modal-footer">


                                    <a href="{{url('dbs/destroy/'.$key->id.'/'.$Cuenta->slug)}}"><button type="submit" class="btn btn-danger">Si</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- FIN MODAL ELIMINAR -->
                        <!-- FIN DE MODALES PARA ACCIONES DE dbs -->
                     </tr>

                     @endforeach
                  </tbody>
               </table>