<!DOCTYPE html>
<html lang="en">
  <head>
  @include('seller.css.style')
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    @include('seller.layout.header')
    <!-- Sidebar menu-->
    @include('seller.layout.sidebar')
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user">
        @if(!empty(Auth::guard('web')->user()->image))
        <img class="app-sidebar__user-avatar" src="{{asset('backend/images/'.Auth::guard('web')->user()->image)}}" width="70px" alt="User Image">
        @else
        <img src="{{asset('backend/images/seller.png')}}" width="70px" class="img-circle elevation-2" alt="User Image">
        @endif
        <div>
          <a href="#" class="d-block">{{Auth::guard('web')->user()->name}}</a>
          <p class="app-sidebar__user-designation">Seller</p>
        </div>
      </div>
      <ul class="app-menu">

        <li >
            <a class="app-menu__item" href="{{url('/seller/users')}}" >
                <i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;
                <span class="app-menu__label">Users</span>         
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
          <h1><i class="fa fa-edit"></i> Update Seller Password</h1>
          
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Settings</li>
          <li class="breadcrumb-item"><a href="#">Update Password</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="tile">
            <div class="row">
              <div class="col-lg-12">
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
                <form method="POST" action="{{url('seller/update_password')}}">
                  @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input class="form-control" id="seller_email" type="email" value="{{Auth::guard('web')->user()->email}}" readonly="" >
                  </div>
                  <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input class="form-control" id="current_password" name="current_password" 
                        type="password" placeholder="Enter current password">
                    <span id="verifyCurrentPwd"></span> 
                  </div>
                  <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input class="form-control" id="new_password" name="new_password" 
                        type="password" placeholder="Enter new password">
                  </div>
                  <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input class="form-control" id="confirm_password" name="confirm_password" 
                    type="password" placeholder="Enter confirm password">
                  </div>
                  <div class="tile-footer text-center">
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>
                </form>
              </div>
              </div>
            </div>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    @include('seller.js.script')
  </body>
</html>