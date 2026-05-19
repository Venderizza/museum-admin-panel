<html>

<head>
    <title>{{ $title ?? 'Todo Manager' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles()
</head>

<body class="bg-amber-100">
    <div class="min-h-screen max-h-screen">
        {{ $slot }}
    </div>
    @livewireScripts()
</body>

</html>