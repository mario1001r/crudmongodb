@extends('layouts.app')

<?php
$themes = \App\Models\Theme::get();
?>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align:center;">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--<p style="text-align:center;">Bienvenido <b>{{\Auth::user()->name}}</b></p>--}}
                <div class="row">
                    <div class="col-lg-6">
                        Tema de bootswatch 
                        <select name="theme" id="theme" class="form-control" onchange="changeTheme();">
                            @foreach ($themes as $theme)
                                <option value="{{$theme->name}}"><a href="{{url('/setTheme/'.$theme->name)}}">{{ucfirst($theme->name)}}</a></option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    var url_theme = "{{url('/setTheme')}}";
    var url_home = "{{url('/home')}}";
    function changeTheme(){
        var theme_select = $('#theme').val();
        var url_get_theme = url_theme+'/'+theme_select;
        $.get(url_get_theme, function(data, status){
            window.location.reload();
            document.getElementById('theme').value = theme_select;
        });
    }
</script>
@endsection
