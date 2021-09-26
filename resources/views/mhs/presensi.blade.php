@extends('mhs.dashboard-mk')
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
@if(empty($absen[0]->id_wadah))

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        Belum Ada Absen untuk Mata Kuliah Sekarang</h2>
                    <div class="error-details">
                        Mohon menunggu sampai dosen atau asisten kelas membuat absen untuk mata kuliah ini
                    </div>
                </div>
            </div>
        </div>
    </div>

@else
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
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr style="text-align: center;">
					          <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Pertemuan</th>
					          <th>Tanggal</th>
                    <th>Pokok Bahasan</th>
                    <th>Waktu Presensi</th>
                    <th>Presensi</th>
					</tr>
				</thead>
				<tbody>
				@foreach ($absen as $item => $data)
                    <tr style="text-align: center;">
						<td>{{ $absen->firstItem() + $item }}</td>
                        <td>{{ $data->nama_praktikum }}</td>
                        <td>{{ $data->hari_praktikum }}</td>
                        <td>{{ date('H:i', strtotime($data->jam_praktikum))}}</td>
                        <td style="text-align: center;">{{ $data->urutanpertemuan }}</td>
                        <td>{{$data->tanggal->format('l, j F Y')}}
                        </td>
                        <td>{{ $data->keterangan}}</td>
                        <td>Mulai Berlaku
                          <br>
                          {{ $data->waktu_mulai->format('l, j F Y') }} jam 
                          <br>
                          {{ $data->waktu_mulai->format('H:i')}}
                          <br>
                          s.d
                          <br>
                          {{ $data->waktu_berakhir->format('l, j F Y') }} jam 
                          <br>
                          {{ $data->waktu_berakhir->format('H:i')}}
                        </td>
                        <td>
                        @if($cek)
                          @if($cek->fotottd_presensi && $cek->id_wadah == $data->id_wadah)
                            Hadir
                          @else
                            <a data-toggle="modal" data-id="{{ $data->id_wadah }}" class="passingID">
                           <button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#modal-default">
                                Presensi
                           </button>
                          </a>
                          @endif
                        @else
                          <a data-toggle="modal" data-id="{{ $data->id_wadah }}" class="passingID">
                           <button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#modal-default">
                                Presensi
                           </button>
                        @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
			</table>
			{{ $absen->links() }}
          </div>
          <!-- /.card-body -->
        </div>
      <!-- ./col -->
    </div>
</section>
   <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-default">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tanda Tangan Absen</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>  
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form method="POST" action="{{route('signature')}}">
                        @csrf

                        <input type="hidden" class="form-control" name="id_user" value="{{Auth::user()->id}}" readonly>
                        
                        <input type="hidden" class="form-control" id="id" name="id_wadah" value="{{$data->id_wadah}}" readonly>
                        
                        <div class="col-md-12">
                            <label class="" for="">Tanda Tangan:</label>
                            <br/>
                            <div id="sig" style="width: 25vw;" class="mb-3"></div>
                            <br/>
                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                        </div>
                        <br/>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-success">Save</button>
                    </form>
           </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  </div>
  
@endif
@endsection