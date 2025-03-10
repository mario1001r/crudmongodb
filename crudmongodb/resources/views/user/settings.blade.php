@extends('layouts.app')

@section('title_page')
@lang('generals.generals_preferences')
@endsection

@section('buttons')
<form action="{{url('/profile/user/settings')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-3 mx-auto">
            <a href="{{url('/home')}}" class="btn btn-danger">@lang('generals.cancel')</a>
            <button type="submit" class="btn btn-success">@lang('generals.save')</button>
        </div>
    </div>
@endsection

@section('delete_button')
@endsection

@section('title')
<p style="text-align:center;">@lang('generals.generals_preferences')</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <label for="language">@lang('generals.language')</label>
            <br>
            <select id="language" name="language" class="selectpicker">
                <option value="es"><a href="{{url('/setLang/es')}}">@lang('generals.spanish')</a></option>
                <option value="en"><a href="{{url('/setLang/en')}}">@lang('generals.english')</a></option>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <label for="theme">@lang('generals.bootswatch_theme')</label>
            <br>
            <select name="theme" id="theme" class="selectpicker" data-live-search="true">
                @foreach ($themes as $theme)
                    <option value="{{$theme->id}}"><a href="{{url('/setTheme/'.$theme->name)}}">{{ucfirst($theme->name)}}</a></option>
                @endforeach
            </select>
        </div>
    </div>
    <input type="hidden" id="theme_select" name="theme_select" />
    <input type="hidden" id="lang_select" name="lang_select" />
</form>
@endsection

@section('scripts')
<script type="text/javascript">
    const url_lang = "{{url('/setLang')}}";
    const url_theme = "{{url('/setTheme')}}";
    const url_home = "{{url('/home')}}";
    $('#language').change(function(){
        changeLang();
    });

    $('#theme').change(function(){
        changeTheme();
    });
    if(document.getElementById('lang_select').value == ''){
        document.getElementById('language').value = "{{$setting->language}}";
    }
    if(document.getElementById('theme_select').value == ''){
        document.getElementById('theme').value = "{{$setting->theme_id}}";
    }

    function changeLang(){
        var language_select = $('#language').val();
        const url_get_lang = url_lang+'/'+language_select;
        $.get(url_get_lang, function(data, status){
            window.location.reload();
            if(data != ''){
                document.getElementById('language').value = language_select;
                document.getElementById('lang_select').value = language_select;
            }else{
                document.getElementById('language').value = "{{$setting->language}}";
                document.getElementById('lang_select').value = "{{$setting->language}}";
            }
            
        });
    }

    function changeTheme(){
        var theme_select = $('#theme').val();
        const url_get_theme = url_theme+'/'+theme_select;
        $.get(url_get_theme, function(data, status){
            window.location.reload();
            if(data != ''){
                document.getElementById('theme').value = theme_select;
                document.getElementById('theme_select').value = theme_select;
                console.log(theme_select);
            }else{
                document.getElementById('theme').value = "{{$setting->theme_id}}";
                document.getElementById('theme_select').value = "{{$setting->theme_id}}";
            }
            
        });
    }
</script>
@endsection