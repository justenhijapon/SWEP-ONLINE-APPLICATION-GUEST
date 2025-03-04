<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ asset('favicon.png') }}">

  <title>SRA | Online Application</title>
  @include('layouts.css-plugins')
</head>
<body>
  <div id="wrapper">
    @include('layouts.admin-sidenavs')
    <div id="page-wrapper" class="gray-bg dashbard-1">
      <div class="row border-bottom">
        @include('layouts.admin-topnav')
      </div>
      <div class="content-wrapper">
        @yield('content')
      </div>
      <div class="footer">
        <div class="float-right">
{{--          MIS - <strong>VISAYAS</strong>--}}
        </div>
        <div>
          <strong>Copyright</strong> &copy; <script>document.write(new Date().getFullYear())</script>
          <a href="https://www.sra.gov.ph/" style="font-weight: bold">SRA</a> All rights reserved.
        </div>
      </div>
    </div>
  </div>
@yield('modals')
@include('layouts.js-plugins')
@yield('scripts')
</body>
</html>