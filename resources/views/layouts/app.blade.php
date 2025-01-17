<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Landing Page' }}</title>
    @vite('resources/css/app.css') <!-- Include Tailwind CSS -->
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<!-- Main content will be injected here -->
<div class="container mx-auto">
    @yield('content')
</div>
</body>
</html>
