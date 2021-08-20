@extends('dsn.dashboard')
@section('title', '')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 ml-5 ">
         
            <h1 class="m-0" style="text-align: center; font-size:x-large;">
              Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat</h1>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card card-primary ml-2">
      <div class="card-header">
        <h3 class="card-title">
          @foreach ($course as $item)
            {{$item->nama_praktikum}}
          @endforeach
        </h3>
      </div>
    <!-- Main content -->
    <section class="content mt-3">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
          <!-- Default box -->

      <div class="card card-lightblue">
        <div class="card-header">
          <h3 class="card-title">Pertemuan 1</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
         <a href="mahasiswa-contohmateri.pdf" target="_blank">Materi 2</a>  
        
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
              <i class="fa fa-plus">&nbsp;Add an activity or resource</i> 
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
            <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
              <h3 class="text-center mb-5">Upload File</h3>
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
    
                <div class="custom-file">
                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                    <label class="custom-file-label" for="chooseFile">Select file</label>
                </div>

                <div class="modal-footer">
                  <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                    Upload Files
                </button>
                </div>
            </form>
    
            </div>
            </div>
          </div>
          </div>
          <!-- end Modal -->
        <!-- /.card-body -->
        <div class="card-footer">
          Deskripsi
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

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection