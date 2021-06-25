@extends('dsn.dashboard')
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")
@section('title', "Dashboard Dosen")

@section('content')
    <div class="row">
		@foreach ($course as $matkul)
		<div class="col-lg-3 col-6">
			<!-- small box -->
			
			<div class="small-box bg-warning">
				<div class="inner">
				
					<h5>{{ $matkul->nama_praktikum }}</h5>
				
	
					<p>Jumlah Peserta: {{$matkul->where('id_praktikum', '=', $matkul->id_praktikum)->count()}}</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="{{url($matkul->id_praktikum)}}" class="{{ request()->is($matkul->id_praktikum) ? 'nav-link active' : 'nav-link' }}" class="small-box-footer">Selengkapnya
					<i class="fas fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		@endforeach
@endsection
