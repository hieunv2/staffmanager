<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Poll now">

        <title>{{ config('app.name') }}</title>

    </head>
    <body>
        <div id="app">
            <app></app>
        </div>

        <script src="{{ mix('/frontend/main.js') }}"></script>
    </body>
</html>
