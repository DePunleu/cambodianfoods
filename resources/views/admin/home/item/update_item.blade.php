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
                <a class="app-menu__item active" href="{{url('/admin/item')}}" >
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
        </ul>
    </aside>
    <!-- Body-->
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-th-list"></i> Update Items</h1>          
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Items</li>
                <li class="breadcrumb-item active"><a href="#">Update Items</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="tile">               
                    {{-- <h3 class="tile-title">Create New User</h3>            --}}
                    <div class="row">
                        <div class="col-sm-10">
                            <h2>Update Item</h2>
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
                        <form class="form-horizontal" method="POST" action="{{url('/admin/update_item/'.$item->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3">Title</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_title" type="text" value="{{$item->title}}">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="control-label col-md-3">Origin Price</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_origin_price" type="float" placeholder="Enter price" value="{{$item->origin_price}}">
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="control-label col-md-3">Price</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_price" type="float" placeholder="Enter price" value="{{$item->price}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Store qauntity</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_store_quantity" type="float" placeholder="Enter store quantity" value="{{$item->store_quantity}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Menu</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="item_menu" required="">
                                        <option value="{{$item->menus->name_menu}}" selected="">{{$item->menus->name_menu}} </option>
                                        @foreach($menu as $menu)
                                        <option value="{{$menu->name_menu}}">{{$menu->name_menu}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Submenu</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="item_submenu" required="">
                                        <option value="{{$item->submenus->submenu_name}}" selected="">{{$item->submenus->submenu_name}} </option>
                                        @foreach($submenu as $submenu)
                                        <option value="{{$submenu->submenu_name}}">{{$submenu->submenu_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_description" type="text" value="{{$item->description}}" placeholder="Enter Description">
                                </div>
                            </div>                       
                            <div class="form-group row">
                                <label class="control-label col-md-3">Image</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_image" type="file">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3"></div>                   
                                <div class="col-md-8">
                                    @if($item->image != '' && file_exists(public_path().'/upload/item_images/'.$item->image))
                                    <img src="{{ url('/upload/item_images/'.$item->image) }}" alt="" width="100" height="100">
                                    @endif
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes
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
    @include('admin.js.script') 
    
</body>
</html>