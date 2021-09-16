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
            <a href=""
                class="{{ request()->routeIs('matkulDsn', [$mk[0]->id_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-book-open"></i>
                <p> {{$mk[0]->nama_praktikum}}</p>
            </a>
        </li>

        <li class="nav-item">
            <a href=""
                class="{{ request()->routeIs('data', [$mk[0]->id_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Participants
                </p>
            </a>
        </li>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
