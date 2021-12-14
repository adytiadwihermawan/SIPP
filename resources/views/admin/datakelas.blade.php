@extends('admin.dashboard')
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")
@section('title', "Data Kelas")
@section('content')

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data Kelas</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <button type="button" class="btn btn-primary" onclick="window.location.href='/tambahkelas'">
                    <i class="fa fa-edit"></i> Tambah Kelas </button>

                <button type="button" class="btn blue4h float-left py-1 mr-3" title="Import Peserta Kelas"
                    data-toggle="modal" data-target="#modal-import">
                    <i class="fa fa-plus"></i> Import Peserta Kelas</button>



                <div class="modal fade" id="modal-import">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import Peserta Kelas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="import-peserta" action="{{ route('file-import-peserta') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                                        <input type="file" name="file" class="form-control" id="customFile">
                                        <span class="text-danger error-text file_error"></span>

                                    </div>

                                    <button type="button" class="btn">

                                        <i class="fa fa-book"></i> <a
                                            href="{{asset('assets/file/template add peserta kelas.xlsx')}}"
                                            download="Template Tambah Peserta Kelas">
                                            Download Template Excel</a>
                                    </button>
                                    <button class="btn btn-primary float-right">Import data</button>
                                </form>
                            </div>

                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.content -->
                </div>
            </div>
            <br>
            <table id="datakelas" class="table table-bordered table-striped">
                <thead>
                    <tr style="text-align: center;">
                        <th>No</th>
                        <th>Id Kelas</th>
                        <th>Nama Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
            @endsection
