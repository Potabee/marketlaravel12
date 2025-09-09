<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

    <!-- Custom CSS untuk layout dashboard -->
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .sidebar {
            width: 260px;
            /* Lebar sidebar */
        }

        .main-content {
            width: 100%;
        }

        /* Aturan untuk layar desktop (lg ke atas) */
        @media (min-width: 992px) {
            .main-content {
                margin-left: 260px;
                /* Sesuaikan dengan lebar sidebar */
            }
        }
    </style>

</head>

<body class="bg-light">

    <!-- Sidebar (Offcanvas untuk mobile, fixed untuk desktop) -->
    @include('layouts.sidebar')

    <!-- Main Content Wrapper -->
    <div class="main-content">
        <!-- Top Navigation Bar -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow-sm">
                <div class="container-fluid py-3 px-4">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="container-fluid p-4">
            {{ $slot }}
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
