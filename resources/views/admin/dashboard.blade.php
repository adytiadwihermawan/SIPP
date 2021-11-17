
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
<link rel="stylesheet" href="{{asset('assets/bootstrap/css/custom.css')}}">

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
        <div class="image ml-2">
          <img src="{{asset('dist/img/logo.png')}}" class="img-circle elevation-2" alt="User Image">
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
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #334443;">
 
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/logo.png')}}" class="img-circle elevation-2" alt="User Image"  style="height: 40px; width: 40px;">
        </div>
        <div class="info">
            <a class="d-block">
                {{ Auth::user()->nama_user }}
            </a>
            <span class="badge badge-success" style="font-size: 12px;">
           
            {{-- nampilkan id user --}}
                {{-- {{ Auth::user()->id }} --}}
                
                {{ DB::table('users')
                ->leftJoin('status_user', 'status_user.id_status', '=', 'users.id_status')->find(Auth::id())->status }}
            </span>
        </div>
    </div>
      

      <!-- Sidebar Menu -->
     @include('admin.nav')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-1">
          <div class="col-sm-12 card pt-2 pb-2 army4">
            <h5 class="mx-auto">@yield('Judul')</h5>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    
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

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
   $(function () {
     
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var table = $('#openasisten').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        paging: false,
        info: false,
        ajax: {
          url: "openrekrutasist"
        },
        columnDefs: [
                        {"className": "dt-center", "targets": [0,1,2]}
                    ],
        columns: [
            {
              "data": null, "sortable": false,
              render: function(data, type, row, meta){
              return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
            {data: 'nama_praktikum', name: 'praktikum'},
            {data: 'action', name: 'action'},
        ]
    });
  });

  $(function () {
     
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var table = $('#datauser').DataTable({
        processing: true,
        serverSide: true,
        order:[[3, "asc"]],
        ajax: {
          url: "datauser"
        },
        columnDefs: [
                        {"className": "dt-center", "targets": [0,3,4]}
                    ],
        columns: [
            {
              "data": null, "sortable": false,
              render: function(data, type, row, meta){
              return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
            {data: 'username', name: 'username'},
            {data: 'nama_user', name: 'nama_user'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action'},
        ]
    });
  });

  $(function () {
     
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var table = $('#datakelas').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "datakelas"
        },
        columnDefs: [
                        {"className": "dt-center", "targets": [0,3,4]}
                    ],
        columns: [
            {
              "data": null, "sortable": false,
              render: function(data, type, row, meta){
              return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
            {data: 'id_praktikum', name: 'username'},
            {data: 'nama_praktikum', name: 'nama_praktikum'},
            {data: 'tahun_ajaran', name: 'nama_praktikum'},
            {data: 'action', name: 'action'},
        ]
    });
  });

  
  $(function () {
     
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var table = $('#datalab').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        paging: false,
        info: false,
        ajax: {
          url: "datalab"
        },
        columnDefs: [
                        {"className": "dt-center", "targets": [0,1,2,3]}
                    ],
        columns: [
            {
              "data": null, "sortable": false,
              render: function(data, type, row, meta){
              return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
            {data: 'nama_laboratorium', name: 'nama_laboratorium'},
            {data: 'nama_user', name: 'nama_user'},
            {data: 'action', name: 'action'},
        ]
    });
  });

   $(function(){

    $('#adduser').on('submit', function(e){
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
              if(!data.error){
                toastr.options =
                  {
                    "closeButton" : true
                  }
                toastr.error(data.msg)
              }
          }else{
            $('#adduser')[0].reset();
            toastr.success(data.msg)
          }
        }
      });
    });
  });

  $(function(){

    $('#addkelas').on('submit', function(e){
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
              if(!data.error){
                toastr.options =
                  {
                    "closeButton" : true
                  }
                toastr.error(data.msg)
              }
          }else{
            $('#addkelas')[0].reset();
            toastr.success(data.msg)
          }
        }
      });
    });
  });


  $(function(){

    $('#edituser').on('submit', function(e){
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
              if(!data.error){
                toastr.options =
                  {
                    "closeButton" : true
                  }
                toastr.error(data.msg)
              }
          }
          else{
            toastr.success(data.msg)
            window.location = '/datauser'
          }
        }
      });
    });
  });

  $(function(){

    $('#changestatus').on('submit', function(e){
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
          }
          else{
            toastr.success(data.msg)
            window.location = '/openrekrutasist'
            }
          }
      });
    });
  });

   $(function(){

    $('#import-user').on('submit', function(e){
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
            location.reload();
          }
        }
      });
    });
  });

  $(function(){

    $('#import-peserta').on('submit', function(e){
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
            alert(data.msg);
            location.reload();
          }
        }
      });
    });
  });

    $(function(){

    $('#tambahmk').on('submit', function(e){
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
              if(!data.error){
                toastr.options =
                  {
                    "closeButton" : true
                  }
                toastr.error(data.msg)
              }
          }else{
            toastr.success(data.msg)
            $('.fade').modal( 'hide' );
            $('#openasisten').DataTable().ajax.reload()
          }
        }
      });
    });
  });

   $(function () {
     
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var table = $('#viewcalonasisten').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "daftarcalonasisten"
        },
        columnDefs: [
                        {"className": "dt-center", "targets": [0,2, 3,4]}
                    ],
        columns: [
            {
              "data": null, "sortable": false,
              render: function(data, type, row, meta){
              return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
            {data: 'nama_user', name: 'nama_user'},
            {data: 'praktikumpilihan1', name: 'praktikum_pilihan1'},
            {data: 'nilai_pilihan1', name: 'nilai_pilihan1'},
            {data: 'praktikumpilihan2', name: 'praktikum_pilihan2'},
            {data: 'nilai_pilihan2', name: 'nilai_pilihan2'},
            {data: 'IPK', name: 'IPK'},
            {data: 'Nohp', name: 'Nohp'},
            {data: 'filetranskripnilai', name: 'filetranskripnilai'},
        ]
    });
  });

