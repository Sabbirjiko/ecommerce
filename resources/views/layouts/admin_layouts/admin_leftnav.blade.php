<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="{{request()->routeIs('admin_dashboard*') ? 'active' : '' }}"><a href="{{route('admin_dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Category</span></a>
      <ul>
        <li class="{{request()->routeIs('categories.add') ? 'active' : '' }}"><a href="{{ route('categories.add')}}">Add Category</a></li>
        <li class="{{request()->routeIs('categories') ? 'active' : '' }}"><a href="{{route('categories')}}">View Categories</a></li>
        
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Product</span></a>
      <ul>
        <li class="{{request()->routeIs('products.add') ? 'active' : '' }}"><a href="{{ route('products.add')}}">Add New Product</a></li>
        <li class="{{request()->routeIs('products') ? 'active' : '' }}"><a href="{{route('products')}}">View Peoducts</a></li>
        
      </ul>
    </li>
  </ul>
</div>