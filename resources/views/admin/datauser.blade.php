@extends('admin.dashboard')

@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")
@section('title', "Data User")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data User</h3>
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

			
					<div class="row mb-5">
					<div class="col-sm">
			<button type="button" class="btn btn-primary" onclick="window.location.href='/tambahuser'">
				<i class="fa fa-edit"></i> Tambah User </button> 

				<button type="button" class="btn blue4h" title="Buat Pertemuan"
                data-toggle="modal" data-target="#modal-import">
                <i class="fa fa-plus"></i> Import Data User</button></div>

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
							<form id="import-user" action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
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
					</div>
				</div>
			</div>
			
				<div class="col-sm">
			<form action="{{ route('search') }}" method="GET">
				<input type="text" name="search" placeholder="Search"  class="form-control form-control-border" /> </div>
				<div class="col-sm">
				<button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button> 
				<button type="submit"  class="btn btn-secondary" onclick="window.location.href='/datauser'"><i class="fas fa-redo"></i></button>
			</form>
				</div>

					</div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr style="text-align: center;">
					<th>No</th>
                    <th>Id User</th>
                    <th>Nama</th>
                    <th>Status</th>
					<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($user as $item => $data)
				
                    <tr>
						<td style="text-align: center;">{{ $user->firstItem() + $item }}</td>
                        <td>{{ $data->username }}</td>
                        <td>{{ $data->nama_user }}</td>
                        <td style="text-align: center;">{{ $data->status}}</td>
						<td style="text-align: center;">
							<a href="edit/{{ $data->id }}" title="Edit" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							@if (!($data->id_status == 1))
							<a href="delete/{{$data->id}}" title="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data User ?')">
								<i class="fa fa-trash"></i>
							@endif
							</a>
						</td>
                    </tr>
                @endforeach
                </tbody>
			</table>
			{{ $user->links() }}
@endsection
