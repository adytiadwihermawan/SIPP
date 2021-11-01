@extends('admin.dashboard')
@section('title', "Edit Data User")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Edit Data User</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">

					<form id="edituser" action="/update" method="post">
						
						@csrf
								<input type="text" class="form-control" name="id" value="{{ old('id', $Info->id) }}" hidden>

							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" class="form-control" name="nama_user" value="{{ old('nama_user', $Info->nama_user) }}">
								<span class="text-danger error-text nama_user_error"></span>
							</div>
							
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" class="form-control" name="password" value="">
							</div>

							<div class="form-group">
								<label for="">Role</label>
								<select id="role" name="role" value="">
									@foreach ($list as $data)
                                    <option value="{{$data->id_status}}" {{ old('role', $data->id_status) == $Info->id_status ? 'selected' : null}}>{{ $data->status}}</option>
                                    @endforeach
								</select>
								<span class="text-danger error-text role_error"></span>
							</div>
						
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datauser">Kembali</a></button>
						<button type="submit" class="btn btn-primary">Edit Data User</button>
					</div>
					</form>
			</div>

@endsection