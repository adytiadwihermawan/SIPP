@extends('mhs.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
<!-- Content Wrapper. Contains page content -->


<div class="content">

    @if(empty($course[0]->id_praktikum))
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>
                        Oops!</h1>
                    <h2>
                        Belum Ada Pertemuan untuk Mata Kuliah Sekarang</h2>
                    <div class="error-details">
                        Mohon menunggu sampai dosen atau asisten kelas membuat pertemuan untuk mata kuliah ini
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card blue1 ml-2">
        <div class="card-header">
            <h3 class="card-title">
                <b> {{$mk[0]->nama_praktikum}} </b>
            </h3>

        </div>
    </div>

    @foreach($course as $item)
    <div class="card col-13">

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

        <div class="card-body col-13 card-outline card-primary mb-0 ml-3 px-0">
            <div class="card-header pt-0">
                <h3 class="card-title">{{$datas->judul_materi}}</h3>
            
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

        <div class="card-body col-13 card-outline card-wawrning mb-0 ml-3 px-0">
            <div class="card-header pt-0 ">
                <a href="{{route('tugas', [$item->id_pertemuan])}}"><h3 class="card-title">{{$datas->judul_tugas}}</h3></a>
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

        <div class="card-footer blue1">
            {{$item->deskripsi}}
        </div>
    </div>
    @endforeach
    @endif
</div>

@endsection
