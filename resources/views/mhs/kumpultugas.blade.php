@extends('mhs.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
@if(!empty($assign[0]))
    @if ($assign[0]->namafile_tugas && ($assign[0]->id_wadahtugas == $data[0]->id_wadahtugas))

    @if (session()->has('success'))

        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>{{ session()->get('success') }}</strong><br>
        </div>
    @endif
            <div class="col-12 row-3">
                <div class="card ml-3 ">
                    <div class="card-header" style="background-color: aliceblue;">
                        <div class="row mt-">
                            <h2 class="card-title">Submission</h2>
                        </div>

                    </div>

                </div>

                <div class="card ml-3 pb-1" style="background-color: #E8F6EF;">

                    <div class="row">

                        <!-- ./col -->
                        <div class="col-sm ml-5 mt-3 mb-3">

                            <h5>Nama Mata Kuliah</h5>
                            <b>{{$mk[0]->nama_praktikum}}</b>

                        </div>

                        <div class="col-sm mt-3">
                            <!-- small box -->


                            <h5>Nama Dosen</h5>
                            @foreach ($nama_dosen as $nama)
                            <b>{{$nama->nama_user}}<br></b>
                            @endforeach

                        </div>
                        <!-- ./col -->
                        <div class="col-sm mt-3">

                            <h5>Nama Asisten</h5>
                            @foreach ($nama_asisten as $nama)
                            <b>{{$nama->nama_user}}<br></b>
                            @endforeach

                        </div>
                        <!-- ./col -->

                        <!-- ./col -->


                    </div>

                </div>
            </div>

            <div class="col-12">

                <div class="card ml-3 ">
                    <div class="card-header" style="background-color: aliceblue;">
                        <div class="row mt-">
                            <h2 class="card-title"> Deskripsi tugas</h2>
                        </div>
                        <div class="row mt-3">
                            <p class="card-title">
                                {{$data[0]->deskripsi_tugas}}
                            </p>
                        </div>

                    </div>
                    <!-- /.card-header -->


                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <tbody>
                                <tr>
                                    <th>Due date</th>
                                    <td>{{ date('l, j F Y H:i', strtotime($data[0]->waktu_selesai)) }}</td>
                                </tr>
                                <tr>
                                    <th>Grading status</th>
                                    <td>
                                        @if (!empty($nilai->nilai))
                                        {{$nilai->nilai}}/100
                                    @else
                                        Not graded
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Deskripsi Penilaian</th>
                                    <td>
                                        <textarea class="form-control" name="komentar" maxlength="1000" rows="4" readonly>{{$nilai->komentar}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Time remaining</th>
                                    <td>
                                        @if (Carbon\Carbon::parse($data[0]->waktu_selesai) > Carbon\Carbon::parse($assign[0]->waktu_submit))      
                                            Assignment was submitted <b style="color:rgb(64, 228, 64)">{{str_replace([' after', ' before', 'd', 'h', 'm', 'sec'], [' late', ' early', ' days', ' hours', ' mins', ' secs'], $data[0]->waktu_selesai->diffForHumans($assign[0]->waktu_submit, ['short'=> true, 'parts' => 3]))}}</b>
                                        @else
                                            Assignment was submitted <b style="color: rgb(209, 22, 22)">{{str_replace([' after', ' before', 'd', 'h', 'm', 'sec'], [' late', ' early', ' days', ' hours', ' mins', ' secs'], $assign[0]->waktu_submit->diffForHumans($data[0]->waktu_selesai, ['short'=> true, 'parts' => 3]))}}</b>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>FILE</th>
                                    <td>
                                        <div class="custom-file">
                                            @foreach ($assign as $file)
                                            <?php
                                                
                                                $pecah = explode(".", $file->namafile_tugas);
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
                                             
                                            
                                        <a style="text-decoration: none; color:indianred" id="cek"  href="{{route('download', $file->namafile_tugas)}}"> 
                                           {{  $file->namafile_tugas }}   
                                            <br>                                     
                                        </a>
                                        
                                        @endforeach
                                         {{ date('j F Y, H:i', strtotime($assign[0]->waktu_submit)) }}
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <th>Aksi</th>
                                    <td>
                                        <a href="/deletesubmission/{{  $assign[0]->id_tugas }}" title="Delete" class="btn btn-danger btn"
                                            onclick="return confirm('Are you sure to delete this data ?')">
                                            <i class="fa fa-trash"></i> Remove Submission
                                        </a>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            </div>
    @endif
@else

@if (!(Carbon\Carbon::now() < $data[0]->waktu_mulai))

<div class="col-12 row-3">
    <div class="card ml-3 ">
        <div class="card-header" style="background-color: aliceblue;">
            <div class="row mt-">
                <h2 class="card-title">Submission</h2>
            </div>

        </div>

    </div>

    <div class="card ml-3 pb-1" style="background-color: #E8F6EF;">

        <div class="row">

            <!-- ./col -->
            <div class="col-sm ml-3 mt-3 mb-3">

                <h5>Nama Mata Kuliah</h5>
                <b>{{$mk[0]->nama_praktikum}}</b>

            </div>

            <div class="col-sm mt-3">
                <!-- small box -->


                <h5>Nama Dosen</h5>
                @foreach ($nama_dosen as $nama)
                <b>{{$nama->nama_user}}<br></b>
                @endforeach


            </div>
            <!-- ./col -->
            <div class="col-sm mt-3">

                <h5>Nama Asisten</h5>
                @foreach ($nama_asisten as $nama)
                <b>{{$nama->nama_user}}<br></b>
                @endforeach

            </div>
            <!-- ./col -->

            <!-- ./col -->


        </div>

    </div>
</div>

<div class="col-12">

    <div class="card ml-3 ">
        <div class="card-header" style="background-color: aliceblue;">
            <div class="row mt-">
                <h2 class="card-title"><b> Deskripsi tugas </b></h2>
            </div>
            <div class="row mt-3">
                <p class="card-title">
                    {{$data[0]->deskripsi_tugas}}
                </p>
            </div>
        </div>
        
        <tr>
            <th><a class="ml-2 mt-3"><b>Due date</b></a></th>
            <td><a class="ml-2 mt-3"><b>{{ date('l, j F Y H:i', strtotime($data[0]->waktu_selesai)) }}</b></a></td>
        </tr>
        <tr>
            @if (!empty(Carbon\Carbon::parse($data[0]->waktu_cutoff)))
                @if (Carbon\Carbon::now() < Carbon\Carbon::parse($data[0]->waktu_cutoff))
            <th> <a class="ml-2 mt-3"><b>FILE</b></a></th>
            <td>
                <form id="kumpul-tugas" action="{{ route('assignment') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" class="form-control" name="id" value="{{$mk[0]->id_praktikum}}" readonly>

                    <input type="hidden" class="form-control" name="id_user" value="{{ Auth::user()->id }}" readonly>

                    <input type="hidden" class="form-control" name="id_wadahtugas" value="{{$data[0]->id_wadahtugas}}" readonly>
                
                         
                    <input type="file" name="_file[]" class="form-control" id="_file" multiple>
                    <br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
            
            <?php
                                $size = 0; 
                                
                                if($data[0]->size == 25000){
                                    $size = 25;
                                }
                                elseif ($data[0]->size == 50000) {
                                    $size = 50;
                                }
                                elseif ($data[0]->size == 100000) {
                                    $size = 100;
                                }
                            ?>
                             <h6>Batas Ukuran File {{$size}} mb</h6>
                          
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('mhsMatkul', [$mk[0]->nama_praktikum]) }}'">Back</button>
                            <button type="submit" class="btn btn-primary">Upload Tugas</button>
                        </div>
                    @endif
                @else
                <th> <a class="ml-2 mt-3"><b>FILE</b></a></th>
            <td>
                <form id="kumpul-tugas" action="{{ route('assignment') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" class="form-control" name="id" value="{{$mk[0]->id_praktikum}}" readonly>

                    <input type="hidden" class="form-control" name="id_user" value="{{ Auth::user()->id }}" readonly>

                    <input type="hidden" class="form-control" name="id_wadahtugas" value="{{$data[0]->id_wadahtugas}}" readonly>
                     <div class="custom-file">
                        <input type="file" name="_file[]" class="custom-file-input" id="file" multiple>
                        <br>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('mhsMatkul', [$mk[0]->nama_praktikum]) }}'">Back</button>
                        <button type="submit" class="btn btn-primary">Upload Tugas</button>
                    </div>
                @endif
                   
                </form>
            </td>
        </tr>
    </div>
</div>

@else
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>
                    Sorry</h1>
                <h2>
                    Waktu Pengumpulan Tugas Belum Dibuka untuk Sekarang</h2>
                <div class="error-details">
                    Pengumpulan Tugas Bisa dimulai dari tanggal {{date('j F Y', strtotime($data[0]->waktu_mulai))}} pukul {{date('H:i', strtotime($data[0]->waktu_mulai))}}
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endif
@endsection
