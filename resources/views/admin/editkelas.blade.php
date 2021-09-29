@extends('admin.dashboard')
@section('title', "Edit Data Kelas")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Edit Data Kelas</h3>
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

					<form id="editkelas" action="/updatekelas" method="post">
						
						@csrf
							<div class="form-group">
								<!-- <label for="">Id Kelas</label> -->
								<input type="text" class="form-control" name="id" value="{{ old('id', $Info->id_praktikum) }}" hidden>
							</div>

							<div class="form-group">
								<label for="">Kelas</label>
								<input type="text" class="form-control" name="nama_prak" value="{{ old('nama_prak', $Info->nama_praktikum) }}" maxlength="50">
								<span style="color:red">@error('nama_prak') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Tahun Ajaran</label>
								<input type="text" class="form-control" name="thn_ajar" value="{{ old('thn_ajar', $Info->tahun_ajaran) }}" maxlength="20">
								<span style="color:red">@error('thn_ajar') {{ $message }} @enderror</span>
							</div>
						
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datakelas">Kembali</a></button>
						<button type="submit" class="btn btn-primary">Edit Data Kelas</button>
					</div>
					</form>
			</div>

@endsection