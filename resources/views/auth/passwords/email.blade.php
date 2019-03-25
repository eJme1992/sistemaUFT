@extends('auth.app')

@section('content')

<div class="text-center col-lg-12">
 <h2> Recetear contraseña </h2>
</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  

                    <form method="POST"  class="text-center" action="{{ route('password.email') }}">
                        @csrf

                           <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo Electrónico</label>
<div class="input-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Enviar enlace de resect al correo
                                </button>
                            </div>
                        
                    </form>
        
@endsection
