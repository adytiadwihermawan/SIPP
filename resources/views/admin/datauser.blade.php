@extends('admin.dashboard')
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")
@section('title', "Data User")
@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data User</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">

            <div class="row mb-5">
                <div class="col-sm">
                    <button type="button" class="btn btn-primary" onclick="window.location.href='/tambahuser'">
                        <i class="fa fa-edit"></i> Tambah User </button>

                    <button type="button" class="btn blue4h" title="Buat Pertemuan" data-toggle="modal"
                        data-target="#modal-import">
                        <i class="fa fa-plus"></i> Import Data User</button>

                        </div>

                <div class="modal fade" id="modal-import">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import Data User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="import-user" action="{{ route('file-import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                                            <input type="file" name="file" class="form-control" id="customFile">
                                            <span class="text-danger error-text file_error"></span>
                                    </div>

                                    <button type="button" class="btn" >

                        <i class="fa fa-book"></i> <a href="{{asset('assets/file/tambah data user.xlsx')}}" download="Template Tambah User"> Download Template Excel</a> </button>
                                    <button onclick="reload()" class="btn btn-primary float-right">Import data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table id="datauser" class="table table-bordered table-striped">
                
                <thead>
                    <tr style="text-align: center;">
                        <th>NO</th>
                        <th>NIM/NIP</th>
                        <th>NAMA</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
            </table>
            @endsection
