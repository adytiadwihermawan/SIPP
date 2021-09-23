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
		<div class="table table-borderless">

					<form id="addpeserta" action="addpeserta" method="post">
						@csrf
                        
						<table>

						<tr>
							<td><label for="">Kelas</label>  </td>
							<td class="ml-5"> :</td>
							<td><select class="selectpicker ml-2" data-live-search="true" id="kelas" name="kelas" value="{{ old('kelas')}}" style="width: 25vw;"></div>
								<option value="" selected></option>
								@foreach ($kelas as $value)
								<option value="{{$value->id_praktikum}}" >{{$value->nama_praktikum}}</option>
								@endforeach
							</select> </td>
						</tr>
						<tr>
							<td><label for="">Peserta Kelas</label> </td>
							<td  class="ml-5"> :</td>
							 <td><select  class="selectpicker ml-2" data-live-search="true" id="peserta" name="peserta" value="{{ old('peserta')}}" style="width: 25vw;">
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
					</div>
					</form>

					<button type="button" class="btn blue4h float-right" style=" padding:1px 4px;" title="Buat Pertemuan"
                data-toggle="modal" data-target="#modal-import">
                <i class="fa fa-plus"></i> Import Data User</button>

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
</div>
			<table id="pesertakelas" class="table table-bordered table-striped">
				<thead>
					<tr style="text-align: center;">
					<th>No</th>
                    <th>Id User</th>
                    <th>Nama</th>
                    <th>Praktikum</th>
					<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($data as $user => $kelas)
				
                    <tr>
						<td style="text-align: center;">{{ $data->firstItem() + $user }}</td>
                        <td>{{ $kelas->username }}</td>
                        <td style="text-align: center;">{{ $kelas->nama_user }}</td>
                        <td style="text-align: center;">{{ $kelas->nama_praktikum}}</td>
						<td style="text-align: center;">
							<a href="edit/{{ $kelas->id }}" title="Edit" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="delete/{{  $kelas->id }}" title="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data User ?')">
								<i class="fa fa-trash"></i>
							</a>
						</td>
                    </tr>
                @endforeach
                </tbody>
			</table>
			{{ $data->links() }}

@endsection