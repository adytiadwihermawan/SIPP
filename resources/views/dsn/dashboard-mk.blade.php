<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">

   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

   <script src="//cdn.ckeditor.com/4.16.1/basic/ckeditor.js"></script>
 
    
    <style>

        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
      .dataTables_wrapper .dt-buttons {
        float:none;  
        text-align:left;
      }

      .laravel-embed__responsive-wrapper{
        padding-bottom: 0.25%!important;
      }

      input[type="radio"]{
        visibility: hidden;
        height: 0;
        width: 0;
      }

      input[type="radio"]:checked + label{
        background-color: #FFBF86;
      }

      .btn-outline-primary{
        background-color: transparent;
        color: black;
        border-color: black;
      }

      .btn-outline-primary:hover{
        background-color: #FFBF86;
        color: black;
        border-color: black;
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
            <img src="{{asset('dist/img/logo.png')}}" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">SIDP-TI</span>
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
    @yield('content')
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

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script> 

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
   $(document).ready(function(){
        data()
    })
    function data() {
        $('#partisipan').DataTable({
            serverside: true,
            responsive: true,
            ajax: {
                url: "{{ route('data', [$mk[0]->nama_praktikum]) }}"
            },
            columnDefs: [
                        {"className": "dt-center", "targets": [0]}
                    ],
            columns:[
                {
                    "data": null, "sortable": false,
                    render: function(data, type, row, meta){
                        return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
                {data: 'username', name: 'username'},
                {data: 'nama_user', name: 'nama_user'},
                {data: 'status', name: 'status'}
            ]
        })
    }

    
    $(document).ready(function(){
        datagrade()
    })
   
    function datagrade() {
      @if($course1->count() > 0)
        $('#grade').DataTable({
            serverside: true,
            responsive: true,
            rowGroup: [0],
            ajax: {
                url: "{{ route('grade', [$course1[0]->id_wadahtugas]) }}"
            },
            columnDefs: [
                        {"className": "dt-center", "targets": [0,2,3]}
                    ],
              buttons : [
          {
            extend: 'excel',
            text: '<span class="fa fa-file-excel-o"></span> Export Nilai',
            messageTop: 'Tugas {{$course1[0]->nama_pertemuan}}',
            title: 'Rekap Nilai untuk Praktikum {{$course1[0]->nama_praktikum}} ',
            exportOptions: {
                columns: [ 0, 1, 2, 3 ],
                format: { 
                      header: function ( data, columnDefs ) {
                      return data.toUpperCase();
                  }
                },
              },
            }
          ],
        columns: [
            {
              "data": null, "sortable": false,
              render: function(data, type, row, meta){
              return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
              {data: 'nama', name: 'nama' },
              {data: 'nim', name: 'nim'},
              {data: 'grade', name: 'grade'},
              {data: 'file', name: 'file'}
            ]
        });
      @endif
    }

  
  $(function () {

     $.ajaxSetup({
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

       var table = $('#presensi').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
           url: "{{ route('absen', [$mk[0]->nama_praktikum]) }}"
         },
         columnDefs: [
                         {"className": "dt-center", "targets": [0, 2, 3, 4, 5, 6, 7]}
                     ],
         columns: [
             {
               "data": null, "sortable": false,
               render: function(data, type, row, meta){
               return meta.row + meta.settings._iDisplayStart + 1
                     }
                 },
               {data: 'hari', name: 'hari' },
               {data: 'jam', name: 'jam' },
               {data: 'pertemuan', name: 'pertemuan' },
               {data: 'tanggal', name: 'tanggal' },
               {data: 'materi', name: 'materi' },
               {data: 'waktu', name: 'waktu' },
               {data: 'action', name: 'action' }
         ]
     });
     
   });

   $(function () {

     $.ajaxSetup({
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     @if ($absen->count() > 0) 
       var table = $('#rekap').DataTable({
         processing: true,
         serverSide: true,
         dom: 'Bflrtip',
         ajax: {
           url: "{{ route('rekap', [$mk[0]->nama_praktikum, $cekid]) }}"
         },
         columnDefs: [
                         {"className": "dt-center", "targets": [0, 2, 3]}
                     ],
         buttons : [
           {
             extend: 'excel',
             text: '<span class="fa fa-file-excel-o"></span> Export Rekap Presensi',
             messageTop: 'Pertemuan {{$absen[0]->urutanpertemuan}}',
             title: 'REKAP PRESENSI UNTUK PRAKTIKUM {{$absen[0]->nama_praktikum}} ',
             exportOptions: {
                 columns: [ 0, 1, 2, 3 ],
                 format: { 
                       header: function ( data, columnDefs ) {
                       return data.toUpperCase();
                   }
                 },
               },
             }
           ],
         columns: [
             {
               "data": null, "sortable": false,
               render: function(data, type, row, meta){
               return meta.row + meta.settings._iDisplayStart + 1
                     }
                 },
               {data: 'nama', name: 'nama_user' },
               {data: 'nim', name: 'username'},
               {data: 'keterangan', name: 'keterangan'}
         ]
     });
     @endif
     
   });

   
    $(function(){

    $('#buat-pertemuan').on('submit', function(e){
      location.reload();
      e.preventDefault();

      $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function(){
          $(document).find('span.error-text').text('');
        },
        success:function(data){
          if(data.status == 0){
            $.each(data.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          }else{
            $('#buat-pertemuan')[0].reset();
            toastr.success(data.msg)
          }
        }
      });
    });

  });


   $(function(){
    
    $('#upload-file').on('submit', function(e){
      e.preventDefault();
      // location.reload();
      
      $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function(){
          $(document).find('span.error-text').text('');
        },
        success:function(data){
          if(data.status == 0){
            $.each(data.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          }else{
            $('#upload-file')[0].reset();
            toastr.success(data.msg)
          }
        }
      });
    });
  });

   $(function(){
    
    $('#upload-tugas').on('submit', function(e){
      e.preventDefault();
      // location.reload();
      
      $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function(){
          $(document).find('span.error-text').text('');
        },
        success:function(data){
          if(data.status == 0){
            $.each(data.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          }else{
            toastr.success(data.msg)
            location.reload();
          }
        }
      });
    });

  });


  $(function(){
    
    $('#absen').on('submit', function(e){
      e.preventDefault();
      
      $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function(){
          $(document).find('span.error-text').text('');
        },
        success:function(data){
          if(data.status == 0){
            $.each(data.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          }else{
            toastr.success(data.msg)
            location.reload()
          }
        }
      });
    });
  });

  $(function(){
    
    $('#nilai-tugas').on('submit', function(e){
     e.preventDefault();
      $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function(){
          $(document).find('span.error-text').text('');
        },
        success:function(data){
          if(data.status == 0){
            $.each(data.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
          }else{
            location.reload();
            $('#nilai-tugas')[0].reset();
            toastr.success(data.msg)
          }
        }
      });
    });
  });

  
</script>
 
<script>

  $('body').on('click', '.editPertemuan', function () {
        var id = $(this).data('id');
         
        $.ajax({
            type:"GET",
            url: "{{ url('edit') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#edit-pertemuan').modal('show');
              $('#id_pertemuan').val(res.id_pertemuan);
              $('#nama_pertemuan').val(res.nama_pertemuan);
              $('#deskripsi').val(res.deskripsi);
           }
        });
    });


  $('#edit-pertemuan').on('submit', function(e){
      e.preventDefault();
      
      var id_pertemuan = $('#id_pertemuan').val();
      var nama_pertemuan = $('#nama_pertemuan').val();
      var deskripsi = $('#deskripsi').val();

      $.ajax({
        url: "{{ url('editpertemuan') }}",
        method: "POST",
        data: {
          id_pertemuan: id_pertemuan,
          nama_pertemuan: nama_pertemuan,
          deskripsi: deskripsi
        },
        dataType: 'json',
        beforeSend: function(){
          $(document).find('span.error-text').text('');
        },
        success:function(data){
          if(data.status == 0){
            $.each(data.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
            if(!data.error){
            toastr.error(data.msg)
            }
          }else{
            toastr.success(data.msg)
            location.reload()
          }
        }
      });
    });

  $('body').on('click', '.editpresensi', function () {
        var id = $(this).data('id');
         
        $.ajax({
            type:"GET",
            url: "{{ url('editabsen') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#edit-absen').modal('show');
              $('#id').val(res.id_wadah);
              $('#pertemuan').val(res.urutanpertemuan);
              $('#materi').val(res.keterangan);
           }
        });
    });

    $('#edit-absen').on('submit', function(e){
      e.preventDefault();
      
      var id = $('#id').val();
      var pertemuan = $('#pertemuan').val();
      var tanggal = $('#tanggal').val();
      var materi = $('#materi').val();
      var wmp = $('#wmp').val();
      var wap = $('#wap').val();

      $.ajax({
        url: "{{ url('editpresensi') }}",
        method: "POST",
        data: {
          id: id,
          pertemuan: pertemuan,
          tanggal: tanggal,
          materi: materi,
          wmp: wmp,
          wap: wap
        },
        dataType: 'json',
        beforeSend: function(){
          $(document).find('span.error-text').text('');
        },
        success:function(data){
          if(data.status == 0){
            $.each(data.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
            if(!data.error){
            toastr.error(data.msg)
            }
          }else{
            toastr.success(data.msg)
            location.reload()
          }
        }
      });
    });

    $('body').on('click', '.edittugas', function () {
        var id = $(this).data('id');
         
        $.ajax({
            type:"GET",
            url: "{{ url('edittugas') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#edit-tugas').modal('show');
              $('#id_wadahtugas').val(res.id_wadahtugas);
              $('#id_pertemuan').val(res.id_pertemuan);
              $('#judul_tugas').val(res.judul_tugas);
              $('#deskripsi').val(res.deskripsi_tugas);
           }
        });
    });

    $('#edit-tugas').on('submit', function(e){
      e.preventDefault();
      
      var id = $('#id_wadahtugas').val();
      var id_pertemuan = $('#id_pertemuan').val();
      var judul_tugas = $('#judul_tugas').val();
      var deskripsi = $('#deskripsi').val();
      var wmp = $('#wmp').val();
      var wap = $('#wap').val();
      var wcp = $('#wcp').val()

      $.ajax({
        url: "{{ url('updatetugas') }}",
        method: "POST",
        data: {
          id: id,
          id_pertemuan: id_pertemuan,
          judul_tugas: judul_tugas,
          deskripsi: deskripsi,
          wmp: wmp,
          wap: wap,
          wcp: wcp
        },
        dataType: 'json',
        beforeSend: function(){
          $(document).find('span.error-text').text('');
        },
        success:function(data){
          if(data.status == 0){
            $.each(data.error, function(prefix, val){
              $('span.'+prefix+'_error').text(val[0]);
            });
            if(!data.error){
            toastr.error(data.msg)
            }
          }else{
            toastr.success(data.msg)
            location.reload()
          }
        }
      });
    });

  </script>

</body>
</html>
