@extends('mhs.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
@if(!empty($assign[0]->id_tugas))
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

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae mi maximus, malesuada ligula
                    eget, tempus dui. Aenean pretium justo diam, id congue turpis tincidunt vitae. Duis blandit non nisi
                    in porttitor. Etiam varius finibus nulla, sit amet faucibus nunc sodales in. Vestibulum ante ipsum
                    primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam a leo et neque faucibus
                    convallis at et nisl. Aenean vulputate tempus venenatis. Class aptent taciti sociosqu ad litora
                    torquent per conubia nostra, per inceptos himenaeos. Curabitur lacus erat, pellentesque ac lacus sit
                    amet, semper condimentum ligula.
                </p>
            </div>

        </div>
        <!-- /.card-header -->


        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <tbody>
                    <tr>
                        <th>data 1</th>
                        <td>isi data 1</td>
                    </tr>
                    <tr>
                        <th>data 2</th>
                        <td>isi data 2</td>
                    </tr>
                    <tr>
                        <th>data 3</th>
                        <td>isi data 3</td>
                    </tr>
                    <tr>
                        <th>data 4</th>
                        <td>isi data 4</td>
                    </tr>
                    <tr>
                        <th>FILE</th>
                        <td>
                            <div class="custom-file">
                               <a href="{{route('download', $assign[0]->namafile_tugas)}}"> {{$assign[0]->namafile_tugas}} </a>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <th>Aksi</th>
                        <td>
                            <a href="" title="Edit" class="btn btn-success btn">
                                <i class="fa fa-edit"></i> Edit Submission
                            </a>
                            <a href="" title="Delete" class="btn btn-danger btn"
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
        <tr>
            <th>FILE</th>
            <td>
                <form id="kumpul-tugas" action="{{ route('assignment') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" class="form-control" name="id" value="{{$mk[0]->id_praktikum}}" readonly>

                    <input type="hidden" class="form-control" name="id_user" value="{{ Auth::user()->id }}" readonly>

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
