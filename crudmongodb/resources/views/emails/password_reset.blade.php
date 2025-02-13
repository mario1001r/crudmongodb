<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>@lang('email_reset_password.restore_password')</h1>
        <p>@lang('email_reset_password.hi'), <b>{{$user->partner->first_name.' '.$user->partner->last_name}}</b></p>
        <p>@lang('email_reset_password.paragraph_one')</p>
        <p>@lang('email_reset_password.paragraph_two')</p>
        <br>
        <p style="text-align:center;">
            <a href="{{ $url }}" class="button">@lang('email_reset_password.restore_password')</a>
        </p>
        <br><br>
        <p>@lang('email_reset_password.paragraph_three')</p>
        <p>@lang('email_reset_password.paragraph_four')</p>
        <a href="{{$url}}">{{$url}}</a>
        <p>@lang('email_reset_password.paragraph_five')</p>
        <p>@lang('email_reset_password.thanks')</p>
        <p>@lang('email_reset_password.paragraph_six') {{ config('app.name') }}</p>
    </div>
</body>
</html>
