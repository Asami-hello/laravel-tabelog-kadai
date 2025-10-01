<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', '') }}</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/9cb462481a.js" crossorigin="anonymous"></script>

        <!-- ここはngrokでの確認が終わったら下のコード戻すす -->
        <!-- <link href="{{ asset('css/nagoyameshi.css') }}" rel="stylesheet"> -->
        <link href="/kadai_002/nagoyameshi/public/css/nagoyameshi.css" rel="stylesheet">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">

    </head>
    
    <body class="d-flex flex-column min-vh-100">
        <div id="app" class="d-flex flex-column flex-grow-1">
            @component('components.header')
            @endcomponent

            <main class="flex-grow-1">
                @yield('content')
            </main>

            @component('components.footer')
            @endcomponent
            @stack('scripts')
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    </body>
</html>