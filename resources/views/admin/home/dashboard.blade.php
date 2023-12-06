<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css.style')
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

</head>
<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    @include('admin.layout.header')
    <!-- Sidebar menu-->
    @include('admin.layout.sidebar')
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            @if(!empty(Auth::guard('web')->user()->image))
            <img class="app-sidebar__user-avatar" src="{{asset('backend/images/'.Auth::guard('web')->user()->image)}}" width="70px" alt="User Image">
            @else
            <img src="{{asset('backend/images/admin.png')}}" width="70px" class="img-circle elevation-2" alt="User Image">
            @endif
            <div>
            <a href="#" class="d-block">{{Auth::guard('web')->user()->name}}</a>
            <p class="app-sidebar__user-designation">Admin</p>
            </div>
        </div>
        <ul class="app-menu">
          <li>
              <a class="app-menu__item active" href="{{url('admin/dashboard')}}">
                  <i class="app-menu__icon fa fa-dashboard"></i>
                  <span class="app-menu__label">Dashboard</span>
              </a>
          </li>
          
          
          <li >
              <a class="app-menu__item" href="{{url('/admin/users')}}" >
                  <i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;
                  <span class="app-menu__label">Users</span>         
              </a>
              
          </li>
          <li>
              <a class="app-menu__item " href="{{url('/admin/menu')}}" >
                  <i class="fas fa-utensils"></i>
                  &nbsp;&nbsp;&nbsp;
                  <span class="app-menu__label">Menus</span>
                  
              </a>
              
          </li>
          <li >
              <a class="app-menu__item" href="{{url('/admin/item')}}" >
                  <i class="fas fa-hamburger"></i>
                  &nbsp;&nbsp;&nbsp;
                  <span class="app-menu__label">Items</span>
                  
              </a>
              
          </li>
          <li >
     
          <li >
              <a class="app-menu__item" href="{{url('/admin/order')}}" >
                  <i class="fa fa-shopping-cart"></i>
                  &nbsp;&nbsp;&nbsp;
                  <span class="app-menu__label">Orders</span>
                  
              </a>
              
          </li>

          <li >
                <a class="app-menu__item" href="{{url('/admin/supplier')}}" >
                    <i class="fas fa-users"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Suppliers</span>
                    
                </a>
                
            </li>
      </ul>
    </aside>
    <!-- Body-->
    <main class="app-content">
        <div class="app-title">
          <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          </div>
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          </ul>
        </div>
        <div class="row">
          <!-- <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fas fa-utensils fa-3x"></i>
              <div class="info">
                <h4>Menus</h4>
                <p><b>{{ $menus_count }}</b></p>
              </div>
            </div>
          </div> -->

          <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fas fa-utensils fa-3x"></i>
              <div class="info">
                <h4>Foods</h4>
                <p><b>{{ $foods_count }}</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fas fa-utensils fa-3x"></i>
              <div class="info">
                <h4>Combo</h4>
                <p><b>{{ $combo_count }}</b></p>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fas fa-cheese fa-3x"></i>
              <div class="info">
                <h4>Dessert</h4>
                <p><b>{{ $dessert_count }}</b></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fas fa-coffee fa-3x" ></i>
              <div class="info">
                <h4>Drink</h4>
                <p><b>{{ $drink_count }}</b></p>
              </div>
            </div>
          </div> 

        </div>
    
        <div class="row">
          <div class="col-md-6">
            <div class="tile">
              <h3 class="tile-title">Users Chart</h3>
              <div>
                <canvas id="chart" style=" min-height: 200px;">
                </canvas>
              </div>    
            </div>
          </div>
          <div class="col-md-6">
            <div class="tile">
              <h3 class="tile-title">Orders Status Chart</h3>
              <div>
                <canvas id="orderStatusChart" style=" max-height: 185px;"></canvas>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <h5><span>Total Orders: {{ $orders_count }}</span></h5>
                </div>
                <div class="col-md-6">
                  <h5><span>Total Sales: {{ $completedOrdersTotalPrice }}$</span></h5>
                </div>
                
              </div>
              
            </div>
          </div>
        </div>     
      </main>
    <!-- Essential javascripts for application to work-->
    @include('admin.js.script') 
    <!-- User Chart script-->   
    <script>
      var ctx = document.getElementById('chart').getContext('2d');
      var userChart = new Chart(ctx,{
        type:'bar',
        data:{
          labels: {!! json_encode($labels) !!},
          datasets: {!! json_encode($datasets) !!}
        },
      });
    </script>
    <script>
      // Order Delivery Status Chart
    var orderStatusData = {
      labels: {!! json_encode($orderLabels) !!},
      datasets: {!! json_encode($orderDataset) !!}
    };

    var orderStatusChartCtx = document.getElementById('orderStatusChart').getContext('2d');
    var orderStatusChart = new Chart(orderStatusChartCtx, {
      type: 'pie',
      data: orderStatusData
    });
    // Order Delivery Status Chart

  </script>
    
    

  </body>
  </html>