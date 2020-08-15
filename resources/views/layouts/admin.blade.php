<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@yield('meta-title', __('Dashboard'))</title>

  <link rel="stylesheet" href="{{ asset('css/app.css')}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset("assets/admin/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
              </li>
              <li class="nav-item d-none d-sm-inline-block">
                  <a href="index3.html" class="nav-link">Home</a>
              </li>
          </ul>


          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">

              <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fas fa-th-large"></i></a>
              </li>
          </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <form action="{{ route('logout') }}" class="d-inline-block" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-primary">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </li>
        </ul>

      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="index3.html" class="brand-link">
              <span class="brand-text font-weight-light text-center">Oswan Dashboard</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                      data-accordion="false">


                    <li class="nav-item has-treeview {{ request()->routeIs('admin.product-category.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  {{ request()->routeIs('admin.product-category.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Category
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.product-category.index')}}" class="nav-link {{ request()->routeIs('admin.product-category.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Category Page</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.product-category.create')}}" class="nav-link {{ request()->routeIs('admin.product-category.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{ request()->routeIs('admin.brand.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.brand.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-gift"></i>
                            <p>
                                Brand
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.brand.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.brand.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Brands</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.brand.create') }}"
                                    class="nav-link {{ request()->routeIs('admin.brand.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Product Menu -->
                    <li
                    class="nav-item has-treeview {{ request()->routeIs('admin.product.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gift"></i>
                        <p>
                            Product
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}"
                                class="nav-link {{ request()->routeIs('admin.product.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.create') }}"
                                class="nav-link {{ request()->routeIs('admin.product.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                    </ul>
                </li>

                    <li class="nav-header">Coupon & Shipping</li>
                    <li class="nav-item has-treeview {{ request()->routeIs('admin.coupon.*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->routeIs('admin.coupon.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-percentage"></i>
                            <p>
                                Coupon
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.coupon.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.coupon.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Coupons</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.coupon.create') }}"
                                    class="nav-link {{ request()->routeIs('admin.coupon.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                      
                  </ul>
              </nav>
              <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <div class="content-header">
              <div class="container-fluid">
                  <div class="row mb-2">
                      <div class="col-md-12">
                          <h1 class="m-0 text-dark">@yield('title', __('Dashboard'))</h1>
                      </div><!-- /.col -->
                  </div><!-- /.row -->
              </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <div class="content">
              <div class="container-fluid">
                  @yield('content')
              </div><!-- /.container-fluid -->
          </div>
          <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->


      <!-- Main Footer -->
      <footer class="main-footer">
          <!-- To the right -->
          <div class="float-right d-none d-sm-inline">
              Powered by GamchaPress
          </div>
          <!-- Default to the left -->
          <strong>Copyright &copy; 2014-{{ date('Y') }} FireCode</strong> All rights reserved.
      </footer>
  </div>
  <!-- ./wrapper -->

  <script src="{{ asset('js/app.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('assets/admin/js/adminlte.min.js') }}"></script>
  <script>
      
      @if(session()->has('success'))
        toaster('success',"{{ session()->get('success') }}")
      @endif

      @if(session()->has('warning'))
        toaster('warning',"{{ session()->get('warning') }}")
      @endif

     
  </script>
  @yield('scripts')
</body>
</html>
