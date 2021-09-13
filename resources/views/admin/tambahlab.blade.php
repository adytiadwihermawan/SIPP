@extends('admin.dashboard')
@section('title', "Tambah Peserta Kelas")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Tambah Peserta Kelas</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">

					<form id="addlab" action="addlab" method="post">
						@csrf
                        
						<table>

						<tr>
							<td><label for="">Nama Laboratorium</label></td>
							<td><input type="text" class="form-control" name="nama_lab" value="{{ old('nama_lab') }}"></td>
								<span style="color:red">@error('nama_lab') {{ $message }} @enderror</span>
						</tr>
                        <tr>
							<td><label for="">Nama Kepala Laboratorium</label></td>
							<td><select id="id" name="id" value="{{ old('id') }}" class="form-control ml-5" style="width: 25vw;">
                                    <option value="" selected></option>                                
									@foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_user }}</option>
                                    @endforeach
								</select>
								<span style="color:red">@error('id') {{ $message }} @enderror</span></td>
                        </tr>
						</table>				
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datalab">Kembali</a></button>
						<button type="submit" class="btn btn-primary">Tambah Laboratorium</button>
					</div>
					</form>
</div>
@endsection