@extends('asist.dashboard')
@section('title', '')

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
          @forelse ($course as $item)
            {{$item->nama_praktikum}}
            @break
            @empty
            <p>s</p>
          @endforelse
        </h3>
      </div>
      @for($i = 0; $i<$item->id_praktikum; $i++)   
      @if ($item->id_praktikum != null)
      <!-- Main content -->
      <section class="content mt-3">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
            <!-- Default box -->

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
              <p>llll{{ $item->id_materi}}</p>
          </div>

              {{-- <div class="card-body">
                <div id="dropzone">
                  <form class="dropzone needsclick" id="demo-upload" action="" enctype="multipart/form-data">
                  @csrf
                    <div class="dz-message needsclick">    
                      Drop files here or click to upload.<br>
                      <span class="note needsclick">(This is just a demo dropzone. Selected 
                      files are <strong>not</strong> actually uploaded.)</span>
                    </div>
                  </form>
                </div>
              </div> --}}
            <div class="card-body">
              <button type="button" style="float: right" class="btn btn-primary" data-toggle="modal" data-target="#addmateri">
                Upload Materi
              </button>
            </div>
              
          </div>
          <!-- Modal -->
          <div class="modal fade" id="addmateri" tabindex="-1" role="dialog" aria-labelledby="addmateriLabel" aria-hidden="true">
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
                          <input type="file" name="_file" id="_file" style="margin-bottom:15px;" class="form-control">
                          <button type="submit" style="float:right; margin-bottom:15px;"class="btn btn-success">Upload</button>
                    </div>
                  </div>
                </div>

              </div>
              </div>
            </div>
            </div>
            <!-- end Modal -->
          <!-- /.card-body -->
          <div class="card-footer">
            {{$item->deskripsi}}
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
            <!-- ./col -->
    </div>
          <!-- /.row -->
          <!-- Main row -->
        <!-- /.modal -->

        
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      @else
<!-- /.content -->
      @endif  
      @endfor
  </div>
  <!-- /.content-wrapper -->
@endsection