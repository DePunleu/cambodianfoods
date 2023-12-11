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
        .small-width {
            width:150px;
        }
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }
        .table > tbody > tr > .no-line {
            border-top: none;
        }
        .table > thead > tr > .no-line {
            border-bottom: none;
        }
        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
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
        </ul>
    </aside>
    
    <!-- Body-->
    <!-- Body-->
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Orders</h1>          
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Orders</li>
                <li class="breadcrumb-item active"><a href="#">Order Detail</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body" id="invoice-details">
                        <div class="table-title">
                            <div class="row">                
                                <div class="col-sm-10">
                                    
                                
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="invoice-title">
                                        <h2>Order Detail</h2>
                                        <h3 class="float-right">Order # {{$order->order_id}}</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                            <strong>Billed From:</strong><br>
                                                Cambodian Foods<br>
                                                +84 879274961<br>
                                                cambodianfoods@gmail.com<br>
                                                Phnom Penh Cambodia
                                                
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <address>
                                            <strong>Shipped To:</strong><br>
                                                {{$order->name}}<br>
                                                {{$order->phone}}<br>
                                                {{$order->email}}<br>
                                                {{$order->address}}
                                                
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Payment Method:</strong><br>
                                                {{$order->payment_status}}<br>
                                                
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <address>
                                                <strong>Order Date:</strong><br>
                                                {{$order->created_at}}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong>Order summary</strong></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>#</strong></td>
                                                            <td><strong>Item</strong></td>
                                                            <td class="text-center"><strong>Price</strong></td>
                                                            <td class="text-center"><strong>Order Quantity</strong></td>
                                                            <td class="text-center"><strong>Store Quantity</strong></td>
                                                            <td class="text-right"><strong>Totals</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $totalprice=0; ?>
                                                        @foreach ($order->orderItems as $index => $orderItem)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $orderItem->items->title }}</td>
                                                            <td class="text-center">${{ $orderItem->price }}</td>
                                                            <td class="text-center">{{ $orderItem->quantity }}</td>
                                                            <td class="text-center">{{ $orderItem->items->store_quantity }}</td>
                                                            <td class="text-right">${{ $orderItem->price * $orderItem->quantity }}</td>
                                                        </tr>
                                                        
                                                        <?php $totalprice=$totalprice + ($orderItem->price*$orderItem->quantity); ?>
                                                        @endforeach                             
                                                        <tr>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line"></td>
                                                            <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                                            <td class="thick-line text-right">{{$totalprice}}$</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>

                                                            <td class="no-line text-center"><strong>Shipping</strong></td>
                                                            <td class="no-line text-right">0$</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>
                                                            <td class="no-line"></td>

                                                            <td class="no-line text-center"><strong>Total</strong></td>
                                                            <td class="no-line text-right"><strong>{{$totalprice}}$</strong></td>
                                                        </tr>
                                                        {{-- <tr>
                                                            <td colspan="12">
                                                                @foreach($order as $key => $or)
                                                                    @if($or->delivery-status)
                                                                <form class="form-control order-status-select small-width">
                                                                    <option value="Order Received">Order Received</option>
                                                                    <option value="In-Progress" >In-Progress</option>
                                                                    <option value="Shipped">Shipped</option>
                                                                    <option value="Completed">Completed</option>
                                                                    <option value="Canceled">Canceled</option>
                                                                </form>
                                                            </td>
                                                        </tr> --}}
                                                     
                                                        
                                                        <td colspan="5">
                                    
                                                            <span id="delivery-status-{{ $order->id }}">
                                                                @if ($order->delivery_status === 'Order Received')
                                                                    <span class="badge badge-primary">{{ $order->delivery_status }}</span>
                                                                @elseif ($order->delivery_status === 'In-Progress')
                                                                    <span class="badge badge-secondary">{{ $order->delivery_status }}</span>
                                                                @elseif ($order->delivery_status === 'Shipped')
                                                                    <span class="badge badge-warning">{{ $order->delivery_status }}</span>
                                                                @elseif ($order->delivery_status === 'Delivered')
                                                                    <span class="badge badge-info">{{ $order->delivery_status }}</span>
                                                                @elseif ($order->delivery_status === 'Completed')
                                                                    <span class="badge badge-success">{{ $order->delivery_status }}</span>
                                                                @else
                                                                <span class="badge badge-danger">{{ $order->delivery_status }}</span>
                                                                @endif
                                                            </span>
                                                        </td>
                                                        
                                                        <td>
                                                        <a class="badge badge-danger delete" href="{{url('/admin/order/'.$order->id)}}" onclick="return confirm('Are you sure?')" title="Delete" data-toggle="tooltip">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a class="badge badge-success view" href="{{url('/admin/invoice/'.$order->id)}}" title="View" data-toggle="tooltip">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </td>
                                                                                        
                                                    </tbody>
               
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>                
            </div>
        </div>
       
            
    </main>
    <!-- Essential javascripts for application to work-->
    @include('admin.js.script') 

   

</body>
</html>