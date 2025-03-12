<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
      <div class="avatar"><img src="/admincss/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
      <div class="title">
        <h1 class="h5">Admin</h1>
        <p>Web Designer</p>
      </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
            <li class="active"><a href="{{route('admin.home')}}"> <i class="icon-home"></i>Home </a></li>
            <li><a href="{{route('admin.products')}}"> <i class="icon-grid"></i>Products </a></li>
            <li><a href="{{route('admin.users')}}"> <i class="fa fa-bar-chart"></i>Users </a></li>
            <li><a href="{{route('admin.orders')}}"> <i class="icon-padnote"></i>Orders </a></li>
            <li><a href="{{route('admin.sliders')}}"> <i class="icon-padnote"></i>Sales </a></li>
            {{-- <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Products</a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="#">All</a></li>
                <li><a href="#">Edit</a></li>
                <li><a href="#">Delete</a></li>
              </ul>
            </li> --}}
            <li><a href="/login"> <i class="icon-logout"></i>Login page </a></li>
    {{-- </ul><span class="heading">Extras</span>
    <ul class="list-unstyled">
      <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
      <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
      <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
    </ul> --}}
  </nav>