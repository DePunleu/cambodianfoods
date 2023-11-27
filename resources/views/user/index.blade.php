<!DOCTYPE html>
<html>
<head>
  @include('user.css.style')
</head>
<body>

  <div class="hero_area">
    
    <div class="bg-box">
      <img src="frontend/images/Prohok-Ktis.jpg" alt="">
    </div>
    <!-- header section strats -->
    @include('user.layout.header')
    <!-- end header section -->
    <!-- slider section -->
    @include('user.layout.slider')
    <!-- end slider section -->
  </div>
  @include('user.home.body')
  <!-- offer section -->
  {{-- @include('user.home.offer') --}}
  <!-- end offer section -->
  <!-- food section -->
  {{-- @include('user.home.menu') --}}
  <!-- end food section -->
  <!-- about section -->
  {{-- @include('user.home.about') --}}
  <!-- end about section -->
  <!-- book section -->
  {{-- @include('user.home.book') --}}
  <!-- end book section -->
  <!-- client section -->
  {{-- @include('user.home.client') --}}
  <!-- end client section -->
  <!-- footer section -->
  @include('user.layout.footer')
  <!-- footer section -->
  @include('user.js.script')
</body>

</html>