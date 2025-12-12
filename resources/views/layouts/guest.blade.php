<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FitWay - Login</title>

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonte padrão -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        <!-- LOGO -->
        <div class="mb-4">
            <a href="/">
                <span class="text-4xl font-bold text-indigo-600">FitWay</span>
            </a>
        </div>

        <!-- CARD -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-lg rounded-xl">
            {{ $slot }}
        </div>

    </div>

</body>
</html>
