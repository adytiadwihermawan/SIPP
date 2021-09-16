@extends('dsn.dashboard-mk')
@section('title', "{{$course[0]->nama_praktikum}}")

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
        <h1 style="text-align: center; font-size:x-large;">
          Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat</h1>
          <br>
    <!-- /.content-header -->
    <div class="card card-primary ml-2">
      <div class="card-header">
        <h3 class="card-title">
            {{$course[0]->nama_praktikum}}
        </h3>
        <button type="button" class="btn hijau float-right" style=" padding:1px 4px;" title="Buat Pertemuan" data-toggle="modal" data-target="#modal-pertemuan">
				<i class="fa fa-plus"></i> Tambah Pertemuan</button>
        
      </div>
    </div>

    <div class="col-12 mb-3ss  ">
          <button type="button" class="btn cold4h panjang1 float-right mb-3" data-toggle="modal" data-target="#modal-presensi"> <i class="fas fa-plus"></i> Buat Presensi </button>
        </div>


       <div class="card col-12 card-primary ml-2">
     
      @foreach($course as $item)  
    <?php 
      $total = $item->where('id_praktikum', '=', $item->id_praktikum)->get();
    ?>
      {{-- @if ($total) --}}
      <!-- Main content -->
    
        
          <!-- Small boxes (Stat box) -->
            <!-- Default box -->

        <div class="card"> 
          <div class="card-header cold3">
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
                
      <!-- Modal -->
          <div class="modal fade" id="addmateri">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addpesertaLabel">Upload Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
                
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <form action="{{ route('fileUpload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($message = Session::get('success'))
                          <div class="alert alert-success">
                              <strong>{{ $message }}</strong>
                          </div>
                        @endif
              
                        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif
                          <input type="text" class="form-control" name="id_pertemuan" value="{{ old('id', $item->id_pertemuan)}}" readonly>
                          <input type="file" name="_file" id="_file" style="margin-bottom:15px;" class="form-control">
                          <button type="submit" style="float:right; margin-bottom:15px;"class="btn btn-success">Upload</button>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
              </div>
            </div>

     

       <div class="modal fade" id="modal-presensi">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Buat Absen</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
        <form action=" {{ route('absen') }}" method="POST">					
						@csrf

             @if ($message = Session::get('success'))
                          <div class="alert alert-success">
                              <strong>{{ $message }}</strong>
                          </div>
                        @endif
              
                        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif
							<div class="form-group">
								<label for="">Pertemuan</label>
								<input type="number" class="form-control" name="id" >
								<span style="color:red">@error('id') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Tanggal</label>
								<input type="date" class="form-control" name="tanggal" >
								<span style="color:red">@error('tanggal') {{ $message }} @enderror</span>
							</div>

              <div class="form-group">
								<label for="">Materi</label>
								<input type="text" class="form-control" name="materi" >
								<span style="color:red">@error('materi') {{ $message }} @enderror</span>
							</div>

              <div class="form-group">
								<label for="">Waktu Mulai Presensi</label>
								<input type="datetime-local" class="form-control" name="wmp" >
								<span style="color:red">@error('wmp') {{ $message }} @enderror</span>
							</div>
						
            <div class="form-group">
								<label for="">Waktu Akhir Presensi</label>
								<input type="datetime-local" class="form-control" name="wap" >
								<span style="color:red">@error('wap') {{ $message }} @enderror</span>
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


                <div class="col-sm">
                  <button type="button" class="btn hijau3 panjang2 " data-toggle="modal" data-target="#"> <i class="fas fa-plus"></i> Edit Pertemuan </button>
                </div>

                
            </div>
          
            @foreach($datas as $data)
              @if($data->id_pertemuan == $item->id_pertemuan)

              
              <div class="card">
  <div class="card-header cold2">
    <b>Nama Materi</b>
  </div>
  <div class="card-body">
  <a href="{{route('download', $data->namafile_materi)}}" style="color:coral">{{$data->namafile_materi}}</a>
  </div>
</div>
             
                
                  @if($data->deskripsi_file != null)
                    <div class="card-footer"><p>{{$data->deskripsi_file}}</p>
                    </div>
                  @endif
              @endif
            @endforeach
          </div> 
        
          
          <div class="card-footer biru">
            {{$item->deskripsi}}
          </div>
        </div>
        
        

        @endforeach
        </div>
    </div>

      <div class="modal fade" id="modal-pertemuan">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Buat Pertemuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
      <div class="modal-body">
        <form action= "{{ route('pertemuan') }}" method="POST">
          @csrf
              <div class="form-group">
								<label for="">Mata Kuliah</label>
								<input type="text" class="form-control" name="id" value="{{$course[0]->id_praktikum}}" readonly>
								<span style="color:red">@error('id') {{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label for="">Pertemuan Ke</label>
								<input type="text" class="form-control" placeholder="Contoh: Pertemuan 1" name="nama_pertemuan" required>
								<span style="color:red">@error('nama_pertemuan') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Materi Pembahasan</label>
								<input type="text" class="form-control" placeholder="Contoh: Cara Menggunakan Framework Laravel" name="deskripsi" required>
								<span style="color:red">@error('deskripsi') {{ $message }} @enderror</span>
							</div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Buat Pertemuan</button>
              </div>
				</form>
      </div>
              
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<!-- /.content -->
      </section>
  </div>

  @endsection