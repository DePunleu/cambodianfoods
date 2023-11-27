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
                <a class="app-menu__item active" href="{{url('/accountant/item')}}" >
                    <i class="fas fa-hamburger"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Items</span>
                    
                </a>
                
            </li>
                <a class="app-menu__item" href="{{url('/accountant/order')}}" >
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
                <h1><i class="fa fa-th-list"></i> Items</h1>          
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Items</li>
                <li class="breadcrumb-item active"><a href="#">All Items</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="tile">               
                    {{-- <h3 class="tile-title">Create New User</h3>            --}}
                    <div class="row">
                        <div class="col-sm-10">
                            <h2>Create New Item</h2>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('accountant.item') }}">
                                <button type="button" class="btn btn-info add-new">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div><br>
                    <div class="tile-body">
                        @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session('error')}}
                        </div>
                        @endif
                        @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{session('success')}}
                        </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('accountant.create_item.post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3">Title</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_title" type="text" placeholder="Enter title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Origin Price</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_origin_price" type="float" placeholder="Enter origin price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Price</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_price" type="float" placeholder="Enter price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Menu</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="item_menu" required="">
                                        <option value="" selected="">Add a menu here </option>
                                        @foreach($menu as $menu)
                                        <option value="{{$menu->name_menu}}">{{$menu->name_menu}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_description" type="text" placeholder="Enter Description">
                                </div>
                            </div>                       
                            <div class="form-group row">
                                <label class="control-label col-md-3">Image</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_image" type="file">
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Create
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>                  
                </div>
            </div>
            <div class="col-md-2"></div>        
        </div>        
    </main>
    <!-- Essential javascripts for application to work-->
    @include('accountant.js.script') 
    
</body>
</html>