@extends('admin.dashboard')
@section('title', "Tambah Data")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Tambah Kelas</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">

					<form id="addkelas" action="addkelas" method="post">
					
						@csrf

                        <div class="form-group">
                            <label for="">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_praktikum" >
                            <span style="color:red">@error('nama_praktikum') {{ $message }} @enderror</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Tahun Ajaran</label>
                            <input type="text" class="form-control" name="tahun_ajaran" >
                            <span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
                        </div>
						
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datakelas">Back</a></button>
						<button type="submit" class="btn btn-primary">Tambah Data Kelas</button>
					</div>
					</form>
			</div>

@endsection