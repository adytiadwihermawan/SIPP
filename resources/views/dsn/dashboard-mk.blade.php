<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
  <title>@yield('title')</title>

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

   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
    
    <style>

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
    @include('dsn.nav-mk')
     <!-- /.sidebar-menu -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-12 card pt-2 pb-2 tomato">
            <h5 class="mx-auto">@yield('Judul')</h5>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container-fluid">
      
@if(empty($course[0]->id_praktikum))
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Oops!</h1>
                <h2>
                    Belum Ada Pertemuan untuk Mata Kuliah Sekarang</h2>
                <div class="error-details">
                    Mohon menunggu sampai dosen atau asisten kelas membuat pertemuan untuk mata kuliah ini
                </div>
            </div>
        </div>
    </div>
</div>
@else
    @yield('content')
@endif
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

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>

<script>
    $(document).ready(function(){
        data()
    })

    function data() {
        $('#partisipan').DataTable({
            serverside: true,
            responsive: true,
            ajax: {
                url: "{{ route('data', [$data[0]->id_praktikum]) }}"
            },
            columnDefs: [
                        {"className": "dt-center", "targets": [0,2,3]}
                    ],
            columns:[
                {
                    "data": null, "sortable": false,
                    render: function(data, type, row, meta){
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
                {data: 'nama_user', name: 'nama_user'},
                {data: 'status', name: 'status'},
                {data: 'Aksi', name: 'aksi'}
            ]
        })
    }
</script>

</body>
</html>
