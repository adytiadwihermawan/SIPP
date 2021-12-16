@extends('asist.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
<!-- Content Wrapper. Contains page content -->

<div class="content">
    @if(empty($course[0]->id_pertemuan))

    <div class="card blue1 ml-2">
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
                            <label for="">Nama Pertemuan : Pertemuan Ke</label>
                            <input type="text" class="form-control" placeholder="Contoh: Pertemuan 1"
                                name="nama_pertemuan" required maxlength="250">
                            <span class="text-danger error-text nama_pertemuan_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Materi Pembahasan</label>
                            <!-- <input type="text" class="form-control" placeholder="Contoh: Cara Menggunakan Framework Laravel"
                            name="deskripsi" required maxlength="2500"> -->
                            <textarea class="form-control" name="deskripsi" maxlength="2500" required rows="4"
                                form="buat-pertemuan" required
                                placeholder="Contoh: Cara Menggunakan Framework Laravel"> </textarea>

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
    <div class="card blue1 ml-2">
        <div class="card-header">
            <h3 class="card-title">
                <b> {{$mk[0]->nama_praktikum}} </b>
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
                            <!-- <label for="">Mata Kuliahku</label> -->
                            <input type="text" class="form-control" name="id" value="{{$mk[0]->id_praktikum}}" hidden>
                        </div>

                        <div class="form-group">
                            <label for="">Nama Pertemuan / Pertemuan Ke</label>
                            <input type="text" class="form-control" placeholder="Contoh: Pertemuan 1"
                                name="nama_pertemuan" required maxlength="250">
                            <span class="text-danger error-text nama_pertemuan_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Materi Pembahasan</label>
                            <!-- <input type="text" class="form-control"
                                placeholder="Contoh: Cara Menggunakan Framework Laravel" name="deskripsi" required> -->
                            <textarea class="form-control" name="deskripsi" maxlength="2500" rows="4"
                                form="buat-pertemuan" required> </textarea>

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
                class="fas fa-plus"></i> Tambah Materi </button>

        <button type="button" class="btn hijau panjang1 ml-3" data-toggle="modal" data-target="#addtugas"> <i
                class="fas fa-plus"></i> Tambah Tugas </button>

    </div>

     <div class="modal fade" id="addmateri">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Materi</h4>
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
                            <select id="id" name="id" class="form-control">
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
                            <input type="text" class="form-control" name="judul_materi" maxlength="250">
                            <span class="text-danger error-text judul_materi_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi Materi</label>
                            <textarea class="form-control" name="deskripsi" maxlength="1000" rows="4"
                                form="upload-file"> </textarea>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">URL Video</label>
                            <textarea class="form-control" name="url" maxlength="1000" rows="4"> </textarea>
                            <span class="text-danger error-text url_error"></span>
                        </div>

                        <input type="file" name="_file" id="_file" style="margin-bottom:15px;" class="form-control">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah Materi</button>
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
                    <h4 class="modal-title">Tambah Tugas</h4>
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
                            <select id="id" name="id" class="form-control">
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
                            <input type="text" class="form-control" name="judul_tugas" maxlength="250">
                            <span class="text-danger error-text judul_tugas_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi Tugas</label>
                            <!-- <input type="text" class="form-control" name="deskripsi" maxlength="10000"> -->
                            <textarea class="form-control" name="deskripsi" maxlength="1000" rows="4"
                                form="upload-tugas"> </textarea>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Waktu Mulai Pengumpulan</label>
                            <input type="datetime-local" class="form-control" name="wmp">
                            <span class="text-danger error-text wmp_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Waktu Akhir Pengumpulan</label>
                            <input type="datetime-local" class="form-control" name="wap">
                            <span class="text-danger error-text wap_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Waktu Cut-Off Pengumpulan</label>
                            <input type="datetime-local" class="form-control" name="wcp">
                            <span class="text-danger error-text wcp_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Ukuran File Kumpul Tugas</label>
                            <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="size" id="s25" value="25">
                                    <label class="form-check-label" for="25mb">25 MB</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="size" id="s50" value="50">
                                    <label class="form-check-label" for="50mb">50 MB</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="size" id="s100" value="100">
                                    <label class="form-check-label" for="100mb">100 MB</label>
                                </div>
                            <br>
                            <span class="text-danger error-text size_error"></span>
                        </div>

                        <input type="file" name="_file" id="_file" style="margin-bottom:15px;" class="form-control">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah Tugas</button>
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
                            <input type="text" class="form-control" name="materi" required maxlength="250">
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
        </div>
    </div>

    @foreach($course as $item)
    <div class="card col-13 mb-0">
        <div class="card">
            <div class="card-header blue2 mb-0">
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

            <div class="card-body col-13 card-outline card-primary mb-0 ml-3 px-0">
                <div class="card-header pt-0 ">

                    <h3 class="card-title">{{$datas->judul_materi}}</h3>
                    <a href="/deletemateri/{{  $datas->id_materi }}" title="Delete"
                        class="btn-sm btn-danger btn float-right"
                        onclick="return confirm('Are you sure to delete this data ?')">
                        <i class="fa fa-trash"></i> Hapus Materi
                    </a>
                </div>
                <div class="card-body cold1 col-13 mb-0">
        @if (!empty($datas->namafile_materi))
                    <?php
                $pecah = explode(".", $datas->namafile_materi);
                $ekstensi = $pecah[1];
            ?>
                    @if ($ekstensi == 'zip' or $ekstensi == 'rar')
                    <i class="fa fa-file-zip-o mr-2" style="font-size:23px;color:gray"> </i>

                    @elseif ($ekstensi == 'docx' or $ekstensi == 'doc')
                    <i class="fa fa-file-word-o mr-2" style="font-size:23px;color:blue"></i>

                    @elseif ($ekstensi == 'pdf')
                    <i class="fa fa-file-pdf-o mr-2" style="font-size:23px;color:red"></i>

                    @elseif ($ekstensi == 'ppt' or $ekstensi == 'pptx')
                    <i class="fa fa-file-powerpoint-o mr-2" style="font-size:23px;color:orange"></i>


                    @elseif ($ekstensi == 'jpg' or $ekstensi == 'png' or $ekstensi == 'jpeg')
                    <i class="fa fa-file-photo-o mr-2" style="font-size:23px;color:green"></i>

                    @elseif ($ekstensi == 'html')
                    <i class="fa fa-file-code-o mr-2" style="font-size:23px;color:green"></i>

                    @else
                    <i class="fa fa-file-text-o mr-2" style="font-size:23px;color:black"> </i>
                    @endif

                    <a href="{{route('download', $datas->namafile_materi)}}">{{$datas->namafile_materi}}</a>
                </div>
                @if($datas->deskripsi_file != null)
                <div class="card-footer">
                    <p>{{$datas->deskripsi_file}}</p>
                </div>
                @endif

            @endif
                @if($datas->url != null)
                <div class="card-footer">
                    <x-embed url="{{$datas->url}}"/>
                @endif

            </div>
            @endif
            @endforeach
            <br>
            @foreach($data_tugas as $datas)
            @if($datas->id_pertemuan == $item->id_pertemuan)

            <div class="card-body col-13 card-outline card-warning mb-0 ml-3 px-0">
                <div class="card-header pt-0">
                  
                    <a href="javascript:void(0)" style="text-decoration: none; color:tomato" class="edittugas" data-id="{{ $datas->id_wadahtugas }}">
                        <h4 class="card-title">  <b> 
                             {{$datas->judul_tugas}} </b>
                        </h4>
                    </a>

                    <a href="/deletetugas/{{  $datas->id_wadahtugas }}" title="Delete"
                        class="btn-sm btn-danger btn float-right"
                        onclick="return confirm('Are you sure to delete this data ?')">
                        <i class="fa fa-trash"></i> Hapus Tugas
                    </a>
                </div>

<div class="modal fade" id="edit-tugas">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Tugas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-tugas" action="{{ route('updateTugas') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                       <input type="text" class="form-control" name="id" id="id_wadahtugas" hidden>

                        <input type="text" class="form-control" name="id_pertemuan" id="id_pertemuan" hidden>

                        <div class="form-group">
                            <label for="">Judul Tugas</label>
                            <input type="text" class="form-control" name="judul_tugas" maxlength="250" id="judul_tugas">
                            <span class="text-danger error-text judul_tugas_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi Tugas</label>
                            <textarea class="form-control" name="deskripsi" maxlength="1000" rows="4" id="deskripsi"></textarea>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Waktu Mulai Pengumpulan</label>
                            <input type="datetime-local" class="form-control" name="wmp" id="wmp" value="{{$datas->waktu_mulai->toDatetimelocalString()}}">
                            <span class="text-danger error-text wmp_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Waktu Akhir Pengumpulan</label>
                            <input type="datetime-local" class="form-control" name="wap" id="wap">
                            <span class="text-danger error-text wap_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Waktu Cut-Off Pengumpulan</label>
                                @if (!empty($datas->waktu_cutoff))
                                    <input type="datetime-local" class="form-control" name="wcp" id="wcp" value="{{$datas->waktu_cutoff->toDatetimelocalString()}}">
                                @else
                                    <input type="datetime-local" class="form-control" name="wcp" id="wcp">
                                @endif
                            <span class="text-danger error-text wcp_error"></span>
                        </div>

                        <input type="file" name="_file" id="_file" style="margin-bottom:15px;" class="form-control">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Edit Tugas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
                @if (!empty($datas->file_tugas))
                <div class="card-body beee">
                    <a href="{{route('download', $datas->file_tugas)}}">{{$datas->file_tugas}}</a>
                </div>
                @endif
                @if($datas->deskripsi_tugas != null)
                <div class="card-footer">
                    <p>{{$datas->deskripsi_tugas}}</p>
                </div>
                @endif
            </div>
            @endif
            @endforeach

            <div class="card-footer blue1">
            @if (!empty($item->deskripsi))
                <textarea class="form-control" readonly
                    style="border-style: none; border-color: Transparent; overflow: auto;" rows="5">{{$item->deskripsi}}</textarea>
                <br>
            @endif
            <a href="javascript:void(0)" class="btn hijau3 panjang1 float-right editPertemuan" data-id="{{ $item->id_pertemuan }}">
                <i class="fas fa-edit">Edit Pertemuan</i>
            </a>
            </div>
        </div>
    </div>
    <br>
    @endforeach

        <div class="modal fade" id="edit-pertemuan" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <input class="form-control" name="id" id="idcek" readonly hidden>
                            </div>

                            <div class="form-group">
                                <label for="">Nama Pertemuan / Pertemuan Ke</label>
                                <input type="text" class="form-control" id="pertemuancek"
                                    name="nama_pertemuan">
                                <span class="text-danger error-text nama_pertemuan_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="">Materi Pembahasan</label>
                                <textarea class="form-control" placeholder="Masukkan Deskripsi" name="deskripsi"
                                    maxlength="1000" rows="5" id="isi"> </textarea>
                                <span class="text-danger error-text deskripsi_error"></span>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="edit-pertemuan" class="btn btn-primary">Edit Pertemuan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
@endsection
