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
                <a class="app-menu__item" href="{{url('/accountant/item')}}" >
                    <i class="fas fa-hamburger"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Items</span>
                    
                </a>
                
            </li>
            <li >
                <a class="app-menu__item active" href="{{url('/accountant/order')}}" >
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
                    <div class="row">
                        <div class="col-sm-10">
                            <h2>New Order</h2>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ url('accountant/order') }}">
                                <button type="button" class="btn btn-info add-new">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div><br>
                    {{-- error message --}}
                    @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error:</strong> {{Session::get('error')}}
                    </div>
                    @endif
                    {{-- success message --}}
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success:</strong> {{Session::get('success')}}
                    </div>
                    @endif
                    
                    <form method="POST" action="{{ route('accountant.create_order.post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Name</label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="order_name" type="text" placeholder="Enter name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Email</label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="order_email" type="text" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Phone</label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="order_phone" type="text" placeholder="Enter phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Address</label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="order_address" type="text" placeholder="Enter address">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Item</label>

                                    <div class="col-md-8">
                                        <select class="form-control" name="order_item" required="">
                                            
                                            @foreach($item as $item)
                                            <option value="{{$item->title}}">{{$item->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Quantity</label>
                                    <div class="col-md-8">
                                        <input class="form-control" name="order_quantity" type="number" placeholder="Enter quantity">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">Payment</label>
                                    <div class="col-md-8">
                                        <select class="form-control" name="order_payment" required="">
                                            
                                            <option value="Cash">Cash</option>
                                            <option value="Paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            </div>
                            <div class="tile-footer text-center">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Create
                                </button>
                            </div>

                        </div>
                    </form>              
                </div>
            </div>
            </div>
        </div>
            

            
    </main>
    <!-- Essential javascripts for application to work-->
    @include('accountant.js.script') 
    
</body>
</html>