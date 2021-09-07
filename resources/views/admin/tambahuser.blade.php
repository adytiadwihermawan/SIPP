@extends('admin.dashboard')
@section('title', "Tambah Data")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Tambah Data User</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			
			@if(Session::get('gagal'))
			<hr>
				<div class="alert alert-danger">
					{{ Session::get('gagal')  }}
				</div>
			@endif
					<form id="adduser" action="adduser" method="post">
					
						@csrf

							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" class="form-control" name="nama_user">
								<span style="color:red">@error('nama_user') {{ $message }} @enderror</span>
							</div>
							
                            <div class="form-group">
								<label for="">Id User</label>
								<input type="text" class="form-control" name="id">
								<span style="color:red">@error('id') {{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label for="">Password</label>
								<input type="password" class="form-control" name="password">
								<span style="color:red">@error('password') {{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label for="">Role</label>
								<select id="role" name="role">
									<option value="" selected></option>
									<option value="1">admin</option>
									<option value="2">dosen</option>
									<option value="4">mahasiswa</option>
								</select>
								<span style="color:red">@error('role') {{ $message }} @enderror</span>
							</div>
						
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datauser">Back</a></button>
						<button type="submit" class="btn btn-primary">Tambah Data User</button>
					</div>
					</form>
			</div>

@endsection