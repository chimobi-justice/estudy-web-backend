<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>estudy</title>

    </head>
    <body class="antialiased">
        server started at {{env('APP_URL')}}
    </body>
</html>
