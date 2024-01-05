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
                <a class="app-menu__item active" href="{{url('/admin/menu')}}" >
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
                <h1><i class="fa fa-th-list"></i> Menus</h1>          
            </div>
            <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item">Menus</li>
                <li class="breadcrumb-item active"><a href="#">All Menus</a></li>
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
                    <div class="table-title">
                        <div class="row">                
                            <div class="col-sm-10">
                                <h2>All Menus</h2>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ route('admin.create_menu') }}">
                                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                                </a>
                            </div>
                        </div><br>
                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead class="bg-light text-dark p-3 text-center">
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created</th>
                            <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menu as $row)
                            <tr>
                                <td>{{$count++}}</td>                              
                                <td>{{$row->name_menu}}</td>
                                <td>{{$row->description}}</td>                             
                                <td>{{$row->created_at}}</td>
                                <td class="text-center">
                                    <a class="badge badge-warning edit" href="{{url('/admin/update_menu/'.$row->id)}}" title="Update" data-toggle="tooltip">
                                    <i class="fa fa-edit"></i>
                                    </a>                        
                                    &nbsp;
                                    <a class="badge badge-danger delete" href="{{url('/admin/menu/'.$row->id)}}" onclick="return confirm('Are you sure?')" title="Delete" data-toggle="tooltip">
                                    <i class="fa fa-trash "></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach() 
                        </tbody>
                    </table>        
                    </div>
                </div>                
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work-->
    @include('admin.js.script') 
    
</body>
</html>