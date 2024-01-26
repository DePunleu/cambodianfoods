<!DOCTYPE html>
<html lang="en">
<head>
    @include('seller.css.style')
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
                                <h2>All Orders</h2>
                                <form method="POST" action="{{ route('seller.orders.filter') }}">
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
                            
                            {{-- <div class="col-sm-2">
                                <a href="{{ route('seller.create_order') }}">
                                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                                </a>
                            </div> --}}
                        </div><br>
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
                                {{--<td>
                                    <select class="form-control order-status-select small-width" data-order-id="{{ $order->id }}" data-url="{{ route('seller.updateOrderStatus') }}">
                                        @foreach ($orderStatuses as $orderStatus)
                                            <option value="{{ $orderStatus }}" {{ $order->delivery_status == $orderStatus ? 'selected' : '' }}>
                                                {{ $orderStatus }}
                                            </option>
                                        @endforeach
                                    </select>
                                --}}
                                    
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('/seller/detail_order/'.$order->id) }}">
                                        <button type="button" class="btn btn-primary center-text" >
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                            View
                                        </button>
                                        </a>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>    
                    </div> 
                </div>
            </div>
            
        </div>
        {{--<div class="d-print-none">
            <div class="float-right">
                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
            </div>
        </div>--}}
    </main>
    <!-- Essential javascripts for application to work-->
    @include('seller.js.script') 

<!-- Include jQuery library -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sampleTable').on('change', '.order-status-select', function() {
        var select = $(this);
        var orderId = select.data('order-id');
        var status = select.val();
        var url = select.data('url');
        // Send an AJAX request to update the status
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                orderId: orderId,
                status: status
            },
            success: function(response) {
                console.log('AJAX request successful');
                console.log(response); // Debug: Check the response object
                if (response.success) {
                    // Update the delivery status text
                    $('#delivery-status-' + orderId).text(status);
                } else {
                    console.log(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX request failed');
                console.log(error); // Debug: Check the error message
            }
        });
    });
});

</script> -->
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
            } else if (selectedStatus === 'Shipped') {
                statusBadge.html('<span class="badge badge-warning">' + selectedStatus + '</span>');
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