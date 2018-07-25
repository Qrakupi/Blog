<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
    @include('.admin.partials._head')
    </head>
    <body class="uk-height-viewport">
    @include('.admin.partials._navigation')

    <div class="uk-container">
        @yield('content')
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>