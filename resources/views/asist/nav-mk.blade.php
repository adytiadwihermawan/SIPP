<nav class="mt-4">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ url('asist/dashboard') }}"
                class="{{ request()->is('asist/dashboard') ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('matkulAsisten', [$mk[0]->nama_praktikum]) }}"
                class="{{ request()->routeIs('matkulAsisten', [$mk[0]->nama_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-book-open"></i>
                <p> {{$mk[0]->nama_praktikum}}</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('asistenPart', [$mk[0]->nama_praktikum]) }}"
                class="{{ request()->routeIs('asistenPart', [$mk[0]->nama_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-user-graduate"></i>
                <p>
                     Participants
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('asistenRekap', [$mk[0]->nama_praktikum]) }}"
                class="{{ request()->routeIs('asistenRekap', [$mk[0]->nama_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                     Presensi
                </p>
            </a>
        </li>
    @if($course1->count() > 0)
        <li class="nav-item mt-5 ml-3">
            <a href="{{ route('matkulAsisten', [$mk[0]->nama_praktikum]) }}" class="nav-link'">
                <p>
                    
                <i class="nav-icon fas fa-book"></i> Grades
                </p>
            </a>
            <ul>
                @foreach ($course1 as $pertemuan)
                <li class="nav-item">
                    <a href=" {{ route('gradeAsisten', [$pertemuan->id_wadahtugas]) }} "
                        class="{{ request()->routeIs('gradeAsisten', [$pertemuan->id_wadahtugas]) ? 'nav-link active' : 'nav-link' }}">
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
