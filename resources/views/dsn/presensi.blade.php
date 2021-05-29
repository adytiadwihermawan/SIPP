@extends('dsn.dashboard')
@section('title', "Presensi")
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")

<style>
    #sheet-container {
       width: 250px;
       height: 100px;
       border: 1px solid black;
    }
</style>

@section('content')

<!-- Content Wrapper. Contains page content -->
    <!-- /.content-header -->
    <div class="card card-primary ml-2">
      <div class="card-header">
        <h3 class="card-title">Presensi</h3>
      </div>
    <!-- Main content -->
    <section class="content mt-3">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Presensi Praktikum</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Presensi<th></th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>Pemrograman Web
                    </td>
                    <td>senin</td>
                    <td> 08:00</td>
                    <td><button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#modal-buatpresensi">Buat Presensi</button></td>
                    <td><button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#modal-rekappresensi">Rekap Presensi</button></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Web Framework
                    </td>
                    <td>selasa</td>
                    <td> 08:00</td>
                    <td><button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#modal-buatpresensi">Buat Presensi</button></td>
                    <td><button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#modal-rekappresensi">Rekap Presensi</button></td>
                  </tr>
              
                  
                  </tbody>
            
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       <!-- /.modal -->

       <div class="modal fade" id="modal-buatpresensi">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Buat Pertemuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="addkelas" method="post">
					<div class="modal-body">
					
						@csrf
							<div class="form-group">
								<label for="">Pertemuan</label>
								<input type="number" class="form-control" name="nama_praktikum" >
								<span style="color:red">@error('nama_praktikum') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Tanggal</label>
								<input type="date" class="form-control" name="tahun_ajaran" >
								<span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
							</div>

                            <div class="form-group">
								<label for="">Materi</label>
								<input type="text" class="form-control" name="tahun_ajaran" >
								<span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
							</div>

                            <div class="form-group">
								<label for="">Waktu Mulai Presensi</label>
								<input type="time" class="form-control" name="tahun_ajaran" >
								<span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
							</div>
						
                            <div class="form-group">
								<label for="">Waktu Akhir Presensi</label>
								<input type="Time" class="form-control" name="tahun_ajaran" >
								<span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
							</div>
					</div>
                        
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Buat Presensi</button>
					</div>
					</form>
             </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      <div class="modal fade" id="modal-rekappresensi">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Rekap Pertemuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Pertemuan</th>
                  <th>Tanggal</th>
                  <th>Pengajar</th>
                  <th>Bahasan</th>
                  <th>Kehadiran</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>4 November
                  </td>
                  <td>Andreyan Rizky Baskara</td>
                  <td> 08:00</td>
                  <td><button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#modal-kehadiran">Kehadiran</button></td>
                </tr>
                
                
                </tbody>
          
              </table>   </div>
            <div class="modal-footer float-right">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modal-kehadiran">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Kehadiran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>Noviani
                  </td>
                  <td>1810817120014</td>
                  <td>Hadir</td>
                  </tr>
                
                
                </tbody>
          
              </table>   </div>
            <div class="modal-footer float-right">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  <!-- /.content-wrapper -->
  <footer class="main-footer">
@endsection

