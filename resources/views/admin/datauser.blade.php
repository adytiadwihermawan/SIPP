@extends('admin.dashboard')
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

			<button type="button" class="btn btn-primary" onclick="window.location.href='/tambahuser'">
				<i class="fa fa-edit"></i> Tambah User </button>
			<br>
			<br>
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
				<?php 
					$no = 1;
				?>
				@foreach ($user as $item)
                    <tr>
						<td style="text-align: center;">{{ $no }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama_user }}</td>
                        <td style="text-align: center;">{{ $item->status}}</td>
						<td style="text-align: center;">
							<a href="edit/{{ $item->id }}" title="Edit" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="delete/{{  $item->id }}" title="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Data User ?')">
								<i class="fa fa-trash"></i>
							</a>
						</td>
                    </tr>
				<?php
					$no++;
				?>
                </tbody>
                @endforeach
			</table>

			{{ $user->links() }}
@endsection
