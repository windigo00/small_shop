<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        @yield('styles')
    </head>
    <body>
        @yield('content')

        <!-- FA -->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" data-auto-replace-svg="nest"></script>
        <!-- App resources -->
        <script>

            window._locale = '{{ app()->getLocale() }}';
            window._translations = @json(app('translator')->getTranslations());
            window._country_list = []; //@ json(cache('country_list')[app()->getLocale()]);

            window._cardCheckRoute = '{{ route('card.check') }}';

        </script>
    </body>
</html>
