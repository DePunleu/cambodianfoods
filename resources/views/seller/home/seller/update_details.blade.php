<!DOCTYPE html>
<html lang="en">
  <head>
  @include('seller.css.style')
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    @include('seller.layout.header')
    @include('seller.layout.sidebar')
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        @if(!empty(Auth::guard('web')->user()->image))
        <img class="app-sidebar__user-avatar" src="{{asset('backend/images/'.Auth::guard('web')->user()->image)}}" width="70px" alt="User Image">
        @else
        <img src="{{asset('backend/images/seller.png/')}}" width="70px" class="app-sidebar__user-avatar" alt="User Image">
        @endif
        <div>
          <a href="#" class="d-block">{{Auth::guard('web')->user()->name}}</a>
          <p class="app-sidebar__user-designation">seller</p>
        </div>
      </div>
      <ul class="app-menu">
        <li >
            <a class="app-menu__item" href="{{url('/seller/item')}}" >
                <i class="fas fa-hamburger"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="app-menu__label">Items</span>
                
            </a>
            
        </li>
        <li >
            <a class="app-menu__item" href="{{url('/seller/order')}}" >
                <i class="fa fa-shopping-cart"></i>
                &nbsp;&nbsp;&nbsp;
                <span class="app-menu__label">Orders</span>
                
            </a>
            
        </li>
      </ul>
    </aside>
    <!-- Body-->
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Update Seller Details</h1>
          
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Settings</li>
          <li class="breadcrumb-item"><a href="#">Update Details</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
                {{-- error message --}}
                @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error:</strong> {{Session::get('error_message')}}
                </div>
                @endif
                {{-- success message --}}
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success:</strong> {{Session::get('success_message')}}
                </div>
                @endif
                
                <form method="POST" action="{{url('seller/update_details')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input class="form-control" id="seller_email" type="email" value="{{Auth::guard('web')->user()->email}}" readonly="" >
                      </div>
                      <div class="form-group">
                        <label for="seller_name">Name</label>
                        <input class="form-control" id="seller_name" name="seller_name" type="text" required="" value="{{Auth::guard('web')->user()->name}}">
                      </div>
                      <div class="form-group">
                        <label for="seller_phone">Phone Number</label>
                        <input class="form-control" id="seller_phone" name="seller_phone" type="text" required="" value="{{Auth::guard('web')->user()->phone}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="seller_image">Photo</label>
                        <input class="form-control" id="seller_image" name="seller_image" type="file">
                        @if(!empty(Auth::guard('web')->user()->image))
                          <img class="" src="{{ asset('backend/images/'.Auth::guard('web')->user()->image) }}" alt="{{ Auth::guard('web')->user()->name }}" width="200px" height="200px">
                          <a href="{{ asset('backend/images/'.Auth::guard('web')->user()->image) }}" target="_blank">View Photo</a>
                          <input type="hidden" name="current_image" value="{{ Auth::guard('web')->user()->image }}">
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="tile-footer text-center">
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>             
                </form>              
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    @include('seller.js.script')
  </body>
</html>