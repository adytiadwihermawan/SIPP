@extends('mhs.dashboard')
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")
@section('title', "Dashboard Mahasiswa")

@section('content')
    <div class="row">
	@foreach ($course as $matkul)
	<div class="col-lg-4">
		<!-- small box -->
		
		<div class="small-box cold3">
			<div class="inner">
			
				<h5>{{ $matkul->nama_praktikum }}</h5>
			

				<p>{{$matkul->tahun_ajaran}}</p>
			
			</div>
			<div class="icon mb-4">
                <i class="fas fa-desktop"></i>
              </div>
		
			<a href="/matkul/{{$matkul->id_praktikum}}" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="container fixed-bottom mr-0">

  <a class="btn bg-info float-right pb-3" href="{{asset('assets/file/Panduan Mahasiswa.docx')}}" download="panduan mahasiswa">
  <i class="fas fa-address-book"></i> Panduan pengguna
                </a>
    </div>
	@endforeach
@endsection
