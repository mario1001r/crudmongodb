@extends('layouts.app')

@section('title_page')
    @lang('users.user_profile')
@endsection

@section('buttons')
<form action="{{url('/profile/user/edit')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <button type="submit" class="btn btn-success"> Guardar</button>
    <a href="{{url('/profile/user')}}" class="btn btn-danger"> Cancelar</a>
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
            <br>
            <select id="sex" name="sex" class="selectpicker">
                <option value="female">Femenino</option>
                <option value="male">Masculino</option>
            </select>
            <input type="hidden" id="sex_select" name="sex_select" value="{{$user->partner->sex}}"/>
        </div>
        <div class="col-lg-4">
            <label for="street">Calle</label>
            <input type="text" id="street" name="street" class="form-control" value="{{$user->partner->street}}"/>
        </div>
        <div class="col-lg-2">
            <label for="noExt">Número Exterior</label>
            <input type="text" id="noExt" name="noExt" class="form-control" value="{{$user->partner->noExt}}"/>
        </div>
        <div class="col-lg-2">
            <label for="noInt">Número Interior</label>
            <input type="text" id="noInt" name="noInt" class="form-control" value="{{$user->partner->noInt}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <label for="colony">Colonia</label>
            <input type="text" id="colony" name="colony" class="form-control" value="{{$user->partner->colony}}"/>
        </div>
        <div class="col-lg-2">
            <label for="postal_code">Código Postal</label>
            <input type="text" id="postal_code" name="postal_code" class="form-control" value="{{$user->partner->postal_code}}"/>
        </div>
        <div class="col-lg-2">
            <label for="birthday">Fecha de nacimiento</label>
            <input type="date" id="birthday" name="birthday" class="form-control" 
                value="{{$user->partner->birthday}}" />
        </div>
        <div class="col-lg-4">
            <label for="country">País</label>
            <br>
            <select id="country" name="country" class="selectpicker" data-live-search="true">
                @foreach ($countries as $country)
                    <?php 
                        $flag = $country->flag != '' ? $country->flag:'default.png';
                    ?>
                    <option value="{{$country->id}}" data-subtext="<img src='{{asset('imgs/flags/'.$flag)}}' width='25px' height='20px' style='margin-left:10%;'>">{{ucfirst($country->name)}}</option>
                @endforeach
            </select>
            <input type="hidden" id="country_select" name="country_select" value="{{$user->partner->country_id}}"/>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <label for="state">Estado</label>
            <br>
            <select id="state" name="state" class="selectpicker" data-live-search="true"></select>
            <input type="hidden" id="state_select" name="state_select" value="{{$user->partner->state_id}}"/>
        </div>
        <div class="col-lg-4">
            <label for="city">Ciudad</label>
            <br>
            <select id="city" name="city" class="selectpicker" data-live-search="true"></select>
            <input type="hidden" id="city_select" name="city_select" value="{{$user->partner->city_id}}"/>
        </div>
        <div class="col-lg-2">
            <label for="age">Edad</label>
            <br>
            <label id="age"></label>
            <input type="hidden" id="age_input" name="age_input" value="{{$user->partner->age}}"/>
        </div>
    </div>
</form>
@endsection

@section('scripts')
    <script type="text/javascript">
        const url_states = "{{url('/api/getStatesByCountryId')}}";
        const url_cities = "{{url('/api/getCitiesByStateId')}}";
        const url_age = "{{url('/api/calculateAge')}}";
        var country_id = "{{$user->partner->country_id}}";
        var state_id = "{{$user->partner->state_id}}";
        var city_id = "{{$user->partner->city_id}}";
        var sex = "{{$user->partner->sex}}";
        document.getElementById('country').value = country_id;

        const date = new Date();

        // Edad máxima de 110 años
        const day_min = `0${date.getDate()}`.slice(-2);
        const month_min = `0${date.getMonth() + 1}`.slice(-2);
        const year_min = date.getFullYear()-110;
        var date_min = `${year_min}-${month_min}-${day_min}`;

        // Edad Mínima de 10 años
        const day_max = `0${date.getDate()}`.slice(-2);
        const month_max = `0${date.getMonth() + 1}`.slice(-2);
        const year_max = date.getFullYear()-10;
        var date_max = `${year_max}-${month_max}-${day_max}`;

        $('#birthday').attr('min',date_min);
        $('#birthday').attr('max',date_max);

    $(document).ready(function() {
        
        document.getElementById('city').value = city_id;
        document.getElementById('sex').value = sex;
        document.getElementById('age').innerHTML = "{{$age}}";

        $('#birthday').change(function(){
            calculateAge();
        });

        function calculateAge(){
            $.get(url_age+'/'+$('#birthday').val() , function(result) {
                document.getElementById('age').innerHTML = result;
                document.getElementById('age_input').value = result;
            });
        }

        if($('#country').val() == country_id){
            $('#country_select').val(country_id);
        }
        if($('#state').val() == state_id){
            $('#state_select').val(state_id);
        }
        if($('#city').val() == city_id){
            $('#city_select').val(city_id);
        }

        if($('#country').val() != ''){
            getStatesByCountryId();
        }
        

        if($('#state').val() != ''){
            getCitiesByStateId();
        }
        if($('#sex').val() == sex){
            $('#sex_select').val(sex);
        }
        $('#sex').change(function(){
            $('#sex_select').val($('#sex').val());
        });

        // Obtener los estados de país seleccionado
        $('#country').change(function(){
            $('#country_select').val($('#country').val());
            getStatesByCountryId();
        });
        // Obtener las ciudades de estado seleccionado
        $('#state').change(function(){
            getCitiesByStateId();
            $('#state_select').val(parseInt($('#state').val()));
        });

        $('#city').change(function(){
            $('#city_select').val(parseInt($('#city').val()));
        });

        function getStatesByCountryId(){
            $('#state').find('option').remove();
            $('#city').find('option').remove();
            $('#city').selectpicker('refresh');
            $.post(url_states,{_token:$('input[name=_token]').val(),country: $('#country').val()}, function(states, status){
                if(status = 'success'){
                    if(states == 'no_data'){
                        //console.log('No hay estados');
                        $('#state').find('option').remove();
                        $('#state').selectpicker('refresh');
                    }else{
                        $.each(states, function(position,state) {
                            $('#state').append("<option value='"+state.id+"'>"+state.name.charAt(0).toUpperCase()+state.name.substring(1)+"</option>");
                            $('#state').selectpicker('refresh');
                        });
                        document.getElementById('state').value = parseInt(state_id);
                        $('#state').selectpicker('refresh');
                        getCitiesByStateId();
                    }    
                }else{
                    console.log('No hay Conexión a la DB');
                }
            });
        }


        function getCitiesByStateId(){
            $('#city').find('option').remove();
            $.post(url_cities,{_token:$('input[name=_token]').val(),state:$('#state').val()},function(cities, status){
                if(status = 'success'){
                    if(cities == 'no_data'){
                        //console.log('No hay ciudades');
                        $('#city').find('option').remove();
                        $('#city').selectpicker('refresh'); 
                    }else{
                        $.each(cities, function(position,city) {
                            $('#city').append("<option value='"+city.id+"'>"+city.name.charAt(0).toUpperCase()+city.name.substring(1)+"</option>");
                            $('#city').selectpicker('refresh');
                        });
                        document.getElementById('city').value = parseInt(city_id);
                        $('#city').selectpicker('refresh');
                    }
                }else{
                    console.log('No hay Conexión a la DB');
                } 
            });
        }
    });
    </script>
@endsection