               <h2 style="margin-top:0; margin-bottom:35px; display:inline;"><i class="fab fa-edge"></i> Sitios Web</h2><hr>
                <a href="{{url('webs/create/'.$Cuenta->slug)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-plus"></i> Agregar Sitio Web</button></a>             <table id="grid1" class="table table-striped " cellspacing="0" width="100%">
                  <thead>
                     <tr class="active">
                        <th>Hosting Service</th>
                        <th>Desarrollo</th>
                        <th>URL</th>
                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>

                     @foreach($webs as $key)
                     <tr>
                        <td>
                           {{$key->hosting}}
                        </td>
                        <td>
                          {{$key->tipo}}
                        </td>
                        <td>
                           {{$key->url}}
                        </td>
                        <td>
                           <a href="{{url('webs/edit/'.$Cuenta->slug.'/'.$key->id)}}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                           <button class="btn btn-xs" data-title="Delete" data-toggle="modal" data-target="#viewwebs<?=$key->id;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                           <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#deleteweb<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    <!-- MODALES PARA ACCIONES EN webs-->
                        <!-- Modal Editar-->
                        <div id="viewwebs{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">DATOS DEL SITIO WEB</h4>
                                 </div>
                                 <div class="modal-body">
                                    <label>Desarrollo: </label> {{$key->tipo}}<br>
                                    <label>URL: </label> {{$key->url}}<br>
                                    <label>URL Admin: </label> {{$key->url_admin}}<br>
                                    <label>Usuario: </label> {{$key->user}}<br>
                                    <label>ContraseÃ±a: </label> {{$key->pass}}<br>
                                    <label>Tipo: </label> {{$key->tipo_p}}<br>
                                    @if($key->tipo_p ==='Ecommerce') <label>Pago: </label> {{$key->pago}}<br> @endif

                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- MODAL ELIMINAR -->
                        <div id="deleteweb{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-body text-center">
                                    <h3> ¿Está seguro que desea eliminar el Sitio Web: <b><?=$key->url;?></b>?</h3>
                                 </div>
                                 <div class="modal-footer">


                                    <a href="{{url('webs/destroy/'.$key->id.'/'.$Cuenta->slug)}}"><button type="submit" class="btn btn-danger">Si</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- FIN MODAL ELIMINAR -->
                        <!-- FIN DE MODALES PARA ACCIONES DE webs -->
                     </tr>

                     @endforeach
                  </tbody>
               </table>