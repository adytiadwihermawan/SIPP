@extends('admin.dashboard')
@section('title', "Edit Data")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Edit Data User</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">

					@if(Session::get('berhasil'))
					<hr>
					<div class="alert alert-success">
						{{ Session::get('berhasil')  }}
					</div>
					@endif

					@if(Session::get('gagal'))
					<hr>
						<div class="alert alert-danger">
							{{ Session::get('gagal')  }}
						</div>
					@endif

					<form id="edituser" action="/update" method="post">
					
						@csrf
							<div class="form-group">
								<label for="">Id User</label>
								<input type="text" class="form-control" name="id" value="{{ old('id', $Info->id) }}" readonly>
							</div>

							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" class="form-control" name="nama_user" value="{{ old('nama_user', $Info->nama_user) }}">
								<span style="color:red">@error('nama_user') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" class="form-control" name="password" value="{{ old('password', $Info->password) }}">
								<span style="color:red">@error('password') {{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label for="">Role</label>
								<select id="role" name="role" value="">
									@foreach ($list as $data)
                                    <option value="{{$data->id_status}}" {{ old('role', $data->id_status) == $Info->id_status ? 'selected' : null}}>{{ $data->status}}</option>
                                    @endforeach
								</select>
								<span style="color:red">@error('role') {{ $message }} @enderror</span>
							</div>
						
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datauser">Back</a></button>
						<button type="submit" class="btn btn-primary">Edit Data User</button>
					</div>
					</form>
			</div>

@endsection