@extends('dsn.dashboard')
@section('title', "Profile")    
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Ubah Akun</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="ml-3 mr-2">
                <div class="card-body">
                  <div class="form-group">
                    <div class="row mb-2 ml-5 display ">
                      <div class="col-sm-3" >
                    <div class="image">
                      <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> </div> </div>
                      <div class="col-sm-6 mt-4">
                      <h1>Andreyan Rizky Baskara</h1></div> 
                    </div>
                  </div>

                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Ganti Foto Profil</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 mb-4">Submit</button>
                  </div>
                  <h3>Ganti Password</h3>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password Lama</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password Baru</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password Baru</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-primary mt-2 mb-3">Submit</button>
              
                </div>
                <!-- /.card-body -->

               
              </form>
            </div>
        <!-- /.row -->
        <!-- Main row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection