@extends('auth.app')

@section('content')

                    <form method="POST" action="{{ route('login') }}">
                        <div class="col-xs-12">
                        @csrf

                       <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Usuario">

                              
                                </div>
                                  @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
          </div>
                         

                          <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon"><i class="fa fa-fw fa-lock"></i></div>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Contraseña">

                              
                            </div>
                              @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                            <div class="col-xs-6">
                              <div class="checkbox">
                                     <label class="form-check-label checkbox" for="remember">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                   
                                        Recuerdame
                                    </label>
                                </div>
                                </div>
                          

                          <div class="col-xs-6">
                                <button type="submit" class="btn btn-primary">
                                     Ingresar
                                </button>
                            </div>

                          <div class="col-xs-12 text-center" style="margin-top:15px;">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿ Olvido su contraseña ?
                                </a>
                            </div>
                         

                    </div>
                    </form>
              
@endsection
