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
                <a class="app-menu__item active" href="{{url('/admin/users')}}" >
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
                <h1><i class="fa fa-th-list"></i> Update Users</h1>          
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active"><a href="#">Update Users</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="tile">               
                    {{-- <h3 class="tile-title">Create New User</h3>            --}}
                    <div class="row">
                        <div class="col-sm-10">
                            <h2>Update User</h2>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('admin.users') }}">
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
                        <form class="form-horizontal" method="POST" action="{{url('/admin/update_users/'.$user->id)}}" enctype="multipart/form-data">          
                            @csrf <!-- to make form active -->
                            {{-- @method('PUT') --}}
                            <div class="form-group row">
                                <label class="control-label col-md-3">Name</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="user_name" type="text" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Role</label>
                                <div class="col-md-8">
                                    <select class="form-control"  name="user_role" >
                                        <option value="user">user</option>
                                        <option value="seller">seller</option>
                                        <option value="accountant">accountant</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="user_email" type="email" value="{{$user->email}}">
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="user_password" type="password" placeholder="Enter password">
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label class="control-label col-md-3">Phone</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="user_phone" type="text" value="{{$user->phone}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="user_address" value="{{$user->address}}">
                                </div>
                            </div>
                                               
                            <div class="form-group row">
                                <label class="control-label col-md-3">Image</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="user_image" type="file">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3"></div>                   
                                <div class="col-md-8">
                                    @if($user->image != '' && file_exists(public_path().'/frontend/user_images/'.$user->image))
                                    <img src="{{ url('/frontend/user_images/'.$user->image) }}" alt="" width="100" height="100">
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