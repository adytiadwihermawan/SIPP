@extends('admin.dashboard')
@section('title', "Tambah Peserta Kelas")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Partisipan Kelas {{$data->nama_praktikum}}</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
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
		<div class="table table-borderless">

					<form id="addpeserta" action="/addpeserta" method="post">
						@csrf
                        <input type="hidden" name="id" value="{{$data->id_praktikum}}" readonly>
						<table>
						<tr>
							<td><label for="">Peserta Kelas</label> </td>
							<td  class="ml-5"> :</td>
							 <td><select  class="selectpicker ml-2" data-live-search="true" id="peserta" name="peserta"  style="width: 25vw;" required>
								<option value="" selected></option>
								@foreach ($member as $id => $name)
								<option value="{{$id}}" >{{ $name}}</option>
								@endforeach
							</select>
							<span style="color:red">@error('peserta') {{ $message }} @enderror</span>						
						</td>
						</tr>
						</table>	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datakelas">Kembali</a></button>
						<button type="submit" class="btn btn-primary">Tambah Peserta Kelas</button>
						<button type="button" class="btn blue4h float-right py-1 mr-3"  title="Buat Pertemuan"
                data-toggle="modal" data-target="#modal-import">
                <i class="fa fa-plus"></i> Import Data User</button>
					</div>
				</form>

				

				<div class="modal fade" id="modal-import">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Import Data User</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="import-user" action="{{ route('file-import-peserta') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
									<div class="custom-file text-left">
										<input type="file" name="file" class="custom-file-input" id="customFile">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
								</div>
								<button class="btn btn-primary">Import data</button>
							</form>
						</div>

						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.content -->
			</div>

	@if (!empty($data->id_praktikum))
		
			<table id="pesertakelas" class="table table-bordered table-striped ml-2 mt-4">
				<thead>
					<tr style="text-align: center;">
					<th>NO</th>
                    <th>NIM/NIP</th>
                    <th>NAMA</th>
					<th>AKSI</th>
					</tr>
				</thead>
			</table>
			</div>
	@endif

		
@endsection