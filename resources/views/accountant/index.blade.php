<!DOCTYPE html>
<html lang="en">
  <head>
    @include('accountant.css.style')
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Header Navbar-->
    @include('accountant.layout.header')
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    @include('accountant.layout.sidebar')
     <!-- Body-->
    @include('accountant.home.dashboard')
    {{-- JavaScript --}}
    @include('accountant.js.script')
  </body>
</html>