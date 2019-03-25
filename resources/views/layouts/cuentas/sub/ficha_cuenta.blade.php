             <h3><b>{{$Cuenta->nombre}}</b><span style="font-size:14px;"> - {{$Cuenta->tipo}}</span></h3>
               <div class="row">
                  <div class="col-md-6">
                     <label>
                     <i class="fas fa-building"></i> Industria:
                     </label>
                     {{$Cuenta->industria}}
                  </div>

                   <div class="col-md-6">
                     <label>
                    <i class="fab fa-wordpress"></i> Toma de Contacto:
                     </label>
                     {{$Cuenta->tema}}
                  </div>

                    <div class="col-md-6">
                     <label>
                     <i class="fas fa-users"></i> Referido Por:
                     </label>
                     {{$Cuenta->referido}}
                  </div>
                  <div class="col-md-12">
                     <label><i class="fas fa-check-double"></i> Descripción:</label> {{$Cuenta->descripcion}}
                  </div>
                  <div class="col-md-12" style="margin-top: 40px;">
                     <h4>Dirección</h4><hr>
                  </div>
                    <div class="col-md-12">
                     <label>
                     <i class="fas fa-map-marked-alt"></i> Calle:
                     </label>
                     {{$Cuenta->calle}}
                  </div>

                   <div class="col-md-6">
                     <label>
                     <i class="fas fa-university"></i> Ciudad:
                     </label>
                     {{$Cuenta->ciudad}}
                  </div>

                  <div class="col-md-6">
                     <label>
                     <i class="fas fa-map-marker-alt"></i> Provincia:
                     </label>
                     {{$Cuenta->provincia}}
                  </div>

                    <div class="col-md-6">
                     <label>
                     <i class="fas fa-flag"></i> País:
                     </label>
                     {{$Cuenta->pais}}
                  </div>

                    <div class="col-md-6">
                     <label>
                    <i class="fas fa-barcode"></i> Código Postal:
                     </label>
                     {{$Cuenta->codigo_postal}}
                  </div>





                  <div class="col-md-6">
                     <label>
                     <i class="fas fa-at"></i> Email:
                     </label>
                     {{$Cuenta->correo}}
                  </div>
                  <div class="col-md-6">

                     <label><i class="fas fa-phone-square"></i>Teléfono:</label> {{$Cuenta->telefono}}
                  </div>




               </div>

               <h4 style="margin-top: 40px;">Contacto Principal</h4><hr>
               <?php if(isset($user->nombre)){ ?>
               <div class="row">
                  <div class="col-md-6">
                     <i class="fa fa-user"></i> <label>Nombre y apellido:</label> {{$user->nombre}} {{$user->apellido}}
                  </div>
                  <div class="col-md-6">
                     <i class="fa fa-desktop"></i> <label>Cargo:</label> {{$user->cargo}}
                  </div>
                  <div class="col-md-6">
                      <label><i class="fa fa-phone"></i> Teléfono:</label> {{$user->telefono}}
                  </div>
               </div>
               <?php } ?>