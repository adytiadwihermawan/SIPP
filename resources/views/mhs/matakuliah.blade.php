@extends('mhs.dashboard-mk')
@section('title', $mk[0]->nama_praktikum)
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')

<!-- Content Wrapper. Contains page content -->
@if(!empty($course[0]->id_praktikum))

<div class="content">
    <div class="card card-primary ml-2">
        <div class="card-header">
            <h3 class="card-title">
                {{$mk[0]->nama_praktikum}}
            </h3>
        </div>
    </div>
    @foreach($course as $item)

    <?php 
      $total = $item->where('id_praktikum', '=', $item->id_praktikum)->get();
    ?>
    <div class="card card-primary ml-2">
        <section class="content mt-3">
            <div class="container-fluid">

                <div class="card card-lightblue">
                    <div class="card-header">
                        <h3 class="card-title">{{$item->nama_pertemuan}}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- @if($data[0]->id_pertemuan == $item->id_pertemuan) --}}
                        @foreach($data as $datas)
                        <h6>
                            <a href="{{route('download', $datas->namafile_materi)}}"
                                style="color:coral">{{$datas->namafile_materi}}</a>
                        </h6>

                        @if(!empty($data->deskripsi_file))
                        <div class="card-footer">
                            <p>{{$datas->deskripsi_file}}</p>
                        </div>
                        @endif
                        @endforeach
                        {{-- @endif --}}
                    </div>
                </div>
                <div class="card-footer">
                    {{$item->deskripsi}}
                </div>
        </section>
    </div>
    @endforeach
</div>
@endif
@endsection
