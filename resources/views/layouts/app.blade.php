<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Catering Website</title>
</head>
<body class="bg-gray-100 font-sans">
    <x-navbar />
    <div class="container mx-auto mt-5">
        @yield('content')
    </div>
</div>
</body>
</html>