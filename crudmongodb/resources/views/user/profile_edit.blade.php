@extends('layouts.app')

@section('title_page')
    @lang('users.user_profile')
@endsection

@section('buttons')
@endsection

@section('title')
    {{trans('users.profile_of').' '.$user->partner->first_name.' '.$user->partner->last_name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <label for="username">Usuario</label>
            <input type="text" id="username" name="username" class="form-control" value="{{$user->username}}"/>
        </div>
        <div class="col-lg-4">
            <label for="email">Correo</label>
            <input type="text" id="email" name="email" class="form-control" value="{{$user->email}}"/>
        </div>
        <div class="col-lg-4">
            <label for="phone_number">Número telefonico</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{$user->partner->phone_number}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <label for="first_name">Nombres</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{$user->partner->first_name}}"/>
        </div>
        <div class="col-lg-4">
            <label for="last_name">Apellidos</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{$user->partner->last_name}}"/>
        </div>
        <div class="col-lg-4">
            <label for="movil">Móvil</label>
            <input type="text" id="movil" name="movil" class="form-control" value="{{$user->partner->movil}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <label for="sex">sexo</label>
            <select id="sex" name="sex" class="form-control">
                <option value="female">Femenino</option>
                <option value="male">Masculino</option>
            </select>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        document.getElementById('sex').value = "{{$user->partner->sex}}";
    </script>
@endsection