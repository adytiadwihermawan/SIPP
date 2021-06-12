@extends('admin.dashboard')
@section('title', "Data Kelas")
@section('content')

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Kelas</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<button type="button" class="btn btn-primary" onclick="window.location.href='/tambahkelas'">
					<i class="fa fa-edit"></i> Tambah Kelas </button>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addpeserta">
					<i class="fa fa-edit"></i> Tambah Peserta Kelas </button>
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
				<div class="modal fade" id="addpeserta" tabindex="-1" role="dialog" aria-labelledby="addpesertaLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="addpesertaLabel">Tambah Peserta Kelas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="addpeserta" action="addpeserta" method="post">
					<div class="modal-body">
					
						@csrf
							
						<div class="form-group">
							<label for="">Kelas</label> 
							<select id="kelas" name="kelas" value="{{ old('kelas')}}">
								<option value="" selected></option>
								@foreach ($kelas as $value)
								<option value="{{$value->id_praktikum}}" >{{$value->nama_praktikum}}</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group">
							<label for="">Peserta Kelas</label>
							<select id="peserta" name="peserta" value="{{ old('peserta')}}">
								<option value="" selected></option>
								@foreach ($member as $id => $name)
								<option value="{{$id}}" >{{ $name}}</option>
								@endforeach
							</select>
							<span style="color:red">@error('peserta') {{ $message }} @enderror</span>
						</div>							
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Tambah Peserta Kelas</button>
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
                    <th>Id Kelas</th>
                    <th>Nama Kelas</th>
                    <th>Tahun Ajaran</th>
					<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$no = 1;
				?>
				@foreach ($kelas as $item)
                    <tr>
						<td style="text-align: center;">{{ $no }}</td>
                        <td>{{ $item->id_praktikum }}</td>
                        <td>{{ $item->nama_praktikum }}</td>
                        <td style="text-align: center;">{{ $item->tahun_ajaran}}</td>
						<td style="text-align: center;">
							<a href="editkelas/{{ $item->id_praktikum }}" title="Edit" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="deletekelas/{{  $item->id_praktikum }}" title="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this data ?')">
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
			{{ $kelas->links() }}
@endsection