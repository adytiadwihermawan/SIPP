@extends('asist.dashboard')
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")
@section('title', "Dashboard Asisten")

@section('content')
    <div class="row ml-2">
		@foreach ($course as $matkul)
		<div class="col-lg-4 col-6">
			<!-- small box -->
			
			<div class="small-box beedark">
				<div class="inner">
				
					<h5>{{ $matkul->nama_praktikum }}</h5>
				
	
					<div class="inner">
						<h6>Tahun Ajaran {{ $matkul->tahun_ajaran}}</h6>
					</div>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
			<a href="/asist/matkul/{{$matkul->nama_praktikum}}" class="small-box-footer bg-secondary">Selengkapnya
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
			
		</div>
		<div class="container fixed-bottom mr-0">
		<a class="btn bg-info float-right pb-3" href="{{asset('assets/file/Panduan Dosen Asisten.docx')}}" download="panduan dosen">
  <i class="fas fa-address-book"></i> Panduan pengguna
                </a>
    </div>
		@endforeach
@endsection
