<!DOCTYPE html>
<html lang="en">
<head>
    @include('seller.css.style')
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <a class="app-menu__item active" href="{{url('/seller/item')}}" >
                    <i class="fas fa-hamburger"></i>
                    &nbsp;&nbsp;&nbsp;
                    <span class="app-menu__label">Items</span>
                    
                </a>
                
            </li>
            <li >
                <a class="app-menu__item" href="{{url('/seller/order')}}" >
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
                                <h2>All Items</h2>
                            </div>
                            <div class="col-sm-2">
                                <a href="{{ route('seller.create_item') }}">
                                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                                </a>
                            </div>
                        </div><br>
                    </div>

                    {{-- <form class="form-inline" method="GET">
                        <div class="form-group mb-2">
                            <label for="filter" class="col-sm-2 col-form-label">Filter</label>
                            <input type="text" class="form-control" id="filter" name="filter" placeholder="Name..." value="">
                        </div>
                        <button type="submit" class="btn btn-default mb-2">Filter</button>
                    </form> --}}
                    <form action="{{ route('seller.filter_item') }}" method="GET">
                        <div class="form-group mb-2">
                            {{-- <label for="filter" class="col-sm-2 col-form-label">Filter</label> --}}
                            <select name="filter" id="filter">
                                <option value="">All</option>
                                @foreach($menu as $menu)
                                        <option value="{{$menu->name_menu}}">{{$menu->name_menu}}</option>
                                    @endforeach
                            </select>
                            {{-- <select name="filter" id="filter">
                                @foreach($item as $row)
                                        <option value="{{$row->title}}">{{$row->title}}</option>
                                @endforeach
                            </select> --}}
                        </div>
                        <button type="submit">Filter</button>
                        
                    </form>
          
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead class="bg-light text-dark p-3 text-center">
                            <tr>
                            <th>#</th>
                            <th>Title</th>
                            <!-- <th>Origin_Price</th> -->
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Menu</th>
                            <th>SubMenu</th>
                            <th>Description</th>
                            <th>Supplier</th>
                            <th>Image</th>
                            <th>Created</th>
                            <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->reverse() as $row)
                            <tr>
                                <td>{{$count++}}</td>                              
                                <td>{{$row->title}}</td>
                                <!-- <td>{{$row->origin_price}}$</td> -->
                                <td>{{$row->price}}$</td>
                                <td>{{$row->store_quantity}}</td>
                                <td>{{$row->menus->name_menu}}</td>
                                <td>{{$row->submenus->submenu_name}}</td>
                                <td>{{$row->description}}</td> 
                                <td>{{$row->suppliers->description}}</td>
                                
                                <td>
                                    <img class="" src="{{(!empty($row->image))
                                    ? url('upload/item_images/'.$row->image):url('frontend/user_images/no_image.jpg')}}" 
                                    width="40px" height="40px" alt="item">
                                    
                                </td>
                                <td>{{$row->created_at}}</td>
                                <td class="text-center">
                                    <a class="badge badge-warning edit" href="{{url('/seller/update_item/'.$row->id)}}" title="Update" data-toggle="tooltip">
                                    <i class="fa fa-edit"></i>
                                    </a>                        
                                    &nbsp;
                                    <a class="badge badge-danger delete" href="{{url('/seller/item/'.$row->id)}}" onclick="return confirm('Are you sure?')" title="Delete" data-toggle="tooltip">
                                    <i class="fa fa-trash "></i>
                                    </a>
                                    {{-- &nbsp;
                                    <a class="badge badge-success view" title="View" data-toggle="tooltip">
                                    <i class="fa fa-eye "></i>
                                    </a>   --}}
                                </td>
                            </tr>
                            @endforeach() 
                        </tbody>
                    </table>        
                    </div>
                </div>
                
                <div class="d-print-none">
                    <div class="float-right">
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                    </div>
                </div>                
            </div>

            

            
    </main>
    <!-- Essential javascripts for application to work-->
    @include('seller.js.script') 
    
</body>
</html>