<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Laravel App')</title>
    @vite('./resources/css/app.css')
</head>

<body>
    @include('include.header')
    <main class="container mx-auto py-4 my-2">
        @yield('content')
    </main>
</body>

</html>
