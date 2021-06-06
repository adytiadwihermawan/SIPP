@extends('admin.dashboard')
@section('title', "Tambah Peserta Kelas")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Tambah Peserta Kelas</h3>
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

					<form id="addpeserta" action="addpeserta" method="post">
					
						@csrf

							<div class="form-group">
								<label for="">Kelas</label> 
								<input type="text" class="form-control" name="kelas" value="{{ old('kelas', $Info->nama_praktikum) }}" readonly>
							</div>
							
							<div class="form-group">
								<label for="">Peserta Kelas</label>
								<select id="peserta" name="peserta" value="{{ old('peserta')}}">
                                    <option value="" selected></option>
									@foreach ($data as $id => $name)
                                    <option value="{{$id}}" >{{ $name}}</option>
                                    @endforeach
								</select>
								<span style="color:red">@error('peserta') {{ $message }} @enderror</span>
							</div>
						
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datakelas">Back</a></button>
						<button type="submit" class="btn btn-primary">Tambah Peserta Kelas</button>
					</div>
					</form>
			</div>

@endsection