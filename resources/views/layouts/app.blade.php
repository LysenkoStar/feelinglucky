<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feeling Lucky</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">

<!-- Обертка контента -->
<div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    @yield('content')
</div>

</body>
</html>
