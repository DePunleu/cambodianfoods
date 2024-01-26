<!DOCTYPE html>
<html lang="en">

<head>
    @include('accountant.css.style')
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    @include('accountant.layout.header')
    <!-- Sidebar menu-->
    @include('accountant.layout.sidebar')
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user">
            @if(!empty(Auth::guard('web')->user()->image))
            <img class="app-sidebar__user-avatar" src="{{asset('backend/images/'.Auth::guard('web')->user()->image)}}" width="70px" alt="User Image">
            @else
            <img src="{{asset('backend/images/accountant.png')}}" width="70px" class="img-circle elevation-2" alt="User Image">
            @endif
            <div>
                <a href="#" class="d-block">{{Auth::guard('web')->user()->name}}</a>
                <p class="app-sidebar__user-designation">Accountant</p>
            </div>
        </div>
        <ul class="app-menu">
            <li>
                <a class="app-menu__item" href="{{url('accountant/dashboard')}}">
                    <i class="app-menu__icon fa fa-dashboard"></i>
                    <span class="app-menu__label">Dashboard</span>
                </a>
            </li>
            <li >
                <a class="app-menu__item" href="{{url('/accountant/order')}}" >
                    <i class="fa fa-shopping-cart"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Orders</span>
                    
                </a>
                
            </li>
            <li >
                <a class="app-menu__item active" href="{{url('/accountant/report')}}" >
                    <i class="app-menu__icon fa fa-edit"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Report</span>
                    
                </a> 
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
                <li class="breadcrumb-item active"><a href="#">All Report</a></li>
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
                                    <div><h2>Report</h2></div>
                                    <div>
                                    {{--<h3>Total Revenue: {{ $completedOrdersTotalPrice }}$</h3>--}}

                                    <form method="POST" action="{{ route('accountant.report.filter') }}">
                                        @csrf <!-- CSRF protection -->

                                        <!-- Start Date Input -->
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" id="start_date" name="start_date">

                                        <!-- End Date Input -->
                                        <label for="end_date">End Date:</label>
                                        <input type="date" id="end_date" name="end_date">

                                        <!-- Submit Button -->
                                        <button type="submit">Find</button>
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
                                <th>Sale</th>
                                <th>Revenue</th>
                                <th>Remaining</th>
                                <th>Created at</th>                      
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr> 
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->price }}$</td>
                                    <td>@php
                                            $totalOrders = $item->orderItems->sum('quantity');
                                            echo $totalOrders;
                                        @endphp
                                    </td> 
                                    <td>
                                        @php
                                            $revenue = 0;
                                            // Loop through order items related to this item from completed orders
                                            foreach($item->orderItems as $orderItem) {
                                                if ($orderItem->orders->delivery_status === 'Completed') {
                                                    $revenue += ($orderItem->quantity * $orderItem->price);
                                                }
                                            }
                                            echo $revenue;
                                        @endphp
                                        $
                                    </td>
                                    <td>{{$item->store_quantity}}</td>
                                    <td>{{$item->created_at}}</td>
                                    
                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    @include('accountant.js.script')
    <!-- Include jQuery library -->
    
</body>

</html>
