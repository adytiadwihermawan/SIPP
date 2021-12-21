@extends('mhs.dashboard')
@section('title', "Daftar Asisten Praktikum")
@section('Judul', 'Pendaftaran Asisten Praktikum')
@section('content')
<div class="card card-info">
	
@if ($form->statusform == 1)
    <div class="card-body">
		<div class="table-responsive">

            @if(Session::get('berhasil'))
					<hr>
						<div class="alert alert-success">
							{{ Session::get('berhasil')  }}
						</div>
					@endif


				<form id="daftar" action="{{route('daftarAsisten')}}" method="POST">
					
						@csrf
                            <input type="hidden" value="{{Auth::user()->id}}" name="id_user" readonly>
							<span class="text-danger error-text id_user_error"></span>

							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" class="form-control" value="{{Auth::user()->nama_user}}" name="nama_user" maxlength="250" readonly>
								<span class="text-danger error-text nama_user_error"></span>
							</div>
							
                            <div class="form-group">
								<label for="">NIM</label>
								<input type="text" class="form-control" name="nim" maxlength="25" value="{{Auth::user()->username}}" readonly>
								<span class="text-danger error-text nim_error"></span>
							</div>
                            
							<div class="form-group">
								<label for="">NO HP</label>
								<input type="text" class="form-control" name="number" maxlength="25" placeholder="Nomor Aktif Akun WhatApps/Telegram">
								<span class="text-danger error-text number_error"></span>
							</div>
							<div class="form-group">
								<label for="">IPK</label>
								<input type="number" step=".01" class="form-control" name="ipk" maxlength="25" min="0" max="4"  placeholder="Contoh : 3.5">
								<span class="text-danger error-text ipk_error"></span>
							</div>


							<div class="form-group">
								<label for="">Mata Kuliah 1 :</label>
								<select id="mk1" name="mk1" class="form-control selectpicker"  data-live-search="true" >
									<option value="" selected></option>
                                    @foreach ($mk as $matakuliah)
									<option value="{{$matakuliah->id_praktikum}}">{{$matakuliah->nama_praktikum}}</option>
                                    @endforeach
								</select>
								<span class="text-danger error-text mk1_error"></span>
							</div>

							<div class="form-group">
								<label for="">Nilai Mata Kuliah 1 :</label>
								<select id="nmk1" name="nmk1" class="form-control selectpicker"  data-live-search="true" >
									<option value="" selected></option>
									<option value="A">A</option>
									<option value="A-">A-</option>
									<option value="B+">B+</option>
									<option value="B">B</option>
								
								</select>
								<span class="text-danger error-text nmk1_error"></span>
							</div>
						
							
							<div class="form-group">
								<label for="">Mata Kuliah 2 :</label>
								<select id="mk2" name="mk2" class="form-control selectpicker"  data-live-search="true" >
									<option value="" selected></option>
									@foreach ($mk as $matakuliah)
									<option value="{{$matakuliah->id_praktikum}}">{{$matakuliah->nama_praktikum}}</option>
                                    @endforeach
								</select>
								<span class="text-danger error-text mk2_error"></span>
							</div>

							<div class="form-group">
								<label for="">Nilai Mata Kuliah 2 :</label>
								<select id="nmk2" name="nmk2" class="form-control selectpicker"  data-live-search="true" >
									<option value="" selected></option>
									<option value="A">A</option>
									<option value="A-">A-</option>
									<option value="B+">B+</option>
									<option value="B">B</option>
								
								</select>
								<span class="text-danger error-text nmk2_error"></span>
							</div>

							 <label for="customFile">Upload Transkrip Nilai</label>
                        <input type="file" name="_file" class="form-control" id="customFile">
                        <span class="text-danger error-text _file_error"></span>
                       
                   
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="">Kembali</a></button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
		</div>
@else
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        Belum ada dibuka untuk Pendaftaran asisten</h2>
                    <div class="error-details">
                        Mohon menunggu sampai dosen membuka Pendaftaran asisten
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection