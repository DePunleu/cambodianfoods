<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('backend/docs/css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login Accountant</title>
  </head>
  <body>
    <!-- <section class="material-half-bg">
      <div class="cover"></div>
    </section> -->
    <section class="material-half-bg">
      <div class="bg-box">
        <img src="backend/images/Prohok-Ktis.jpg" alt="">
      </div>
      </section>
    <section class="login-content">
      <div class="logo">
        <h1>Accountant</h1>
      </div>
      <div class="login-box">
        <form class="login-form" method="POST" action="{{ url('/accountant') }}">
          @csrf
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>LOGIN</h3>
          {{-- error message --}}
          @if ($errors->has('error_message'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error: </strong> {{ $errors->first('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @elseif ($errors->any())
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach  
            </ul>
          </div>
          @endif

          <div class="form-group">     
            <label class="control-label">EMAIL</label>
            <input class="form-control" name="email" type="email" required="" placeholder="Email" autofocus>
          </div>

          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" name="password" type="password" required="" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <input type="checkbox" id="show-password" class="show-password"><span class="label-text">Show Password</span>
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>
        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="backend/docs/js/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="backend/docs/js/popper.min.js"></script>
    <script src="backend/docs/js/bootstrap.min.js"></script>
    <script src="backend/docs/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="backend/docs/js/plugins/pace.min.js"></script>
    <script type="backend/docs/text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });

      
    </script>
    {{-- Show password accountant login script --}}
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
          <style>
        /* Set full screen styles */
        .material-half-bg {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: -1; /* adjust z-index if necessary */
        }

        /* Ensure the image fills the container */
        .material-half-bg .bg-box {
          width: 100%;
          height: 100%;
          overflow: hidden;
        }

        .material-half-bg .bg-box img {
          width: 100%;
          height: 100%;
          object-fit: cover; /* Maintain aspect ratio and cover the entire space */
        }
      </style>
    
  </body>
</html>