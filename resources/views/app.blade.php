<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ListUp</title>
    <!-- Ziggy setup for better route names -->
    @routes

    <!-- Inertia setup -->
    @vite('resources/js/app.js')
    @inertiaHead
</head>

<body class="h-full">
    @inertia
</body>

</html>