<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item">
      <a href="{{ route('admin.dashboard') }}" class="nav-link {{ setActiveRoute('admin.dashboard') }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
          Inicio
        </p>
      </a>
    </li>
    <li class="nav-item {{ setActiveRoute([ 'admin.posts.index', 'admin.posts.create' ]) == 'active' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ setActiveRoute([ 'admin.posts.index', 'admin.posts.create' ]) }}">
        <i class="nav-icon fas fa-bars"></i>
        <p>
          Blog
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('admin.posts.index') }}" class="nav-link {{ setActiveRoute('admin.posts.index') }}">
            <i class="fa fa-eye nav-icon"></i>
            <p>Ver todos los posts</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.posts.create') }}" class="nav-link {{ setActiveRoute('admin.posts.create') }}">
            <i class="fa fa-pencil-ruler nav-icon"></i>
            <p>Crear un post</p>
          </a>
        </li>
      </ul>
    </li>
    <li class="nav-item {{ setActiveRoute('admin.users.*') == 'active' ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ setActiveRoute('admin.users.*') }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Usuarios
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('admin.users.index') }}" class="nav-link {{ setActiveRoute('admin.users.index') }}">
            <i class="fa fa-eye nav-icon"></i>
            <p>Ver todos los usuarios</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.users.create') }}" class="nav-link {{ setActiveRoute('admin.users.create') }}">
            <i class="fa fa-pencil-ruler nav-icon"></i>
            <p>Crear un usuario</p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>