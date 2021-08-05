 <!-- Sidebar Menu -->
 <nav class="mt-4">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="{{ url('dosen/dashboard') }}" class="{{ request()->is('dosen/dashboard') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
           </li>

           <li class="nav-item">
            <a href="{{url('dosen/profile')}}" class="{{ request()->is('dosen/profile') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Akun
              </p>
            </a>
           </li>


           <li class="nav-item">
            <a href="{{url('dosen/presensi')}}" class="{{ request()->is('dosen/presensi') ? 'nav-link active' : 'nav-link' }}">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Presensi
              </p>
            </a>
           </li>

            <li class="nav-item menu mb-5">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-book"></i>
          <p>
            Praktikum
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          @foreach ($course as $matkul)
          <li class="nav-item">
            <a href="praktikum.html" class="nav-link">
              <i class="fas fa-book-open"></i>
              <p>{{ $matkul->nama_praktikum }}</p>
            </a>
          </li>
          @endforeach

        </ul>
      </li>
      
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>