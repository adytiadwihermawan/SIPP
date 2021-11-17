@extends('mhs.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
@if(!empty($assign[0]))
    @if ($assign[0]->namafile_tugas && $assign[0]->id_wadahtugas == $data[0]->id_wadahtugas)

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
                                    <th>Time remaining</th>
                                    <td>
                                        <?php 
                                            $shortVariant = 'en_Short';
                                            $translator = Carbon\Translator::get($shortVariant);
                                            $translator->setTranslations([
                                                'h' => ':count hrs',
                                                'min' => ':count mins',
                                                's' => ':count secs'
                                            ]);
?>
                                        @if (Carbon\Carbon::parse($data[0]->waktu_selesai) > Carbon\Carbon::parse($assign[0]->waktu_submit))      
                                            Assignment was submitted {{str_replace(['after', 'before'], ['late', 'early'], $data[0]->waktu_selesai->locale($shortVariant)->diffForHumans($assign[0]->waktu_submit, ['short'=> true, 'parts' => 3]))}}
                                        @else
                                            Assignment was submitted {{str_replace(['after', 'before'], ['late', 'early'], $assign[0]->waktu_submit->locale($shortVariant)->diffForHumans($data[0]->waktu_selesai, ['short'=> true, 'parts' => 3]))}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>FILE</th>
                                    <td>
                                        <div class="custom-file">
                                            @foreach (explode(',', $assign) as $file)
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
                                            
                                            <?php $files = json_decode($file->namafile_tugas); ?>
                                        <a style="text-decoration: none; color:indianred"  href="{{route('download', $file->namafile_tugas)}}"> 
                                            {{-- {!!  $files->namafile_tugas !!}    --}}
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
            <th> <a class="ml-2 mt-3"><b>FILE</b></a></th>
            <td>
                <form id="kumpul-tugas" action="{{ route('assignment') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" class="form-control" name="id" value="{{$mk[0]->id_praktikum}}" readonly>

                    <input type="hidden" class="form-control" name="id_user" value="{{ Auth::user()->id }}" readonly>

                    <input type="hidden" class="form-control" name="id_wadahtugas" value="{{$data[0]->id_wadahtugas}}" readonly>
                   
                    <div class="custom-file">
                        <input type="file" name="_file[]" class="custom-file-input" id="customFile" multiple required>
                        <span class="text-danger error-text _file_error"></span>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('mhsMatkul', [$mk[0]->id_praktikum]) }}'">Back</button>
                        <button type="submit" class="btn btn-primary">Upload Tugas</button>
                    </div>
                </form>
            </td>
        </tr>
    </div>
</div>
@endif
@endsection
