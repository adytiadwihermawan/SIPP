@extends('dsn.dashboard-mk')
@section('title', "Grade")
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')

<table class="table table-striped hover" id="grade">
  <div class="modal fade" id="nilai">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nilai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="nilai-tugas" action="{{ route('nilaiTugas') }}" method="POST">
                        @csrf

                        <input id="id" name="id" type="text" hidden>

                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="number" class="form-control" name="nilai" min="0" max="100" required>
                            <span class="text-danger error-text nilai_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Komen Tugas</label>
                            <!-- <input type="text" class="form-control" name="deskripsi" maxlength="10000"> -->
                            <textarea class="form-control" name="komentar" maxlength="1000" rows="4" placeholder="Isikan Komentar"> </textarea>
                            <span class="text-danger error-text deskripsi_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Beri Nilai</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="edit-nilai">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Nilai</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-nilai" action="{{ route('updateNilai') }}" method="POST">
                        @csrf

                        <input id="id_tugas" name="id" type="text" hidden>

                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="number" class="form-control" id="nilaitugas" name="nilai" min="0" max="100">
                            <span class="text-danger error-text nilai_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Komen Tugas</label>
                            <!-- <input type="text" class="form-control" name="deskripsi" maxlength="10000"> -->
                            <textarea class="form-control" id="komentar" name="komentar" maxlength="1000" rows="4" placeholder="Isikan Komentar"> </textarea>
                            <span class="text-danger error-text komentar_error"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Nilai</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

            <thead>
                <tr style="text-align: center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Grade</th>
                    <th>Komentar</th>
                    <th>file submission</th>
                    <th>Time submission</th>
                    <th>Aksi</th>
                </tr>
            </thead>
</table>

@endsection