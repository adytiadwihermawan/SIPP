@extends('mhs.dashboard')
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
                <th>Presensi</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td>1</td>
                <td>MK1
                </td>
                <td>senin</td>
                <td> 08:00</td>
                <td><button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#modal-lg">Presensi</button></td>
              </tr>
              <tr>
                <td>2</td>
                <td>MK2
                </td>
                <td>selasa</td>
                <td> 08:00</td>
                <td><button type="button" class="btn btn-block btn-success " data-toggle="modal" data-target="#modal-lg">Presensi</button></td>
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

   <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Daftar Pertemuan</h4>
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
              <th>Presensi</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>2</td>
              <td>12 januari
              </td>
              <td>noviani</td>
              <td> 08:00</td>
              <td><button type="button" class="btn btn-block btn-success">Presensi</button></td>
            </tr>
            <tr>
              <td>2</td>
              <td>13 januari
              </td>
              <td>noviani</td>
              <td> 08:00</td>
              <td><button type="button" class="btn btn-block btn-success">Presensi</button></td>
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
@endsection