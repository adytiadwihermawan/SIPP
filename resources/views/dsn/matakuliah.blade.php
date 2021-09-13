<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
  <title>{{$course[0]->nama_praktikum}}</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
   <!-- Theme style -->
   <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="{{asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

   <link rel="stylesheet" href="{{asset('plugins/ijaboCropTool/ijaboCropTool.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/bootstrap/css/custom.css')}}">

   <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    
    <style>
        .dropzone {
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 14px;
            margin: 60px 0 0 0;
            background: #e3e6ff;
            border: 1px dotted #4e4e4e;            
        }

        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

    
    </style>
  </head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <div class="user-panel mt-0 pb-0 mb-0 d-flex" >
      <div class="image">
        <img src="{{ Auth::user()->fotouser}}" class="img-circle elevation-2 user_picture" alt="User Image">
      </div>
    </div>
      @guest
      @else
    
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->nama_user }}
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
          </li>
      @endguest
  </ul>
 
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        
          <!-- Brand Logo -->
          <a href="index3.html" class="brand-link">
            <img src="{{asset('dist/img/logoulm.png')}}" alt="logoulm" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">SIPP-TI</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-1 d-flex">
                <div class="image">
                  {{-- style="height: auto;
                  width: 1rem;" --}}
                  <img  style="height: auto;
                  width: 2.6rem;" src="{{Auth::user()->fotouser}}" class="img-circle elevation-2 user_picture" alt="User Image">
                </div>
              <div class="info" style="white-space: normal;">
                <a href="#" >
                  {{Auth::user()->nama_user}}
                </a>
              <br>
                <span class="badge badge-success" style="font-size: 12px;">
                    {{-- nampilkan id user --}}
                      {{ Auth::user()->username }}
                </span>
              </div>
            </div>
          
            <!-- Sidebar Menu -->
            <nav class="mt-4">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                  <a href="{{url('dosen/profile')}}" class="{{ request()->is('dosen/profile') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('matkulDsn', [$course[0]->id_praktikum]) }}" class="{{ request()->routeIs('matkulDsn', [$course[0]->id_praktikum]) ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon fas fa-book-open"></i>
                    <p> {{$course[0]->nama_praktikum}}</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{url('dosen/profile')}}" class="{{ request()->is('dosen/profile') ? 'nav-link active' : 'nav-link' }}">
                    <i class="nav-icon fas fa-user"></i>
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
     <!-- /.sidebar-menu -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h5 class="m-0 text-dark">@yield('Judul')</h5>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container-fluid">
      
  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
        <h1 style="text-align: center; font-size:x-large;">
          Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat</h1>
          <br>
    <!-- /.content-header -->
    <div class="card card-primary ml-2">
      <div class="card-header">
        <h3 class="card-title">
            {{$course[0]->nama_praktikum}}
        </h3>
        <button type="button" class="btn hijau float-right" style="float:right; padding:1px 4px;" title="Buat Pertemuan" data-toggle="modal" data-target="#modal-pertemuan">
				<i class="fa fa-plus"></i> Tambah Pertemuan</button>
      </div>
    </div>
      @foreach($course as $item)  
    <?php 
      $total = $item->where('id_praktikum', '=', $item->id_praktikum)->get();
    ?>
      {{-- @if ($total) --}}
      <!-- Main content -->
    <div class="card card-primary ml-2">
      <section class="content mt-3">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
            <!-- Default box -->

        <div class="card card-lightblue"> 
          <div class="card-header">
            <h3 class="card-title">{{$item->nama_pertemuan}}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
              <div class="row mb-5 mx-auto">
                <div class="col-sm">
                  <button type="button" class="btn hijau panjang2 " data-toggle="modal" data-target="#addmateri"> <i class="fas fa-plus"></i> Tambah Materi </button>
                </div>
                
      <!-- Modal -->
          <div class="modal fade" id="addmateri">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addpesertaLabel">Upload Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
                
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <form action="{{ route('fileUpload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($message = Session::get('success'))
                          <div class="alert alert-success">
                              <strong>{{ $message }}</strong>
                          </div>
                        @endif
              
                        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif
                          <input type="text" class="form-control" name="id_pertemuan" value="{{ old('id', $item->id_pertemuan)}}" readonly>
                          <input type="file" name="_file" id="_file" style="margin-bottom:15px;" class="form-control">
                          <button type="submit" style="float:right; margin-bottom:15px;"class="btn btn-success">Upload</button>
                    </div>
                  </div>
                </div>

              </div>
              </div>
            </div>



       <div class="modal fade" id="modal-presensi">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Buat Pertemuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="addkelas" method="post">
					<div class="modal-body">
					
						@csrf
							<div class="form-group">
								<label for="">Pertemuan</label>
								<input type="number" class="form-control" name="id" >
								<span style="color:red">@error('nama_praktikum') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Tanggal</label>
								<input type="date" class="form-control" name="tahun_ajaran" >
								<span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
							</div>

                            <div class="form-group">
								<label for="">Materi</label>
								<input type="text" class="form-control" name="tahun_ajaran" >
								<span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
							</div>

                            <div class="form-group">
								<label for="">Waktu Mulai Presensi</label>
								<input type="time" class="form-control" name="tahun_ajaran" >
								<span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
							</div>
						
                            <div class="form-group">
								<label for="">Waktu Akhir Presensi</label>
								<input type="Time" class="form-control" name="tahun_ajaran" >
								<span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
							</div>
					</div>
                        
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Buat Presensi</button>
					</div>
					</form>
             </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
                <div class="col-sm">
                  <button type="button" class="btn hijau2 panjang2 " data-toggle="modal" data-target="#modal-presensi"> <i class="fas fa-plus"></i> Buat Presensi </button>
                </div>

                <div class="col-sm">
                  <button type="button" class="btn hijau3 panjang2 " data-toggle="modal" data-target="#"> <i class="fas fa-plus"></i> Edit Pertemuan </button>
                </div>
              </div>
            </div>
          <div class="card-body">
              <p></p>
          </div> 
        </div>
          
            </div>
          <div class="card-footer">
            {{$item->deskripsi}}
          </div>
        </div>
        {{-- @endif --}}
        @endforeach
    </div>
        </div>

      {{-- <div class="modal fade" id="addmateri">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Upload Materi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
      <div class="modal-body">
        <form action= "{{ route('fileUpload') }}" method="POST" enctype="multipart/form-data">
          @csrf
               <input type="hidden" class="form-control" name="id" value="{{$course[0]->id_pertemuan}}" readonly>
               <input type="file" name="_file" id="_file" style="margin-bottom:15px;" class="form-control">
              <button type="submit" style="float:right; margin-bottom:15px;"class="btn btn-success">Upload</button>
				</form>
      </div>
          </div>
        </div>
      </div> --}}

      <div class="modal fade" id="modal-pertemuan">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Buat Pertemuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
      <div class="modal-body">
        <form action= "{{ route('pertemuan') }}" method="POST">
          @csrf
              <div class="form-group">
								<label for="">Mata Kuliah</label>
								<input type="text" class="form-control" name="id" value="{{$course[0]->id_praktikum}}" readonly>
								<span style="color:red">@error('id') {{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label for="">Pertemuan Ke</label>
								<input type="text" class="form-control" placeholder="Contoh: Pertemuan 1" name="nama_pertemuan" required>
								<span style="color:red">@error('nama_pertemuan') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Materi Pembahasan</label>
								<input type="text" class="form-control" placeholder="Contoh: Cara Menggunakan Framework Laravel" name="deskripsi" required>
								<span style="color:red">@error('deskripsi') {{ $message }} @enderror</span>
							</div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Buat Pertemuan</button>
              </div>
				</form>
      </div>
              
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- /.content -->
      </section>
  </div>
  <!-- /.content-wrapper -->
    </div>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('template/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/dist/js/adminlte.js')}}"></script>

<script src="{{asset('plugins/ijaboCropTool/ijaboCropTool.min.js')}}"></script>

</body>
</html>
