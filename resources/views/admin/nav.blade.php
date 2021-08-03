 <!-- Sidebar Menu -->
 <nav class="mt-4">
  <ul class="nav nav-pills nav-sidebar flex-column" style="background-color: #334443;" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
         <li class="nav-item">
          <a href="{{ url('admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
         </li>

         <li class="nav-item">
          <a href="/datauser" class="{{ request()->is('datauser') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Data User
            </p>
          </a>
         </li>

         <li class="nav-item">
          <a href="/datakelas" class="{{ request()->is('datakelas') ? 'nav-link active' : 'nav-link' }}">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
              Data Kelas
            </p>
          </a>
         </li>

          <li class="nav-item menu mb-5">
            <a href="/datalab" class="{{ request()->is('datalab') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Data Laboratorium
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/openrekrutasist" class="{{ request()->is('openrekrutasist') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Buka Perekrutan Asisten
              </p>
            </a>
           </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>