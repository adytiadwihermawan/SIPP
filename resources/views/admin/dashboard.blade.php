
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
          }else{
            $('#adduser')[0].reset();
            alert(data.msg);
          }
        }
      });
    });

// To style only selects with the my-select class
$('.selectpicker').selectpicker();


    $('body').on('click', '.delete', function () {
       if (confirm("Are you sure to delete this data ?") == true) {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
            type:"POST",
            url: "{{ url('delete-mk')}} ",
            data: { id: id },
            dataType: 'json',
            success: function(params){
              alert(params.text)
              $('#openasisten').DataTable().ajax.reload()
           }
        });
       }
    });

  });

</script>

</body>
</html>
