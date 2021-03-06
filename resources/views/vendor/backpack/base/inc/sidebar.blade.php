@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="http://placehold.it/160x160/00a65a/ffffff/&text={{ Auth::user()->name[0] }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            <a href="#"><i class="fa fa-circle text-primary"></i> {{ Auth::user()->branch->branch_name }}</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          @role('Administrator')
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <!-- Users, Roles Permissions -->
          <li class="treeview">
            <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
              <li><a href="{{ url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
              <li><a href="{{ url('permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-cogs"></i> <span>Manage</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="{{ url('branches') }}"><i class="fa fa-building-o"></i> <span>Branches</span></a></li>
              <li><a href="{{ url('stylists') }}"><i class="fa fa-cut"></i> <span>Stylists</span> </a></li>
              <li><a href="{{ url('promos') }}"><i class="fa fa-asterisk"></i> <span>Discounts/Promos</span></a></li>
              <li><a href="{{ url('servicetypes') }}"><i class="fa fa-star-half-full"></i> <span>Types of Services</span></a></li>
              <li><a href="{{ url('services') }}"><i class="fa fa-book"></i> <span>Services</span></a></li>
              <li><a href="{{ url('items') }}"><i class="fa fa-cube"></i> <span>Items</span> </a></li>
              <li><a href="{{ url('otc_items') }}"><i class="fa fa-cube"></i> <span>Over-the-counter Items</span> </a></li>
              <!--
              <li><a href="{{ url('customers') }}"><i class="fa fa-user"></i> <span>Customers</span></a></li>
            -->
            </ul>
          </li>
          @endrole
          
          <li><a href="{{ url(config('backpack.base.route_prefix').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          <li><a href="{{ url('sales') }}"><i class="fa fa-money"></i> <span>Salon Sales</span></a></li>
          <li><a href="{{ url('reports') }}"><i class="fa fa-download"></i> <span>Salon Reports</span></a></li>
          <li><a href="{{ url('otc_sales') }}"><i class="fa fa-money"></i> <span>Over-the-counter Sales</span></a></li>
          <li><a href="{{ url('reports/otc') }}"><i class="fa fa-download"></i> <span>Over-the-counter Reports</span></a></li>



          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url(config('backpack.base.route_prefix').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
