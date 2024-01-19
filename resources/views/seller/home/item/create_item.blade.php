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
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="tile">               
                    {{-- <h3 class="tile-title">Create New User</h3>            --}}
                    <div class="row">
                        <div class="col-sm-10">
                            <h2>Create New Item</h2>
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
                        <form class="form-horizontal" method="POST" action="{{ route('seller.create_item.post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3">Title</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_title" type="text" placeholder="Enter title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Price</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_price" type="float" placeholder="Enter price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Store qauntity</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="item_store_quantity" type="float" placeholder="Enter store quantity">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Menu</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="item_menu" id="item_menu" required="">
                                        <option value="" selected="">Add a menu here</option>
                                        @foreach($menu as $m)
                                        <option value="{{$m->id}}">{{$m->name_menu}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Sub Menu</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="item_submenu" id="item_submenu" required="">
                                        <option value="" selected="">Add a sub menu here</option>
                                        @foreach($submenus as $submenu)
                                        <option value="{{$submenu->id}}">{{$submenu->submenu_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3">Supplier</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="item_supplier" required="">
                                        <option value="" selected="">suppliers</option>
                                        @foreach($supplier as $supplier)
                                        <option value="{{$supplier->name_supplier}}">{{$supplier->name_supplier}}</option>
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
    @include('seller.js.script') 
    <!-- Modify the JavaScript section in create_item.blade.php -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#item_menu').change(function() {
            var menuId = $(this).val();
            if (menuId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route("seller.getSubmenus", ["menuId" => "__menuId"]) }}'.replace('__menuId', menuId),
                    success: function(response) {
                        $('#item_submenu').empty();
                        if (response && response.submenus) {
                            $.each(response.submenus, function(key, value) {
                                $('#item_submenu').append('<option value="' + value.id + '">' + value.submenu_name + '</option>');
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#item_submenu').empty();
            }
        });
    });
    </script>




    
</body>
</html>