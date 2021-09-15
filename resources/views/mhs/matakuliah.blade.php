@extends('mhs.dashboard')
@section('title', '')

@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
        <h1 style="text-align: center; font-size:x-large;">
          Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat</h1>
          <br>
    <!-- /.content-header -->
  @if($course)

    <div class="card card-primary ml-2">
      <div class="card-header">
        <h3 class="card-title"> 

            {{$course[0]->nama_praktikum}}
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
          @if($data)
            @foreach($data as $data)
              @if($data->id_pertemuan == $item->id_pertemuan)
              <h6>
                <a href="{{route('download', $data->namafile_materi)}}" style="color:coral">{{$data->namafile_materi}}</a>
              </h6>
                
                  @if($data->deskripsi_file != null)
                    <div class="card-footer"><p>{{$data->deskripsi_file}}</p>
                    </div>
                  @endif
              @endif
            @endforeach
          @else
            <h6>BLM ADA PERTEMUAN YANG DIBUAT</h6>
          </div>
          
          @endif 
        </div>
          
            </div>
          <div class="card-footer">
            {{$item->deskripsi}}
          </div>
      </section>
        </div>
        @endforeach
  @else
        <div class="card">
            ANJAY
          </div>
  @endif
  </div>

@endsection
