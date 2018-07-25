<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tree of Health - Administrative area</title>
        <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
        <link href="{{ mix('/css/admin/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body class="uk-background-muted" style="width: 100%; height: 100vh">
    
        <div class="uk-card uk-card-default uk-card-body uk-width-1-3@m uk-position-center">
            <div class="uk-text-center">
                <img src="/img/logo-big-gray.svg" style="height: 95px">
            </div>
            <h2 class="uk-card-title uk-text-center uk-margin-remove-top">Administrative area</h2>

            <form class="uk-form-stacked" method="post">
                {{ csrf_field() }}

                @if (isset($error))
                    <div class="uk-alert-danger uk-padding-small">
                        {{ $error }}
                    </div>
                @endif

                <div class="uk-margin">
                    <label class="uk-form-label" for="email">Email</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="email" name="email" type="email">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="password">Password</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="password" name="password" type="password">
                    </div>
                </div>

                <div class="uk-text-center">
                    <button class="uk-button uk-button-primary uk-width-1-2">Login</button>
                </div>

            </div>
        </div>
    </body>
</html>