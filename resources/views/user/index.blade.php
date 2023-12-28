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
    <!-- header section -->
    @include('user.layout.header')
    <!-- end header section -->
    <!-- slider section -->
    @include('user.layout.slider')
    <!-- end slider section -->
  </div>
  <div>
  @include('user.home.body')
  </div>
</body>
<footer>
  <!-- footer section -->
  @include('user.layout.footer')
  @include('user.js.script')
  <!-- End footer section -->
</footer>


</html>