@extends('admin.dashboard')
@section('title', "Tambah Data")
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")

@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Mata Kuliah Untuk Calon Asisten Praktikum </h3>
    </div>
    <br>
    <div class="col-sm">

        <button type="button" class="btn blue4h" title="Tambah MK" data-toggle="modal" data-target="#modal-mk">
            <i class="fa fa-plus"></i> Tambah Mata Kuliah Praktikum</button>
    </div>

            <form id="addasisten" action="addasisten" method="post">
						<table class="mt-3 ml-2">

						<tr>

							
							<td><select  class="form-control" style="width: 25vw;">
								<option value="" selected> TUTUP REKRUT ASISTEN</option>
								
								<option value="" >BUKA REKRUT ASISTEN</option>
								
							</select> </td>
                            <td class="mt-0"><button type="submit" class="btn btn-primary mt-0">UBAH STATUS</button></td>
						</tr>
	
						</table>					
						
					</form>
    

    <div class="modal fade" id="modal-mk">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import Data User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="import-user" action="{{ route('file-import') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Mata Kuliah Tersedia:</label>
                            <select id="mk1" name="mk1" class="form-control selectpicker" data-live-search="true">
                                <option value="" selected></option>
                                @foreach ($mk as $matakuliah)
                                <option value="{{$matakuliah->id_praktikum}}">{{$matakuliah->nama_praktikum}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text mk1_error"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><a
                                    style="color: white;" href="">Kembali</a></button>
                            <button type="submit" class="btn btn-primary">Tambah Praktikum</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <table style="width: 85%" class="table table-striped hover" id="openasisten">
        <thead>
            <tr style="text-align: center">
                <th>No</th>
                <th>Nama Praktikum</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>

</div>

@endsection
