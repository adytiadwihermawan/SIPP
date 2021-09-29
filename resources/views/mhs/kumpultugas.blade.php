@extends('mhs.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
@if($assign)
    @if ($assign->namafile_tugas && $assign->id_wadahtugas == $data[0]->id_wadahtugas)

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
                            <b>{{$nama->nama_user}}</b>
                            @endforeach

                        </div>
                        <!-- ./col -->
                        <div class="col-sm mt-3">

                            <h5>Nama Asisten</h5>
                            @foreach ($nama_asisten as $nama)
                            <b>{{$nama->nama_user}}</b>
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
                                    <th>Grading status</th>
                                    <td>isi data 1</td>
                                </tr>
                                <tr>
                                    <th>Due date</th>
                                    <td>isi data 2</td>
                                </tr>
                                <tr>
                                    <th>Time remaining</th>
                                    <td>isi data 3</td>
                                </tr>
                                <tr>
                                    <th>Last modified</th>
                                    <td>isi data 4</td>
                                </tr>
                                <tr>
                                    <th>FILE</th>
                                    <td>
                                        <div class="custom-file">
                                        <a style="text-decoration: none; color:indianred"  href="{{route('download', $assign->namafile_tugas)}}"> {{$assign->namafile_tugas}}</a>
                                            {{$assign->waktu_submit->format('j F Y, H:i A')}}
                                        </div>
                                    </td>

                                </tr>
                                <tr>
                                    <th>Aksi</th>
                                    <td>
                                        <a href="" title="Edit" class="btn btn-success btn">
                                            <i class="fa fa-edit"></i> Edit Submission
                                        </a>
                                        <a href="/deletesubmission/{{  $assign->id_tugas }}" title="Delete" class="btn btn-danger btn"
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
                <b>{{$nama->nama_user}}</b>
                @endforeach

            </div>
            <!-- ./col -->
            <div class="col-sm mt-3">

                <h5>Nama Asisten</h5>
                @foreach ($nama_asisten as $nama)
                <b>{{$nama->nama_user}}</b>
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
            <th> <a class="ml-2 mt-3"><b>FILE</b></a></th>
            <td>
                <form id="kumpul-tugas" action="{{ route('assignment') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" class="form-control" name="id" value="{{$mk[0]->id_praktikum}}" readonly>

                    <input type="hidden" class="form-control" name="id_user" value="{{ Auth::user()->id }}" readonly>

                    <input type="hidden" class="form-control" name="id_wadahtugas" value="{{$data[0]->id_wadahtugas}}" readonly>

                    <div class="custom-file">
                        <input type="file" name="_file" class="custom-file-input" id="customFile" required>
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
