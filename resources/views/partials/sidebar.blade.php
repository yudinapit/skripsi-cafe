<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"><img src="{{ asset('assets/frontend/img/logo_wide.png') }}" data-src="{{ asset('assets/frontend/img/logo_wide.png') }}" alt="" class="img-fluid lazy"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <!-- <li class="menu-header">Dashboard</li> -->
            
            <li class="menu-header">Dine In</li>
            <!-- <li class="{{ request()->routeIs('order-menu') ? 'active':'' }}">
                <a href="{{ route('order-menu.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Menu Order</span></a>
            </li> -->
            <li class="{{ request()->routeIs('admin.home') ? 'active':'' }}">
                <a href="{{ route('admin.home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Menu Order</span></a>
            </li>
            <li class="dropdown {{ request()->routeIs('tables.*') ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Table</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('tables.index') ? 'active':'' }}"><a class="nav-link" href="{{ route('tables.index') }}">All Tables</a></li>
                    <li class="{{ request()->routeIs('tables.create') ? 'active':'' }}"><a class="nav-link" href="{{ route('tables.create') }}">Create Tables</a></li>
                </ul>
            </li>
            <li class="menu-header">Presence</li>
            <li class="{{ request()->routeIs('admin.general') ? 'active':'' }}">
                <a href="{{ route('admin.general') }}" class="nav-link"><i class="fas fa-fire"></i><span>General Information</span></a>
            </li>
            <li class="dropdown {{ request()->routeIs('category.*') ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Category</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request('type') == 'menu' ? 'active':'' }}"><a class="nav-link" href="{{ route('category.index').'?type=menu' }}">Menu Category</a></li>
                    <li class="{{ request('type') == 'blog' ? 'active':'' }}"><a class="nav-link" href="{{ route('category.index').'?type=blog' }}">Blog Category</a></li>
                    <li class="{{ request()->routeIs('category.create') ? 'active':'' }}"><a class="nav-link" href="{{ route('category.create') }}">Create Category</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('menu.*') ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Menu</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('menu.index') ? 'active':'' }}"><a class="nav-link" href="{{ route('menu.index') }}">Menu List</a></li>
                    <li class="{{ request()->routeIs('menu.create') ? 'active':'' }}"><a class="nav-link" href="{{ route('menu.create') }}">Create Menu</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('blog.*') ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Blog</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('blog.index') ? 'active':'' }}"><a class="nav-link" href="{{ route('blog.index') }}">Blog List</a></li>
                    <li class="{{ request()->routeIs('blog.create') ? 'active':'' }}"><a class="nav-link" href="{{ route('blog.create') }}">Create Blog</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('gallery.*') ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Gallery</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request('type') == 'photo' ? 'active':'' }}"><a class="nav-link" href="{{ route('gallery.index').'?type=photo' }}">Photo Gallery</a></li>
                    <li class="{{ request('type') == 'video' ? 'active':'' }}"><a class="nav-link" href="{{ route('gallery.index').'?type=video' }}">Video Gallery</a></li>
                    <li class="{{ request()->routeIs('gallery.create') ? 'active':'' }}"><a class="nav-link" href="{{ route('gallery.create') }}">Add Gallery</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('service.*') ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Service</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('service.index') ? 'active':'' }}"><a class="nav-link" href="{{ route('service.index') }}">All Services</a></li>
                    <li class="{{ request()->routeIs('service.create') ? 'active':'' }}"><a class="nav-link" href="{{ route('service.create') }}">Create Service</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('staff.*') ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Staff</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('staff.index') ? 'active':'' }}"><a class="nav-link" href="{{ route('staff.index') }}">All Staffs</a></li>
                    <li class="{{ request()->routeIs('staff.create') ? 'active':'' }}"><a class="nav-link" href="{{ route('staff.create') }}">Create Staff</a></li>
                </ul>
            </li>
            <li class="dropdown {{ request()->routeIs('slider.*') ? 'active':'' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Slider</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('slider.index') ? 'active':'' }}"><a class="nav-link" href="{{ route('slider.index') }}">All Slider Image</a></li>
                    <li class="{{ request()->routeIs('slider.create') ? 'active':'' }}"><a class="nav-link" href="{{ route('slider.create') }}">Add Slider Image</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
