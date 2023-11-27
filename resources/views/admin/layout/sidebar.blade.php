<aside class="app-sidebar">
    <div class="app-sidebar__user">
      @if(!empty(Auth::guard('web')->user()->image))
        <img class="app-sidebar__user-avatar" src="{{asset('backend/images/'.Auth::guard('web')->user()->image)}}" width="70px" alt="User Image">
        @else
        <img src="{{asset('backend/images/admin.png/')}}" width="70px" class="app-sidebar__user-avatar" alt="User Image">
        @endif
        <div>
          <a href="#" class="d-block">{{Auth::guard('web')->user()->name}}</a>
          <p class="app-sidebar__user-designation">Admin</p>
        </div>
    </div>
    <ul class="app-menu">
      {{-- Session Active --}}
      {{-- @if(Session::get('page')=="dashboard")
      @php $active="active" @endphp
      @else
      @php $active="" @endphp
      @endif --}}
      {{-- End Session Active --}}
      <li>
        <a class="app-menu__item active" href="{{url('admin/dashboard')}}">
          <i class="app-menu__icon fa fa-dashboard"></i>
          <span class="app-menu__label">Dashboard</span>
        </a>
      </li>
      
      {{-- @if(Session::get('page')=="update_password"||Session::get('page')=="update_details")
      @php $active="active" @endphp
      @else
      @php $active="" @endphp
      @endif --}}
      {{-- <li class="treeview " >
        <a class="app-menu__item " href="#" data-toggle="treeview">
          <i class="fa fa-cog fa-lg"></i> &nbsp;&nbsp;&nbsp;
          <span class="app-menu__label">Setting</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>      
        <ul class="treeview-menu"> --}}
          {{-- Session Active --}}
          {{-- @if(Session::get('page')=="update_password")
          @php $active="active" @endphp
          @else
          @php $active="" @endphp
          @endif --}}
          {{-- End Session Active --}}
          {{-- <li>
            <a class="treeview-item " href="{{ url('admin/update_password') }}">
            <i class="icon fa fa-circle-o"></i> 
            Update Password
            </a>
          </li> --}}
          {{-- Session Active --}}
          {{-- @if(Session::get('page')=="update_details")
          @php $active="active" @endphp
          @else
          @php $active="" @endphp
          @endif --}}
          {{-- End Session Active --}}
          {{-- <li>
            <a class="treeview-item " href="{{url('admin/update_details')}}">
              <i class="icon fa fa-circle-o"></i> 
              Update Details
            </a>
          </li>
        
        </ul> --}}
      {{-- </li> --}}
      <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;
            <span class="app-menu__label">Users</span>
          <i class="treeview-indicator fa fa-angle-right"></i>          
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="treeview-item" href="{{url('/admin/users')}}">
              <i class="icon fa fa-circle-o"></i> All Users
            </a>
          </li>
          <li>
            <a class="treeview-item" href="{{url('/admin/create_users')}}">
              <i class="icon fa fa-circle-o"></i> Add New User
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="fa fa-book"></i>
          &nbsp;&nbsp;&nbsp;
          <span class="app-menu__label">Menus</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="treeview-item" href="{{url('/admin/menu')}}">
              <i class="icon fa fa-circle-o"></i> Show Menus
            </a>
          </li>
          <li>
            <a class="treeview-item" href="{{url('/admin/create_menu')}}">
              <i class="icon fa fa-circle-o"></i> Add Menus
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="fa fa-book"></i>
          &nbsp;&nbsp;&nbsp;
          <span class="app-menu__label">Items</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="treeview-item" href="{{url('/admin/menu')}}">
              <i class="icon fa fa-circle-o"></i> Show Items
            </a>
          </li>
          <li>
            <a class="treeview-item" href="{{url('/admin/create_menu')}}">
              <i class="icon fa fa-circle-o"></i> Add Items
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="fa fa-table"></i>
          &nbsp;&nbsp;&nbsp;
          <span class="app-menu__label">Tables</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="treeview-item" href="{{url('/admin/menu')}}">
              <i class="icon fa fa-circle-o"></i> Show Tables
            </a>
          </li>
          <li>
            <a class="treeview-item" href="{{url('/admin/create_menu')}}">
              <i class="icon fa fa-circle-o"></i> Add Tables
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside>