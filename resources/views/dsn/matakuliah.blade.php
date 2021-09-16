@extends('dsn.dashboard-mk')
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
            <button type="button" class="btn blue4 float-right" style="float:right; padding:1px 4px;" title="Buat Pertemuan" data-toggle="modal" data-target="#modal-pertemuan">
				<i class="fa fa-plus"></i> Tambah Pertemuan</button>
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
                       <div class="row mb-5 mx-auto">
                <div class="col-sm">
                  <button type="button" class="btn hijau panjang2 " data-toggle="modal" data-target="#addmateri"> <i class="fas fa-plus"></i> Tambah Materi </button>
                </div>
                       </div>
                    </div>
                
                        @if($data[0]->id_pertemuan == $item->id_pertemuan)
                        @foreach($data as $datas)


                        <div class="card col-13 mx-auto">
                            <div class="card-header cold4">
                                <b>Nama Materi</b>
                            </div>
                            <div class="card-body cold1">
                                <a href="{{route('download', $datas->namafile_materi)}}">{{$datas->namafile_materi}}</a>
                                @if($datas->deskripsi_file)
                                <div class="card-footer">
                                    <p>{{$datas->deskripsi_file}}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @endif
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
