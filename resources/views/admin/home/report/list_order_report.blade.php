<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css.style')
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <a class="app-menu__item" href="{{url('admin/dashboard')}}">
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
            <li>
                <a class="app-menu__item" href="{{url('/admin/submenu')}}" >
                    <i class="fas fa-utensils"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Sub Menus</span>
                    
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
            <li class="treeview is-expanded"><a class="app-menu__item " href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Report</span><i></i></a>
                <ul class="treeview-menu">
                    <li><a class="treeview-item" href="/admin/order_report"><i class="icon fa fa-circle-o"></i>Order Report</a></li>
                    <li><a class="treeview-item" href="/admin/item_report"><i class="icon fa fa-circle-o"></i>Item Report</a></li>
          
                </ul>
            </li>
        </ul>
    </aside>
    <!-- Body-->
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i>Report</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Report</li>
                <li class="breadcrumb-item active"><a href="#">Order Report</a></li>
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
                                    <div><h2>Order Report</h2></div>
                                    <div>
                                    <form method="POST" action="{{ route('admin.Orders_report.filter') }}">
                                        @csrf <!-- CSRF protection -->

                                        <!-- Start Date Input -->
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" id="start_date" name="start_date">

                                        <!-- End Date Input -->
                                        <label for="end_date">End Date:</label>
                                        <input type="date" id="end_date" name="end_date">

                                      

                                         <!-- Status selection -->
                                        <label for="status">Status:</label>
                                        <select id="status" name="status">
                                            <option value="">Select Status</option>
                                            @foreach ($orderStatuses as $status)
                                                <option value="{{ $status }}" @if ($selectedStatus === $status) selected @endif>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <!-- Submit Button -->
                                        <button type="submit">Filter Orders</button>
                                    </form> 

                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- Table or content related to report -->
                        <table class="table table-hover table-bordered" id="sampleTable">
                        <thead class="bg-light text-dark p-3 text-center">
                            <tr>
                                <th>#</th>                          
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $count = 1; // Counter variable for row numbers
                            @endphp
                            @foreach ($orders -> reverse() as $order)
                            @foreach ($order->orderItems as $orderItem)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $orderItem->item_title }}</td>
                                <td>{{ $orderItem->price }}</td>
                                <td>{{ $orderItem->quantity }}</td> 
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>              
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    @include('admin.js.script')
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
