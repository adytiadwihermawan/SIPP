@extends('asist.dashboard-mk')
@section('title', "Grade")
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')        
<table style="width: 80%" class="table table-striped hover" id="grade">
            <thead>
                <tr style="text-align: center">
                    <th>No</th>
                    <th>User picture</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Grade</th>
                    <th>Edit</th>
                    <th>file submission</th>
                </tr>
            </thead>
@if(!empty($grade[0]->id_tugas))
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

                        <input type="hidden" class="form-control" name="id_materi" value="{{$grade[0]->id_materi}}">

                        <input type="hidden" class="form-control" name="id_user" value="{{$grade[0]->id_user}}">

                        <div class="form-group">
                            <label for="">Nilai</label>
                            <input type="number" class="form-control" name="nilai" min="0" max="100">
                            <span class="text-danger error-text nilai_error"></span>
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
@endif
</table>

@endsection