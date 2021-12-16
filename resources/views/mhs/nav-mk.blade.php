<nav class="mt-4">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ url('dashboard') }}" class="{{ request()->is('dashboard') ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mhsMatkul', [$mk[0]->nama_praktikum]) }}"
                class="{{ request()->routeIs('mhsMatkul', [$mk[0]->nama_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-book-open"></i>
                <p> {{$mk[0]->nama_praktikum}}</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('partisipan', [$mk[0]->nama_praktikum]) }}"
                class="{{ request()->routeIs('partisipan', [$mk[0]->nama_praktikum]) ? 'nav-link active' : 'nav-link' }}">
               <i class="nav-icon fas fa-book"></i>
                <p>
                    Participants
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('presensi', [$mk[0]->nama_praktikum]) }}"
                class="{{ request()->routeIs('presensi', [$mk[0]->nama_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                 <i class="nav-icon fas fa-tasks"></i>
                <p>
                    Presensi
                </p>
            </a>
        </li>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
