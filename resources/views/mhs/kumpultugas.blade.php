@extends('mhs.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
@if(!empty($assign[0]))
    @if ($assign[0]->namafile_tugas && ($assign[0]->id_wadahtugas == $data[0]->id_wadahtugas))

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
                                            Assignment was submitted {{$data[0]->waktu_selesai}}
                                        @else
                                            Assignment was submitted {{$assign[0]->waktu_submit}}
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
            <th><a class="ml-2 mt-3"><b>Time Remaining</b></a></th>
            <td><a class="ml-2 mt-3" id="countdown">
            <b>
                <script>
				CountDownTimer('{{$data[0]->waktu_mulai}}', 'countdown');
				function CountDownTimer(dt, id)
				{
					var end = new Date('{{$data[0]->waktu_selesai}}');
					var _second = 1000;
					var _minute = _second * 60;
					var _hour = _minute * 60;
					var _day = _hour * 24;
					var timer;
					function showRemaining() {
						var now = new Date();
						var distance = end - now;
						if (distance < 0) {

							clearInterval(timer);
                            document.getElementById(id).innerHTML = hours + 'hrs ';
                            document.getElementById(id).innerHTML += minutes + 'mins ';
                            document.getElementById(id).innerHTML += seconds + 'secs';
							return;
						}
						var hours = Math.floor((distance % _day) / _hour);
						var minutes = Math.floor((distance % _hour) / _minute);
						var seconds = Math.floor((distance % _minute) / _second);

						document.getElementById(id).innerHTML = hours + 'hrs ';
						document.getElementById(id).innerHTML += minutes + 'mins ';
						document.getElementById(id).innerHTML += seconds + 'secs';
					}
					timer = showRemaining();
				}
			    </script>
            </b></a></td>
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
                
                         
                            <input type="file" name="_file[]" class="form-control" id="customFile" multiple required>
                            <span class="text-danger error-text _file_error"></span>
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
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('mhsMatkul', [$mk[0]->id_praktikum]) }}'">Back</button>
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
                        <input type="file" name="_file[]" class="custom-file-input" id="customFile" multiple required>
                        <span class="text-danger error-text _file_error"></span>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('mhsMatkul', [$mk[0]->id_praktikum]) }}'">Back</button>
                        <button type="submit" class="btn btn-primary">Upload Tugas</button>
                    </div>
                @endif
                   
                </form>
            </td>
        </tr>
    </div>
</div>
@endif
@endsection
