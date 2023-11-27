<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css.style')
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Header Navbar-->
    @include('admin.layout.header')
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    @include('admin.layout.sidebar')
     <!-- Body-->
    @include('admin.home.dashboard')
    {{-- JavaScript --}}
    @include('admin.js.script')
  </body>
</html>