<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SIDP | Log in</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/bootstrap/css/custom.css')}}">


</head>                
<body class="hold-transition login-page cold1 ">

<div id="warning-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(9, 179, 164)">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="text-justify">Anda lupa password login ? Silakan hubungi:</p>
                <ul type="circle">
                    <li>Kepala Laboratorium, jika anda seorang <strong>Mahasiswa</strong>.</li>
                    <li>Admin, jika anda seorang <strong>Dosen</strong>.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
            <div>
                <div class="login-box" style="margin-top: -30px">
                    <div class="login-logo">
                    <div class="text-center">
                        <img src="{{asset('img/logo.png')}}" style="height: 128px; width: 128px;"><br>
                        <a href="#">
                        <b>S</b>ISTEM <b>I</b>NFORMASI PEN<b>D</b>ATAAN <b>P</b>RAKTIKUM
                        </a>
                    </div>
                    </div>
                    @if(Session::get('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error')  }}
                        </div>
                    @endif
                    <div class="card card cold2">
                    <div class="card-header cold4">
                        <h5 class="card-title">
                        <i class="fas fa-sign-in-alt mr-1"></i>
                        Sign in
                        </h5>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                   
                    
                        @csrf
                        
                        <div class="card-body">

                            <div class="form-group">
                                <label for="username">Username</label>
                                    <div class="input-group">
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="id" autofocus>
                                
                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn cold4h">
                                {{ __('Login') }}
                            </button>
                            <a style="margin-left: 10px;" data-toggle="modal" data-target="#warning-modal">  Lupa Password ?</a>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

  <!-- Bootstrap 4 -->
<script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('template/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/dist/js/adminlte.js')}}"></script>
<!-- Popper JS -->
<script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>

