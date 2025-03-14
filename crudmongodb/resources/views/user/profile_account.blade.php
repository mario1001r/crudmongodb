@extends('layouts.app')

@section('title_page')
    @lang('users.user_profile')
@endsection

@section('buttons')
<a href="{{url('/home')}}" class="btn btn-info"><i class="fa-solid fa-backward"></i> @lang('generals.go_back')</a>
    <a href="{{url('/profile/user/edit')}}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> @lang('generals.edit')</a>
@endsection

@section('title')
    {{trans('users.profile_of').' '.$user->partner->first_name.' '.$user->partner->last_name}}
@endsection

@section('content')
<div class="col-lg-10">
    <table cellspacing="10" width="100%">
        @if($user->partner->photo != null && Storage::disk('users_profile_imgs')->exists($user->partner->photo))
            <tr>
                <td valign="top" width="20%">
                    <p><i class="fa-solid fa-user-tie"></i> <b>Foto</b></p>
                </td>
                <td width="80%">
                   <img src="{{url('/getImageProfileUser/'.$user->partner->photo)}}" width="150px" height="150px" class="img-circle" />
                </td>
            </tr>
        @else
            <?php $url_img = '';?>
            @if(Auth::user()->partner->sex == 'male')
                <?php $url_img = '/getImageProfileUser/avatar_man.png';?>
            @else
                <?php $url_img = '/getImageProfileUser/avatar_women.png';?>
            @endif 
            <tr>
                <td valign="top" width="20%">
                    <p><i class="fa-solid fa-user-tie"></i> <b>Foto</b></p>
                </td>
                <td width="80%">
                    <img src="{{url($url_img)}}" width="150px" height="150px" class="img-circle" />
                </td>
            </tr>
        @endif
        <tr>
            <td valign="top" width="20%">
                <p><i class="fa-solid fa-user-tie"></i> <b>@lang('users.username')</b></p>
            </td>
            <td width="80%">
                <p>{{$user->username}}</p>
            </td>
        </tr>
        <tr>
            <td valign="top" width="20%">
                <p><i class="fa-regular fa-envelope"></i> <b>@lang('users.email')</b></p>
            </td>
            <td width="80%">
                <p>{{$user->email}}</p>
            </td>
        </tr>
        <tr>
            <td valign="top" width="20%">
                <p><i class="fa-regular fa-envelope"></i> <b>@lang('users.sex')</b></p>
            </td>
            <td width="80%">
                <p>{{$sex}}</p>
            </td>
        </tr>
        <tr>
            <td valign="top" width="20%">
                <p><i class="fa-regular fa-envelope"></i> <b>@lang('users.movil')</b></p>
            </td>
            <td width="80%">
                <p>{{$user->partner->movil}}</p>
            </td>
        </tr>
        <tr>
            <td valign="top" width="20%">
                <p><i class="fa-regular fa-envelope"></i> <b>@lang('users.birthday')</b></p>
            </td>
            <td width="80%">
                <p>{{$user->partner->birthday}}</p>
            </td>
        </tr>
        <tr>
            <td valign="top" width="20%">
                <p><i class="fa-regular fa-envelope"></i> <b>@lang('users.address')</b></p>
            </td>
            <td width="80%">
                <p>{{$user->partner->street.' '.$address_number.' ,col: '.$user->partner->colony.' ,CP:'.$user->partner->postal_code}}</p>
            </td>
        </tr>
       
    </table>
</div>

@endsection

@section('scripts')
@endsection