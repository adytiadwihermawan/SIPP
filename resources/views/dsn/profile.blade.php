@extends('dsn.dashboard')
@section('title',"Profile")

@section('Judul',"Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")

@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle user_picture" src="{{Auth::user()->fotouser}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{Auth::user()->nama_user}}</h3>

                <p class="text-muted text-center">
                  
                  {{ DB::table('users')
                      ->leftJoin('status_user', 'status_user.id_status', '=', 'users.id_status')
                      ->find(Auth::id())->status }}
                  
                </p>
                <input type="file" name="user_pic" id="user_pic" style="opacity: 0; height:1px; display:none">
                <a href="javascript:void(0)" class="btn btn-primary btn-block" id="change_picture_button"><b>Change Profile Picture</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2 tomato">
                <ul class="nav nav-pills">
                 <h4 class="mx-auto"> <b>UBAH PASSWORD <b></h4>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                  <div  class="active tab-pane" id="ganti_password">
                    <form class="form-horizontal" action="{{ route('gantiPassword') }}" method="POST" id="gantiPass">
                      @csrf
                      <div class="form-group row">
                        <label for="oldPass" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="current_password" placeholder="Enter Current Password" name="current_password">
                          <span class="text-danger error-text current_password_error"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="newPass" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="new_password" placeholder="Enter New Password" name="new_password">
                          <span class="text-danger error-text new_password_error"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="newPass2" class="col-sm-2 col-form-label">Confirm New Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="cnew_password" placeholder="ReEnter New Password" name="cnew_password">
                          <span class="text-danger error-text cnew_password_error"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-secondary">Update Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection