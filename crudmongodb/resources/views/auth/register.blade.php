@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="text-align:center;">Registro</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/register-user')}}">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="first_name">Nombre</label>
                                    <input id="first_name" type="text" class="form-control @error('first_name') 
                                        is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" 
                                            required autocomplete="first_name" autofocus>
    
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="last_name">Apellidos</label>
                                    <input id="last_name" type="text" class="form-control @error('last_name') 
                                        is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" 
                                            required autocomplete="last_name" autofocus>
    
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="username">Usuario</label>
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                                <span id="username_span" style="color:red;"></span>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="email">Correo electrónico</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <span id="email_span" style="color:red;"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-lg-6">
                                <label for="password-confirm">Confirmar contraseña</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row" style="margin-top:3%;">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary" id="btnRegister">
                                    <i class="fa-solid fa-user-plus"></i> @lang('generals.register')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script text="text/javascript">
    var url_username = "{{url('/validateUsername')}}";
    var url_email = "{{url('/validateEmail')}}";
    $( '#username' ).on('blur',function() {
        var username_input = $('#username').val();
        if(username_input != ''){
            $('#btnRegister').prop('disabled', true);
            $.get(url_username+'/'+username_input, function( data ) {
                if(data['result'] == true){
                    document.getElementById('username_span').innerHTML = data['message'];
                    $('#btnRegister').prop('disabled', true);
                }
                $('#btnRegister').prop('disabled', false);
            });
        }
    });
    $( '#email' ).on('blur',function() {
        var email_input = $('#email').val();
        if(email_input != ''){
            $.get(url_email+'/'+email_input, function( data ) {
                if(data['result'] == true){
                    document.getElementById('email_span').innerHTML = data['message'];
                    $('#btnRegister').prop('disabled', true);
                }
                $('#btnRegister').prop('disabled', false);
            });
        }
    });
</script>
@endsection
