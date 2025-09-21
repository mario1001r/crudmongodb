@extends('layouts.app')

@section('title_page')
 Países   
@endsection

@section('styles')
<style>
    .center{
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .country_flag{
        height:auto;
        width:100px;
        text-align:center;
    }
    .card {
        border: none;
    }
    .margen_row{
        margin-top:2%;
    }
</style>
@endsection

@section('buttons')
@endsection

@section('delete_button')
@endsection

@section('title')
Países
@endsection

@section('content')
<?php $columns = 1;?>
<div class="row margen_row">
@foreach ($countries as $country)
        <div class="col-lg-3">
            <div class="card" style="width: 18rem;">
                <img src="{{url('/admin/countries/getImage/'.$country->flag)}}" class="card-img-top center country_flag"/>
                <div class="card-body center">
                    <h3 class="card-title"><a href={{url('/admin/countries/create')}}>{{$country->name}}</a></h3>
                    <p class="card-text">{{$country->abbreviation}}</p>
                </div>
            </div>
        </div>
    <?php 
        $columns++;
        if($columns == 5){
            echo "</div>";
            echo "<div class='row margen_row'>";
            $columns = 1;
        }
    ?>   
@endforeach
</div>

@endsection

@section('scripts')
@endsection