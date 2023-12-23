<!DOCTYPE html>
<html lang="en">
<head>
    @include('seller.css.style')
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        td {
        vertical-align: middle;
        }
        .filter-inline {
        display: inline-block;
        }
        .small-width {
            width:150px; 
        }
    </style>
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
                <a class="app-menu__item" href="{{url('/seller/item')}}" >
                    <i class="fas fa-hamburger"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Items</span>
                    
                </a>
                
            </li>
            <li >
                <a class="app-menu__item active" href="{{url('/seller/order')}}" >
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
                <h1><i class="fa fa-th-list"></i>Orders</h1>          
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Orders</li>
                <li class="breadcrumb-item active"><a href="#">Report Orders</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                <div class="tile-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{session('success')}}
                    </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-title">
                        <div class="row">                
                            <div class="col-sm-10">
                                    <div><h2>Report Orders</h2></div>
                            </div>
                        </div><br>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p>Today's Date: <?php echo date('Y-m-d'); ?></p>
                            <h5>Today's Orders: {{ $todayOrdersCount }}</h5>
                            <!-- Display other date range orders count similarly -->
                            <h5>This Week's Orders: {{ $weekOrdersCount }}</h5>
                            <h5>This Month's Orders: {{ $monthOrdersCount }}</h5>
                            <h5>This Year's Orders: {{ $yearOrdersCount }}</h5>
                        </div>
                        <div class="col-md-6">
                            <canvas id="orderChart" width="400" height="400"></canvas>
                        </div>
                        <div class="col-md-12">
                            <a href="{{ route('seller.export_orders') }}" class="btn btn-primary">Export Orders</a>
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
        <div class="d-print-none">
            <div class="float-right">
                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
            </div>
        </div> 
            
    </main>
    <!-- Essential javascripts for application to work-->
    @include('seller.js.script') 
    <!-- chart -->
    <script>
        // Get the canvas element
        var ctx = document.getElementById('orderChart').getContext('2d');
        
        // Prepare data for the chart
        var ordersData = {
            labels: ['Today', 'This Week', 'This Month', 'This Year'],
            datasets: [{
                label: 'Order Counts',
                data: [
                    {{ $todayOrdersCount }},
                    {{ $weekOrdersCount }},
                    {{ $monthOrdersCount }},
                    {{ $yearOrdersCount }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        };
        
        // Render the bar chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: ordersData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>
</html>