@extends('admin.dashboard')
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")
@section('title', "Dashboard Admin")


@section('content')
<div class="row">
	<div class="col-lg-3">
		<!-- small box -->
		<div class="small-box army4">
			<div class="inner">
				<h3>
					{{ DB::table("users")->count() }}
				</h3>

				<p>Jumlah User</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="/datauser" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3">
		<!-- small box -->
		<div class="small-box army2">
			<div class="inner">
				<h3>
					{{ DB::table("praktikum")->count() }}
				</h3>

				<p>Jumlah Kelas</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="/datakelas" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3">
		<!-- small box -->
		<div class="small-box army1 ">
			<div class="inner">
				<h3>
					{{ DB::table("lab")->count() }}
				</h3>

				<p>Jumlah Laboratorium</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="/datalab" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3">
		<!-- small box -->
		<div class="small-box army2">
			<div class="inner">
				<h3>
					<i class="fas fa-user"></i>
				</h3>

				<p>Buka perekrutan Asisten</p>
			</div>
	
			<a href="/openrekrutasist" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
</div>

<div class="container fixed-bottom mr-0">
  <a class="btn bg-info float-right pb-3" href="{{asset('assets/file/Panduan Admin.docx')}}" download="panduan admin">
  <i class="fas fa-address-book"></i> Panduan pengguna
                </a>
    </div>
	<!-- ./col -->
	
@endsection