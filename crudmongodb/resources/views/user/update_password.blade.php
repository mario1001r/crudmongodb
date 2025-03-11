@extends('layouts.app')

@section('title_page')
    @lang('generals.password_change')
@endsection

@section('buttons')
<form action="{{url('/profile/user/password')}}" method="POST" style="text-align:center;">
    @csrf
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <a href="{{url('/home')}}" class="btn btn-danger"><i class="fa-solid fa-ban"></i> @lang('generals.cancel')</a>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> @lang('generals.save')</button>
        </div>
    </div>
   
@endsection

@section('delete_button')
@endsection

@section('title')
<p style="text-align:center;">@lang('generals.password_change')</p> 
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <label for="current_password">Contraseña actual</label>
            <input type="text" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required/>
            <span id="current_password_span" style="color: red;"></span>
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <label for="password">Contraseña nueva</label>
            <input type="text" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required/>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <label for="password-confirm">Confirmar contraseña</label>
            <input type="text" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required/>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script type="text/javascript">
    //document.getElementById('current_password_span').innerHTML = 'hola error';
</script>
@endsection