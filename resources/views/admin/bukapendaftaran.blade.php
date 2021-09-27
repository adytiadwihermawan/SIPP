@extends('admin.dashboard')
@section('title', "Tambah Data")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Tambah </h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			
			@if(Session::get('gagal'))
			<hr>
				<div class="alert alert-danger">
					{{ Session::get('gagal')  }}
				</div>
			@endif
					<form id="adduser" action="{{route('tambahpengguna')}}" method="POST">
					
						@csrf
							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" class="form-control" name="nama_user" maxlength="250">
								<span class="text-danger error-text nama_user_error"></span>
							</div>
							
                            <div class="form-group">
								<label for="">NIM</label>
								<input type="text" class="form-control" name="id" maxlength="25" placeholder="Digunakan sebagai username saat login">
								<span class="text-danger error-text id_error"></span>
							</div>
							<div class="form-group">
								<label for="">NO HP</label>
								<input type="text" class="form-control" name="id" maxlength="25" placeholder="Nomor Aktif Akun WhatApps/Telegram">
								<span class="text-danger error-text id_error"></span>
							</div>
							<div class="form-group">
								<label for="">IPK</label>
								<input type="number" step=".01" class="form-control" name="id" maxlength="25"  placeholder="Contoh : 3.5">
								<span class="text-danger error-text id_error"></span>
							</div>


							<div class="form-group">
								<label for="">Mata Kuliah 1 :</label>
								<select id="role" name="role" class="form-control selectpicker"  data-live-search="true" >
									<option value="" selected></option>
									<option value="1">matkul1</option>
								</select>
								<span class="text-danger error-text role_error"></span>
							</div>

							<div class="form-group">
								<label for="">Nilai Mata Kuliah 1 :</label>
								<select id="role" name="role" class="form-control selectpicker"  data-live-search="true" >
									<option value="" selected></option>
									<option value="1">A</option>
									<option value="1">A-</option>
									<option value="1">B+</option>
									<option value="1">B</option>
								
								</select>
								<span class="text-danger error-text role_error"></span>
							</div>
						
							
							<div class="form-group">
								<label for="">Mata Kuliah 2 :</label>
								<select id="role" name="role" class="form-control selectpicker"  data-live-search="true" >
									<option value="" selected></option>
									<option value="1">matkul1</option>
								</select>
								<span class="text-danger error-text role_error"></span>
							</div>

							<div class="form-group">
								<label for="">Nilai Mata Kuliah 2 :</label>
								<select id="role" name="role" class="form-control selectpicker"  data-live-search="true" >
									<option value="" selected></option>
									<option value="1">A</option>
									<option value="1">A-</option>
									<option value="1">B+</option>
									<option value="1">B</option>
								
								</select>
								<span class="text-danger error-text role_error"></span>
							</div>

							<div class="custom-file">
                        <input type="file" name="_file" class="custom-file-input" id="customFile" required>
                        <span class="text-danger error-text _file_error"></span>
                        <label class="custom-file-label" for="customFile">Upload Transkrip Nilai</label>
                    </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datauser">Kembali</a></button>
						<button type="submit" class="btn btn-primary"  href="/datauser">Tambah Data User</button>
					</div>
				</form>
		</div>

@endsection