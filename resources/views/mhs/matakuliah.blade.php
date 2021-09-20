@extends('mhs.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
<!-- Content Wrapper. Contains page content -->

@if(!empty($course[0]->id_praktikum))
<div class="content">

    @foreach($course as $item)
    <div class="card col-12">

            <div class="card-header blue2">
                <h3 class="card-title">{{$item->nama_pertemuan}}</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

            </div>

            @foreach($data as $datas)
            @if($datas->id_pertemuan == $item->id_pertemuan)
            <div class="card-body">
                <div class="card-header cold4 ">
                    {{$datas->judul_materi}}
                </div>
                <div class="card-body cold1">
                    <a href="{{route('download', $datas->namafile_materi)}}">{{$datas->namafile_materi}}</a>
                </div>
                <div class="card-footer">
                    <p>{{$datas->deskripsi_file}}</p>
                </div>
                @if($datas->deskripsi_file != null)
                <div class="card-footer">
                    <p>{{$datas->deskripsi_file}}</p>
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
</div>
@endif
@endsection