// To style only selects with the my-select class
$('.selectpicker').selectpicker();

    $('body').on('click', '.delete', function () {
        var id = $(this).data('id');
        Swal.fire({
          title: 'Are you sure delete this data ?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                type:"POST",
                url: "{{ url('delete-mk')}} ",
                data: { id: id },
                dataType: 'json',
                success: function(params){
                  toastr.success(params.text)
                  $('#openasisten').DataTable().ajax.reload()
              }
            });
          }
        })
    });

    $('body').on('click', '.deleteuser', function () {
        var id = $(this).data('id');
        Swal.fire({
          title: 'Are you sure delete this data ?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                type:"POST",
                url: "{{ url('delete-user')}} ",
                data: { id: id },
                dataType: 'json',
                success: function(params){
                  toastr.success(params.text)
                  $('#datauser').DataTable().ajax.reload()
              }
            });
          }
        })
    });
    
    $('body').on('click', '.deletekelas', function () {
       if (confirm("Are you sure to delete this data ?") == true) {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            type:"POST",
            url: "{{ url('deletekelas')}} ",
            data: { id: id },
            dataType: 'json',
            success: function(params){
              alert(params.text)
              $('#datakelas').DataTable().ajax.reload()
           }
        });
       }
    });

    $('body').on('click', '.deletelab', function () {
       if (confirm("Are you sure to delete this data ?") == true) {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            type:"POST",
            url: "{{ url('deletelab')}} ",
            data: { id: id },
            dataType: 'json',
            success: function(params){
              alert(params.text)
              $('#datalab').DataTable().ajax.reload()
           }
        });
       }
    });

    $('body').on('click', '.deletepeserta', function () {
       if (confirm("Are you sure to delete this data ?") == true) {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            type:"POST",
            url: "{{ url('delete-peserta')}} ",
            data: { id: id },
            dataType: 'json',
            success: function(params){
              alert(params.text)
              $('#pesertakelas').DataTable().ajax.reload()
           }
        });
       }
    });

    $('body').on('click', '.deleteasisten', function () {
       if (confirm("Are you sure to delete this data ?") == true) {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            type:"POST",
            url: "{{ url('delete-asisten')}} ",
            data: { id: id },
            dataType: 'json',
            success: function(params){
              alert(params.text)
              $('#asistenkelas').DataTable().ajax.reload()
           }
        });
       }
    });

    $(function(){
    
    $('#addpeserta').on('submit', function(e){
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
            $('#addpeserta')[0].reset();
            alert(data.msg);
          }
        }
      });
    });
  });

  $(function(){
    
    $('#addasisten').on('submit', function(e){
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
            $('#addasisten')[0].reset();
            alert(data.msg);
          }
        }
      });
    });
  });

</script>

<script>
            $('#customFile').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        </script>

	<script>
	$(function () {
     
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var table = $('#pesertakelas').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ url('tambahpeserta', $data->id_praktikum) }}",
        },
        columnDefs: [
                        {"className": "dt-center", "targets": [0,3]}
                    ],
        columns: [
            {
              "data": null, "sortable": false,
              render: function(data, type, row, meta){
              return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
            {data: 'username', name: 'username'},
            {data: 'nama_user', name: 'nama_user'},
            {data: 'action', name: 'action'},
        ]
    });
  });

  $(function () {
     
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var table = $('#asistenkelas').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ url('tambahasisten', $data->id_praktikum) }}",
        },
        columnDefs: [
                        {"className": "dt-center", "targets": [0,3]}
                    ],
        columns: [
            {
              "data": null, "sortable": false,
              render: function(data, type, row, meta){
              return meta.row + meta.settings._iDisplayStart + 1
                    }
                },
            {data: 'username', name: 'username'},
            {data: 'nama_user', name: 'nama_user'},
            {data: 'action', name: 'action'},
        ]
    });
  });
			</script>

</body>
</html>
