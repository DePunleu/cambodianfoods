<!-- jQery -->
<script src="{{url('frontend/js/jquery-3.4.1.min.js')}}"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<!-- bootstrap js -->
<script src="{{url('frontend/js/bootstrap.js')}}"></script>
<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<!-- isotope js -->
<script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
<!-- nice select -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
<!-- custom js -->
<script src="{{url('frontend/js/custom.js')}}"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function() {
      $('.nav_search-btn').click(function() {
        $('.nav_search-input').toggle();
      });
    });
  </script>

<script>
    $(document).ready(function() {
      $('select').niceSelect();
    });
  </script>

  {{-- Show password script --}}
  <script type="text/javascript">
    var toggle = document.querySelector("#show-password");
    var password = document.querySelector("input[name='password']");
  
    toggle.addEventListener("click", handleToggleClick, false);
  
    function handleToggleClick(event){
      if(password.type === "password"){
        console.warn("Change input 'type' to text");
        password.type="text";
      }
      else{
        console.warn("Change input 'type' to password");
        password.type="password";
      }
    }
  </script>
  {{-- close button script --}}
  <script>
    // Add the necessary JavaScript code to handle the alert's dismissal
    var alert = document.querySelector('.alert');
    var closeButton = alert.querySelector('.close');
    closeButton.addEventListener('click', function() {
      alert.style.display = 'none';
    });
  </script>
{{-- /* Show user Image script */ --}}
<script type="text/javascript">
  $(document).ready(function(){
    $('#user_image').change(function(e){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#showImage').attr('src',e.target.result);
      }
      reader.readAsDataURL(e.target.files['0']);
    });
  });

</script>

<script>
  function myFunction() {
      document.getElementById("GFG").submit();
  }
</script>

<script>
   // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
</script>