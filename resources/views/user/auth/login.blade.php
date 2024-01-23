<!DOCTYPE html>
<html>
<head>
  @include('user.css.style')
  <style>
    .hero_area {
      background: url('frontend/images/hero-bg.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      height: 100vh;
    }
    .form-container {
      position: absolute;
      top: 55%; 
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(245, 237, 237, 0.7) !important;
      border-radius: 10px;
      width: 400px;
    }
    .alert {
      z-index: 9999;
    }
    .card-header{      
      padding: 0.75rem 1.25rem;
      background-color: rgb(42, 2, 2) !important;
      border-bottom: 1px solid rgba(0, 0, 0, 0.125);
      
    }
    .input-group-prepend span{
      width: 50px;
      background-color: rgb(42, 2, 2) !important;
      color: white;
      border:0 !important;
      }
      input:focus{
      outline: 0 0 0 0  !important;
      box-shadow: 0 0 0 0 !important;
      }
      .remember input
      {
      width: 20px;
      height: 20px;
      margin-left: 15px;
      margin-right: 5px;
      }
      .login_btn{
      color: white;
      background-color: rgb(42, 2, 2) !important;
      width: 100px;
      }
      .login_btn:hover{
      color: white;
      background-color: white;
      }
      .links{
      color: white;
      }

      .links a{
      margin-left: 4px;
      }   
  </style>
</head>
<body>
  <div class="hero_area">
    <div class="bg-box">
      <img src="frontend/images/Prohok-Ktis.jpg" alt="">
    </div>
    <!-- header section strats -->
    @include('user.layout.header')
    <!-- end header section -->
    <div class="form-container">
      <div class="card-header text-center">
      <span style="color: white;">LOGIN</span>
      </div>
      <br>     
        <div class="container">        
          @if(session()->has('error'))
          <div class="alert alert-danger" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{session('error')}}
          </div>          
          @endif
          @if(session()->has('success'))
          <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{session('success')}}
          </div>
          @endif                   
        <form method="POST" action="{{url('/login')}}">
            @csrf        
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
              </div>             
              <input type="email" class="form-control" name="email" placeholder="Email" required="">              
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" class="form-control" name="password" placeholder="Password" required="">             
            </div>
            <div class="row align-items-center remember">
              <label>
                <input type="checkbox" id="show-password" class="show-password"><span class="label-text"> Show Password</span>
              </label>
            </div>            
            <div class="form-group text-center">
              <input type="submit" value="Login" class="btn login_btn">
            </div>
            <div class="text-center">
              <label>
                <span>Don't have an account?</span>
                <a href="{{ route('register.post') }}" class="">Register</a>
              </label>
            </div>
          </form>
          </div>
    </div>
  </div>
  @include('user.js.script')
</body>
</html>