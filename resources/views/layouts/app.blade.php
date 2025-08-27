<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - Dashboard Admin - Sistem Pengadaan & Peminjaman</title>
    <link rel="stylesheet" href="{{ asset('dashboard/style.css') }}" />
    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    @include('partials.sidebar')
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Navbar -->
        @include('partials.navbar')

        <!-- Content Page -->
        @yield('content')

        @include('partials.footer')
        <script src="{{ asset('dashboard/script.js') }}"></script>
        @stack('scripts')



</body>

</html>
