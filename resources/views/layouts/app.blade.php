<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials._head')
</head>
<body>
    <div id="app">
        @include('partials._navigation')
        <main class="py-4">
            <div class="" style="width:50%;height:100%;margin-left:auto;margin-right:auto">
            @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
