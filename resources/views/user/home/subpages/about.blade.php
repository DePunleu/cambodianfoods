<!DOCTYPE html>
<html>
<head>
  @include('user.css.style')
  
  <style>
    /*** Service ***/
    .service-item {
        box-shadow: 0 0 45px rgba(163, 164, 159, 0.1);
        transition: .5s;
    }

    .service-item:hover {
        background: var(--warning);
    }

    .service-item * {
        transition: .5s;
    }

    .service-item:hover * {
        color: var(--light) !important;
    }

  </style>
</head>
<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="frontend/images/Prohok-Ktis.jpg" alt="">
    </div>
    <!-- header section strats -->
    @include('user.layout.header')
    
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{ route('home') }}">
            <span>
            Cambodian Foods
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="{{ url('/menu') }}">Menu</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{{ url('/about') }}">About</a>
              </li>
            
            </ul>
            <div class="user_option">
              <form class="form-inline" action="{{route('user.search')}}" method="GET">
                @csrf
                <input class="form-control mr-sm-2 nav_search-input" type="search" name="search" placeholder="Search" aria-label="Search" style="display:none;">
                <button class="btn my-2 my-sm-0 nav_search-btn" type="button">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </button>
              </form> 
              <a class="cart_link" href="{{ url('/cart') }}">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                  <g>
                    <g>
                      <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                   c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                   C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                   c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                   C457.728,97.71,450.56,86.958,439.296,84.91z" />
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                   c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                    </g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                  <g>
                  </g>
                </svg>
                @auth
                <span class="cart_count badge bg-warning text-white ms-1 rounded-pill">{{$count}}</span>
                @endif
              </a>
              @auth
              <a class="user_link" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  @if(!empty(Auth::guard('web')->user()->image))
                    <img class="rounded-circle" src="{{asset('frontend/user_images/'.Auth::guard('web')->user()->image)}}" width="30px" height="30px" alt="User Image">
                  @else
                      <img src="{{asset('frontend/user_images/no_image.jpg/')}}" width="30px" class="rounded-circle" alt="User Image">
                  @endif
              </a>
              @else
              <a class="user_link" href="#"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              @endif
             
              <div class="dropdown-menu dropdown-menu-right" >
                @auth                
                <a class="dropdown-item" href="{{url('/profile')}}"><i class="fa fa-user"></i> Profile</a> 
                <a class="dropdown-item" href="{{url('/change_password')}}"><i class="fa fa-lock" aria-hidden="true"></i> Change Password</a> 
                <a class="dropdown-item" href="{{url('/order_history')}}"><i class="fa fa-history"></i> Order History</a>                 
                  <form action="{{route('user_logout')}}" method="POST">
                    @csrf
                    <a class="dropdown-item" href="{{ route('user_logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                    </a>
                  </form>
                @else
                <a class="dropdown-item" href="{{ route('user_login.post') }}">
                  <i class="fas fa-sign-in-alt"></i> 
                    Login
                </a>
                <a class="dropdown-item" href="{{ route('register.post') }}">
                  <i class="fa fa-user-plus"></i>
                    Register
                </a>
                @endif
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>
  <!-- about section -->
 <section class="about_section layout_padding">
  <div class="container  ">
    <div class="row">
      <div class="col-md-5 ">
        <div class="img-box">
          <img src="{{url('frontend/images/202310060639Fish-Amok.jpg')}}" alt="" width="" height="">
        </div>
      </div>
      <div class="col-md-7 p-5">
        <div class="detail-box">
          <div class="heading_container text-center">
            <h2>
              We Are Cambodian Foods
            </h2>
          </div>
          <!-- Service Start -->
          <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-user-tie text-warning mb-4"></i>
                                <h6>Master Chefs</h6>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-utensils text-warning mb-4"></i>
                                <h6>Quality Food</h6>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item rounded pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-cart-plus text-warning mb-4"></i>
                                <h6>Online Order</h6>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
          </div>
          <!-- Service End -->
          <p>
            Cambodian Foods is a ‘Living Cambodian Cuisine’. 
            By researching, practicing and promoting Cambodian cuisine, 
            we aim to safeguard the nation’s food heritage for years to come.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->
  @include('user.layout.footer')
  <!-- footer section -->
  @include('user.js.script')
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>




