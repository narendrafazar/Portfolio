<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    {{-- Style --}}
    {{-- stack untuk menambahkan css dimanapun --}}
    @stack('prepend-style') {{-- prepend buat bagian atas --}}
    @include('includes.style')
    @stack('addon-style') {{-- addon buat bagian bawah --}}


  </head>

  <body>
    {{-- Navbar --}}
    @include('includes.navbar-auth')

    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    @include('includes.footer')
    
    {{-- Script --}}
    @stack('prepend-script') {{-- prepend buat bagian atas --}}
    @include('includes.script')
    @stack('addon-script') {{-- addon buat bagian bawah --}}

  </body>
</html>
