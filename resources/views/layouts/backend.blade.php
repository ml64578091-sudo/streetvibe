<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>

  <link rel="shortcut icon" type="image/png" href="{{ asset('backend/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('backend/css/styles.min.css') }}" />

  @yield('css')
</head>

<body>
<div class="page-wrapper" id="main-wrapper"
     data-layout="vertical"
     data-navbarbg="skin6"
     data-sidebartype="full"
     data-sidebar-position="fixed"
     data-header-position="fixed">

    {{-- Sidebar --}}
    @include('layouts.component-backend.sidebar')

    <div class="body-wrapper">

      {{-- Navbar --}}
      @include('layouts.component-backend.navbar')

      {{-- Content --}}
      @yield('content')

    </div>
</div>

<script src="{{ asset('backend/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('backend/js/app.min.js') }}"></script>
<script src="{{ asset('backend/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('backend/js/dashboard.js') }}"></script>

@yield('js')
</body>
</html>
