@extends('layouts.app')

@section('title_page')
Perfil de usuario
@endsection

@section('title')
Perfil de usuario {{Auth::user()->partner->first_name.' '.Auth::user()->partner->last_name}}
@endsection

@section('content')
contenido de la página
@endsection

@section('scripts')
@endsection