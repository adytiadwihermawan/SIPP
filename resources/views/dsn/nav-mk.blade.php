<nav class="mt-4">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ url('dosen/dashboard') }}"
                class="{{ request()->is('dosen/dashboard') ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('matkulDsn', [$mk[0]->nama_praktikum]) }}"
                class="{{ request()->routeIs('matkulDsn', [$mk[0]->nama_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-book-open"></i>
                <p> {{$mk[0]->nama_praktikum}}</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('data', [$mk[0]->nama_praktikum]) }}"
                class="{{ request()->routeIs('data', [$mk[0]->nama_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                     Participants
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('absen', [$mk[0]->nama_praktikum]) }}"
                class="{{ request()->routeIs('absen', [$mk[0]->nama_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                     Presensi
                </p>
            </a>
        </li>
    @if($course1->count() > 0)
        <li class="nav-item">
            <a href="{{ route('matkulDsn', [$mk[0]->nama_praktikum]) }}" class="nav-link">
                <p>
                    
                <i class="nav-icon fas fa-book"></i> Grades
                </p>
            </a>
            <ul>
                @foreach ($course1 as $pertemuan)
                <li class="nav-item ml-3">
                    <a href=" {{ route('grade', [$pertemuan->id_wadahtugas]) }} "
                        class="{{ request()->routeIs('grade', [$pertemuan->id_wadahtugas]) ? 'nav-link active' : 'nav-link' }}">
                        <p>
                            * {{$pertemuan->judul_tugas}}
                        </p>
                    </a>
                </li>
                @endforeach
            </ul>
        </li>
    @endif
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
