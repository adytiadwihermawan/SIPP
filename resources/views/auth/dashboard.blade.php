<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('template/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('template/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('template/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .callout a:hover{
      color: #2C58AA!important;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background: #F0F0F0; color: #666A6B; font-family:Verdana, Geneva, Tahoma, sans-serif">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-dark bg-dark">
 <ul class="navbar-nav ml-auto">
   <div class="user-panel mt-0 pb-0 mb-0 d-flex" >
     <div class="image">
       <img src="{{ Auth::user()->fotouser}}" class="img-circle elevation-2" alt="User Image">
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

  <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2 ml-5 ">
         
            <h1 class="m-0" style="text-align: center; font-size:x-large;">
              Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat</h1>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="callout callout-defau ml-3 mr-2">
      <h5>SELAMAT DATANG</h5>
     BERIKUT HALAMAN YANG DAPAT ANDA AKSES

      @if (Auth::user()->id_status == 4)
        <a href="/mhs/dashboard" style="text-decoration: none"><button type="button" class="btn btn-block btn-secondary btn-default mb-4 mt-2 text-lg-left"> <b>Dashboard Mahasiswa</b></button></a>
      @else
        <a href="/mhs/dashboard" style="text-decoration: none"><button type="button" class="btn btn-block btn-secondary btn-default mb-4 mt-2 text-lg-left"> <b>Dashboard Mahasiswa</b></button></a>
        <a href="/asist/dashboard" style="text-decoration:none"><button type="button" class="btn btn-block btn-secondary btn-default mb-4 mt-2 text-lg-left"> <b>Dashboard Asisten</b></button></a>
      @endif
      
   
    </div>
    </section>
 --}}
  <div class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        
        <div class="row mb-2 ">
           <!--noteUI : Masukkan logo -->
          <img class="img-fluid rounded mx-auto" style="width:8%;" src="{{asset('img/logo.png')}}" alt="Photo">
      
        </div>
        <div class="row mb-2 ml-5 ">
         
            <h1 class="m-0 mx-auto" style="font-size: large">
              Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat</h1>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="callout callout-defau ml-3 mr-2 mx-auto" style="background-color: #FAFAFF; width:85%">
      <h1>SELAMAT DATANG</h1>
     
      BERIKUT HALAMAN YANG DAPAT ANDA AKSES

      <div class="col-12 mt-3" id="accordion">
     @if (Auth::user()->id_status == 4)
      
      <div class="card card-primary card-outline">
        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
          <div class="card-header">
              <h4 class="card-title w-100">
                  Mahasiswa
              </h4>
          </div>
      </a>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body" style="background-color: #F6F6FF ;">
          <div class="row mb-3">
            <div class="col-sm-6">
              <img class="img-fluid" src="{{asset('img/portal.jpg')}}" alt="Photo">
            </div>
            <div class="col-sm-6">
              
                <ul>Halaman mhs dapat digunakan oleh dosen untuk menajamen proses praktikum sesuai kurikulum yang berlaku.</ul>
                <ul>Dosen dapat membuat pertemuan, membuat absen, mengupload tugas dan proses-proses terkait praktikum lainnya. 
                </ul> 
         
            <div class="mt-5 ml-5">
              
              <button type="button" class="btn btn-primary btn-flat mt-1"></i> Kunjungi Situs</button> 
              <button type="button" class="btn btn-outline-info btn-flat mt-1"><i class="fa fa-book"></i> Panduan pengguna</button>
            </div>
            </div>
         </div>
    </div>
  </div>
 </div>
     @elseif(Auth::roles()->id_status == ))
     <div class="card card-primary card-outline">
        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
          <div class="card-header">
              <h4 class="card-title w-100">
                  Mahasiswa
              </h4>
          </div>
      </a>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body" style="background-color: #F6F6FF ;">
          <div class="row mb-3">
            <div class="col-sm-6">
              <img class="img-fluid" src="{{asset('img/portal.jpg')}}" alt="Photo">
            </div>
            <div class="col-sm-6">
              
                <ul>Halaman mhs dapat digunakan oleh dosen untuk menajamen proses praktikum sesuai kurikulum yang berlaku.</ul>
                <ul>Dosen dapat membuat pertemuan, membuat absen, mengupload tugas dan proses-proses terkait praktikum lainnya. 
                </ul> 
         
            <div class="mt-5 ml-5">
              
              <button type="button" class="btn btn-primary btn-flat mt-1"></i> Kunjungi Situs</button> 
              <button type="button" class="btn btn-outline-info btn-flat mt-1"><i class="fa fa-book"></i> Panduan pengguna</button>
            </div>
            </div>
         </div>
    </div>
  </div>
 </div>
      <div class="card card-primary card-outline">
        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
          <div class="card-header">
              <h4 class="card-title w-100">
                  ASISTEN PRAKTIKUM
              </h4>
          </div>
      </a>
      <div id="collapseTwo" class="collapse" data-parent="#accordion">
        <div class="card-body" style="background-color: #F6F6FF ;">
          <div class="row mb-3">
            <div class="col-sm-6">
              <img class="img-fluid" src="{{asset('img/portal.jpg')}}" alt="Photo">
            </div>
            <div class="col-sm-6">
              
                <ul>Halaman asisten praktikum dapat digunakan mahasiswa yang menjadi asisten praktikum untuk menajamen proses praktikum berdasarkan arahan dari dosen pengampu mata kuliah.
                </ul>
                <ul>Asisten praktikum dapat membuat pertemuan, membuat absen, mengupload tugas dan proses-proses terkait praktikum lainnya. 
                </ul> 
         
            <div class="mt-5 ml-5">
              
              <button type="button" class="btn btn-primary btn-flat mt-1"></i> Kunjungi Situs</button> 
              <button type="button" class="btn btn-outline-info btn-flat mt-1"><i class="fa fa-book"></i> Panduan pengguna</button>
            </div>
            </div>
         </div>
    </div>
  </div>
      </div>
@endif
      
      
     
  </div>
    </div>
        <!-- /.row -->
        <!-- Main row -->
       <!-- /.modal -->

      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  </div>
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
<!-- ChartJS -->
<script src="{{asset('template/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('template/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('template/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('template/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('template/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('template/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('template/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('template/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('template/dist/js/demo.js')}}"></script>
</body>
</html>
