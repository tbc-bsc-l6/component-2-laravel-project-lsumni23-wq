<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
    @fluxAppearance

    <link rel="preconnect" href="https://fonts.bunny.net">    
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

</head>
<body class="min-h-screen bg-gray-100">
    
    @if (!Route::is('login') && !Route::is('register'))    
        <header class="w-full p-4 bg-white shadow-md flex justify-between items-center">
            <x-auth-buttons />
        </header>
    @endif
    
    <main class="mt-10">
        {{ $slot }}
    </main>
    
    @livewireScripts
    @fluxScripts
    @vite('resources/js/app.js')

</body>
</html>
