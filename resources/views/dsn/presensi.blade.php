@extends('dsn.dashboard-mk')
@section('title', "Presensi")
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")

<style>
    #sheet-container {
       width: 250px;
       height: 100px;
       border: 1px solid black;
    }
</style>


@section('content')

<div class="card col-12 blue1">
        <div class="card-header">
            <h3 class="card-title">
                <b> {{$mk[0]->nama_praktikum}} </b>
            </h3>

        </div>
    </div>

<div class="card card-primary ml-2">
  <div class="card-header">
    <h3 class="card-title">Presensi</h3>
  </div>
<!-- Main content -->
<section class="content mt-3">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="card col-13">
          <div class="card-header">
            <h3 class="card-title">Presensi Praktikum</h3>
            <a href="{{ route('exportrekap', $mk[0]->id_praktikum) }}" class="btn btn-success float-right">Export Rekap</a>
           </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="presensi" class="table table-bordered table-striped">
				<thead>
					<tr style="text-align: center;">
					<th>No</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Pertemuan</th>
					<th>Tanggal</th>
                    <th>Pokok Bahasan</th>
                    <th>Waktu Presensi</th>
                    <th>Aksi</th>
					</tr>
				</thead>
			</table>
          </div>
        </div>
    </div>

    @foreach ($absen as $item)
                      
    <div class="modal fade" id="edit-absen">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Presensi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-absen" action="{{ route('updateAbsen') }}" method="POST">
                            @csrf

                            <input type="hidden" class="form-control" name="id" id="id" readonly>

                            <div class="form-group">
                                <label for="">Pertemuan</label>
                                <input type="number" class="form-control" name="pertemuan" id="pertemuan">
                                <span class="text-danger error-text id_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{$item->tanggal->format('Y-m-d')}}">
                                <span class="text-danger error-text tanggal_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Materi</label>
                                <input type="text" class="form-control" name="materi" id="materi" maxlength="250">
                                <span class="text-danger error-text materi_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Waktu Mulai Presensi</label>
                                <input type="datetime-local" class="form-control" name="wmp" id="wmp" value="{{$item->waktu_mulai->toDatetimelocalString()}}">
                                <span class="text-danger error-text wmp_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Waktu Akhir Presensi</label>
                                <input type="datetime-local" class="form-control" name="wap" id="wap" value="{{$item->waktu_berakhir->toDatetimelocalString()}}">
                                <span class="text-danger error-text wap_error"></span>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit Presensi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 

    @endforeach

@endsection