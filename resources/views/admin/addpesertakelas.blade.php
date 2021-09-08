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

					<form id="addpeserta" action="addpeserta" method="post">
						@csrf
                        
						<table>

						<tr>
							<td><label for="">Kelas</label>  </td>
							<td><select id="kelas" name="kelas" value="{{ old('kelas')}}" class="ml-5" style="width: 25vw;"></div>
								<option value="" selected></option>
								@foreach ($kelas as $value)
								<option value="{{$value->id_praktikum}}" >{{$value->nama_praktikum}}</option>
								@endforeach
							</select> </td>
						</tr>
						
							<td><label for="">Peserta Kelas</label> </td>
							 <td><select id="peserta" name="peserta" value="{{ old('peserta')}}" class="ml-5" style="width: 25vw;">
								<option value="" selected></option>
								@foreach ($member as $id => $name)
								<option value="{{$id}}" >{{ $name}}</option>
								@endforeach
							</select>
							<span style="color:red">@error('peserta') {{ $message }} @enderror</span> </td>
						</table>				
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datakelas">Kembali</a></button>
						<button type="submit" class="btn btn-primary">Tambah Peserta Kelas</button>
					</div>
					</form>
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