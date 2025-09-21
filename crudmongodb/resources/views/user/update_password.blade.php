@extends('layouts.app')

@section('title_page')
    @lang('generals.password_change')
@endsection

@section('buttons')
<form action="{{url('/profile/user/password')}}" id="frmSave" method="POST" style="text-align:center;">
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
            <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required/>
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
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required/>
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
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required/>
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
    var url_post = "{{url('/profile/user/password')}}";
    var url_home = "{{url('/home')}}";
    $('#frmSave').on('submit',function(event){
        document.getElementById('current_password_span').innerHTML = '';
        event.preventDefault();
        $.post(url_post,{_token:$('input[name=_token]').val(),current_password:$('#current_password').val(),
            password:$('#password').val(),password_confirmation:$('#password_confirmation').val()}, function(results, status){
            if(status = 'success'){
                if(results['message'] != ''){
                    document.getElementById('current_password_span').innerHTML = results['message'];
                }
                if(results['result'] != ''){
                    document.getElementById('alert_success2').innerHTML = results['result'];
                    $('#alert_success2').show('low');
                    setTimeout(function() {
                        $('#alert_success2').hide('low');
                        window.location.href = url_home;
                    }, 6000);    
                }
            }
        });
    });  
</script>
@endsection