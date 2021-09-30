@extends('asist.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
<!-- Content Wrapper. Contains page content -->

<div class="content">
@if(empty($course[0]->id_pertemuan))
   <div class="card blue2 ml-2">
        <div class="card-header">
            <h3 class="card-title">
                {{$mk[0]->nama_praktikum}}
            </h3>

            <button type="button" class="btn blue4h float-right" style=" padding:1px 4px;" title="Buat Pertemuan"
                data-toggle="modal" data-target="#modal-pertemuan">
                <i class="fa fa-plus"></i> Tambah Pertemuan</button>

        </div>
    </div>
    
<div class="modal fade" id="modal-pertemuan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buat Pertemuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="buat-pertemuan" action="{{ route('pertemuan') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Mata Kuliah</label>
                        <input type="text" class="form-control" name="id" value="{{$mk[0]->id_praktikum}}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="">Pertemuan Ke</label>
                        <input type="text" class="form-control" placeholder="Contoh: Pertemuan 1" name="nama_pertemuan"
                            required>
                        <span class="text-danger error-text nama_pertemuan_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Materi Pembahasan</label>
                        <input type="text" class="form-control" placeholder="Contoh: Cara Menggunakan Framework Laravel"
                            name="deskripsi" required>
                        <span class="text-danger error-text deskripsi_error"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="buat-pertemuan" class="btn btn-primary">Buat Pertemuan</button>
                    </div>
                </form>
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.content -->
</div>
@else
    <div class="card blue2 ml-2">
        <div class="card-header">
            <h3 class="card-title">
                {{$mk[0]->nama_praktikum}}
            </h3>

            <button type="button" class="btn blue4h float-right" style=" padding:1px 4px;" title="Buat Pertemuan"
                data-toggle="modal" data-target="#modal-pertemuan">
                <i class="fa fa-plus"></i> Tambah Pertemuan</button>

        </div>
    </div>

    <div class="modal fade" id="modal-pertemuan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Pertemuan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="buat-pertemuan" action="{{ route('pertemuan') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Mata Kuliah</label>
                            <input type="text" class="form-control" name="id" value="{{$mk[0]->id_praktikum}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Pertemuan Ke</label>
                            <input type="text" class="form-control" placeholder="Contoh: Pertemuan 1"
                                name="nama_pertemuan" required>
                            <span class="text-danger error-text nama_pertemuan_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Materi Pembahasan</label>
                            <input type="text" class="form-control"
                                placeholder="Contoh: Cara Menggunakan Framework Laravel" name="deskripsi" required>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="buat-pertemuan" class="btn btn-primary">Buat Pertemuan</button>
                        </div>
                    </form>
                </div>

                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-header -->
    <div class="col-12 mb-3 ">
        <button type="button" class="btn blue4h panjang1" data-toggle="modal" data-target="#modal-presensi"> <i
                class="fas fa-plus"></i> Buat Presensi </button>

        <button type="button" class="btn hijau panjang1 ml-3" data-toggle="modal" data-target="#addmateri"> <i
                class="fas fa-plus"></i> Upload Materi </button>

        <button type="button" class="btn hijau panjang1 ml-3" data-toggle="modal" data-target="#addtugas"> <i
                class="fas fa-plus"></i> Upload Tugas </button>

    </div>

    <div class="modal fade" id="addmateri">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Materi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="upload-file" action="{{ route('fileUpload') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Pertemuan ke:</label>
                            <select id="id" name="id" class="form-control" required>
                                <option value="" selected>Pilih Pertemuan</option>
                                @foreach($course as $pertemuan)
                                <option value="{{$pertemuan->id_pertemuan}}">
                                    {{$pertemuan->nama_pertemuan}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text id_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Judul Materi</label>
                            <input type="text" class="form-control" name="judul_materi" required>
                            <span class="text-danger error-text judul_materi_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi Materi</label>
                            <input type="text" class="form-control" name="deskripsi" maxlength="30">
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <input type="file" name="_file" id="_file" style="margin-bottom:15px;" class="form-control"
                            required>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload Materi</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="addtugas">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Tugas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="upload-tugas" action="{{ route('uploadTugas') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Pertemuan ke:</label>
                            <select id="id" name="id" class="form-control" required>
                                <option value="" selected>Pilih Pertemuan</option>
                                @foreach($course as $pertemuan)
                                <option value="{{$pertemuan->id_pertemuan}}">
                                    {{$pertemuan->nama_pertemuan}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text id_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Judul Tugas</label>
                            <input type="text" class="form-control" name="judul_tugas" required>
                            <span class="text-danger error-text judul_tugas_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi Tugas</label>
                            <input type="text" class="form-control" name="deskripsi" maxlength="30">
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <input type="file" name="_file" id="_file" style="margin-bottom:15px;" class="form-control"
                            required>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload Tugas</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-presensi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Presensi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="absen" action="{{ route('buatAbsen') }}" method="POST">
                        @csrf

                        <input type="hidden" class="form-control" name="id" value="{{$mk[0]->id_praktikum}}" readonly>

                        <div class="form-group">
                            <label for="">Pertemuan</label>
                            <input type="number" class="form-control" name="pertemuan" required>
                            <span class="text-danger error-text id_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required>
                            <span class="text-danger error-text tanggal_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Materi</label>
                            <input type="text" class="form-control" name="materi" required>
                            <span class="text-danger error-text materi_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Waktu Mulai Presensi</label>
                            <input type="datetime-local" class="form-control" name="wmp" required>
                            <span class="text-danger error-text wmp_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Waktu Akhir Presensi</label>
                            <input type="datetime-local" class="form-control" name="wap" required>
                            <span class="text-danger error-text wap_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Buat Presensi</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @foreach($course as $item)
    <div class="card col-12">

        <div class="card">
            <div class="card-header blue2">
                <h3 class="card-title">{{$item->nama_pertemuan}}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

            </div>
            <br>
            @foreach($data_materi as $datas)
            @if($datas->id_pertemuan == $item->id_pertemuan)

            <div class="card col-12">
                <div class="card-header cold4 ">
                   <h3 class="card-title">{{$datas->judul_materi}}</h3>
                    <a href="/deletemateri/{{  $datas->id_materi }}" title="Delete" class="btn-sm btn-danger btn float-right"
                        onclick="return confirm('Are you sure to delete this data ?')">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                <div class="card-body cold1">
                    <a href="{{route('download', $datas->namafile_materi)}}">{{$datas->namafile_materi}}</a>
                </div>
                @if($datas->deskripsi_file != null)
                <div class="card-footer">
                    <p>{{$datas->deskripsi_file}}</p>
                </div>
                @endif
            </div>
            @endif
            @endforeach

            <br>
            @foreach($data_tugas as $datas)
            @if($datas->id_pertemuan == $item->id_pertemuan)

            <div class="card col-12">
                <div class="card-header cold4 ">
                   <h3 class="card-title">{{$datas->judul_tugas}}</h3>
                    <a href="/deletetugas/{{  $datas->id_wadahtugas }}" title="Delete" class="btn-sm btn-danger btn float-right"
                        onclick="return confirm('Are you sure to delete this data ?')">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                <div class="card-body cold1">
                    <a href="{{route('download', $datas->file_tugas)}}">{{$datas->file_tugas}}</a>
                </div>
                @if($datas->deskripsi_tugas != null)
                <div class="card-footer">
                    <p>{{$datas->deskripsi_tugas}}</p>
                </div>
                @endif
            </div>
            @endif
            @endforeach

        </div>

        <div class="card-footer blue1">
            {{$item->deskripsi}}
            <br> 
            <a data-toggle="modal" data-id="{{ $item->id_pertemuan }}" data-pertemuan="{{$item->nama_pertemuan}}" data-deskripsi="{{$item->deskripsi}}" class="passingID">
            <button type="button" class="btn hijau3 panjang1 float-right"  data-toggle="modal" data-target="#edit-pertemuan">
                <i class="fas fa-edit"></i> Edit Pertemuan </button>
            </a>
        </div>
    </div>
    
    @endforeach
    
<div class="modal fade" id="edit-pertemuan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Pertemuan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-pertemuan" action="{{ route('updatepertemuan') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Pertemuan</label>
                            <input type="text" class="form-control" name="id" id="id" value="{{$item->id_pertemuan}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Pertemuan Ke</label>
                            <input type="text" class="form-control" id="pertemuan" value="{{ $item->nama_pertemuan }}"
                                name="nama_pertemuan" required>
                            <span class="text-danger error-text nama_pertemuan_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Materi Pembahasan</label>
                            <input type="text" class="form-control"
                                placeholder="Masukkan Deskripsi" name="deskripsi" id="deskripsi"  required>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="buat-pertemuan" class="btn btn-primary">Edit Pertemuan</button>
                        </div>
                    </form>
                </div>

                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.content -->
    </div>
@endif
</div>

@endsection
