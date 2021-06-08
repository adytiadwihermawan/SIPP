@extends('admin.dashboard')
@section('title', "Data Lab")
@section('content')

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Laboratorium</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
					<i class="fa fa-edit"></i> Tambah Data</button>

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

				<!-- Modal -->
				<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="adduserLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="adduserLabel">Tambah Laboratorium</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="addlab" action="addlab" method="post">
					<div class="modal-body">
					
						@csrf
							<div class="form-group">
								<label for="">Nama Laboratorium</label>
								<input type="text" class="form-control" name="nama_lab" value="{{ old('nama_lab') }}">
								<span style="color:red">@error('nama_lab') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Nama Kepala Laboratorium</label>
								<select id="id" name="id" value="{{ old('id') }}">
                                    <option value="" selected></option>                                
									@foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_user }}</option>
                                    @endforeach
								</select>
								<span style="color:red">@error('id') {{ $message }} @enderror</span>
							</div>
							
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Tambah Laboratorium</button>
					</div>
					</form>
					</div>
				</div>
				</div>
				<!-- end Modal -->
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr style="text-align: center;">
					<th>No</th>
                    <th>Nama Laboratorium</th>
                    <th>Nama Kepala Laboratorium</th>
					<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$no = 1;
				?>
				@foreach ($lab as $item)
                    <tr>
						<td style="text-align: center;">{{ $no }}</td>
                        <td>{{ $item->nama_laboratorium }}</td>
                        <td>{{ $item->nama_user }}</td>
						<td style="text-align: center;">
							<a href="editlab/{{ $item->id_laboratorium }}" title="Edit" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="deletelab/{{  $item->id_laboratorium }}" title="Delete" class="btn btn-danger btn-sm" onsubmit="return confirm('Hapus Data User ?')">
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
			{{ $lab->links() }}
@endsection