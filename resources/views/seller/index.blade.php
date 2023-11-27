<!DOCTYPE html>
<html lang="en">
  <head>
    @include('seller.css.style')
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Header Navbar-->
    @include('seller.layout.header')
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    @include('seller.layout.sidebar')
     <!-- Body-->
    @include('seller.home.item')
    {{-- JavaScript --}}
    @include('seller.js.script')
  </body>
</html>