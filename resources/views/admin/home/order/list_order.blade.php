<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css.style')
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
        /* Adjustments for positioning the button */
        .float-right {
            float: right !important;
        }

        /* Margins for spacing */
        .mt-3 {
            margin-top: 1rem !important;
        }

        .mr-3 {
            margin-right: 1rem !important;
        }

    </style>
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
                <a class="app-menu__item active" href="{{url('/admin/order')}}" >
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
            <li >
                <a class="app-menu__item" href="{{url('/admin/report')}}" >
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
                <h1><i class="fa fa-th-list"></i> Orders</h1>          
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Orders</li>
                <li class="breadcrumb-item active"><a href="#">All Orders</a></li>
               
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
                                <div><h2>All Orders</h2></div>    
                                    <form method="POST" action="{{ route('admin.orders.filter') }}">
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
                    
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead class="bg-light text-dark p-3 text-center">
                            <tr>
                                <th>#</th>                          
                                <th>Name</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($orders->reverse() as $order)
                            <tr  data-order-id="{{ $order->id }}">
                                <td>{{$count++}}</td>   
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->orderItems->sum(function ($orderItem) { return $orderItem->price * $orderItem->quantity; }) }}$</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>{{ $order->created_at }}</td> 
                                <td class="">
                                    
                                        <span id="delivery-status-{{ $order->id }}">
                                            @if ($order->delivery_status === 'Order Received')
                                                <span class="badge badge-primary">{{ $order->delivery_status }}</span>
                                            @elseif ($order->delivery_status === 'In-Progress')
                                                <span class="badge badge-secondary">{{ $order->delivery_status }}</span>
                                            {{--@elseif ($order->delivery_status === 'Shipped')
                                                <span class="badge badge-warning">{{ $order->delivery_status }}</span>
                                            --}}
                                            @elseif ($order->delivery_status === 'Delivering')
                                                <span class="badge badge-info">{{ $order->delivery_status }}</span>
                                            @elseif ($order->delivery_status === 'Completed')
                                                <span class="badge badge-success">{{ $order->delivery_status }}</span>
                                            @else
                                            <span class="badge badge-danger">{{ $order->delivery_status }}</span>
                                            @endif
                                        </span>

                                    
                                    
                                </td>                                 
                                <td  class="text-center">
                                    <a href="{{ url('/admin/detail_order/'.$order->id) }}">
                                        <button type="button" class="btn btn-primary center-text" >
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                            View
                                        </button>
                                        </a>
                                    </td>
                                <td class="text-center">
                                    <a class="badge badge-danger delete" href="{{url('/admin/order/'.$order->id)}}" onclick="return confirm('Are you sure?')" title="Delete" data-toggle="tooltip">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    &nbsp;
                                    
                                    {{--<a class="badge badge-success view" href="{{url('/admin/invoice/'.$order->id)}}" title="View" data-toggle="tooltip">
                                        <i class="fa fa-eye"></i>
                                    </a>--}}
                                </td>
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
    @include('admin.js.script') 

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Update status column color when select option changes
        $('#sampleTable').on('.order-status-select').change(function () {
            var statusBadge = $(this).closest('tr').find('.delivery-status-badge');
            var selectedStatus = $(this).val();
            
            if (selectedStatus === 'Order Received') {
                statusBadge.html('<span class="badge badge-primary">' + selectedStatus + '</span>');
            } else if (selectedStatus === 'In-Progress') {
                statusBadge.html('<span class="badge badge-secondary">' + selectedStatus + '</span>');
            } else if (selectedStatus === 'Delivered') {
                statusBadge.html('<span class="badge badge-info">' + selectedStatus + '</span>');
            } else if (selectedStatus === 'Completed') {
                statusBadge.html('<span class="badge badge-success">' + selectedStatus + '</span>');
            } 
            else if (selectedStatus === 'Canceled') {
                statusBadge.html('<span class="badge badge-danger">' + selectedStatus + '</span>');
            }
            else {
                statusBadge.text(selectedStatus);
            }
            location.reload();
        });
    });
</script>
</body>
</html>