<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/alpine.min.js', 'resources/js/app.js'])
</head>

<body>
    <x-header search />
    <hr>

    <div class="container mx-auto mb-2">
        {{ $slot }}
    </div>



</body>

</html>
