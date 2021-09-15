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

			
					<div class="row mb-5 mx-auto">
					<div class="col-sm">
			<button type="button" class="btn btn-primary" onclick="window.location.href='/tambahuser'">
				<i class="fa fa-edit"></i> Tambah User </button> </div>
			
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
							<a href="delete/{{$data->id}}" title="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data User ?')">
								<i class="fa fa-trash"></i>
							</a>
						</td>
                    </tr>
                @endforeach
                </tbody>
			</table>
			{{ $user->links() }}
@endsection
