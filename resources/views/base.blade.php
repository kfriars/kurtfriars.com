<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Kurt Friars') }}</title>
        
        <script>
            window.APP_ENV = '{{ config('app.env') }}';
            window.APP_LOCALE = '{{ app()->getLocale() }}';
        
            window.url = function (path) {
                if (!path) { let path = '/'};
                return '{{ url('/') }}'+'/'+path; 
            };
        
            window.env = function (key) {
                switch (key) {
                    case 'RECAPTCHA_V2_INVISIBLE_SITE_KEY':
                        return '{{ config('recaptcha.invisible.site_key') }}';
                };
        
                return null;
            };
        
        </script>        

        @routes

        @yield('head-scripts')
        
        <meta name="description" content="{{ __('meta.public.description') }}" />
        <meta name="keywords" content="kurt,friars,developer,pro,experienced,web,digital,nomad,php,laravel,js,vue,cypress,behat,jenkins,devops,phpunit" />
        <meta name="author" content="Kurt Friars" />
        
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ff0000">
        
        <link href="{{ asset('css/vendor.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">

        @yield('styles')
    </head>

    @yield('body')
</html>
