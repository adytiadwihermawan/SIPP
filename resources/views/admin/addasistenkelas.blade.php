@extends('admin.dashboard')
@section('title', "Tambah Asisten Kelas")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Asisten Kelas {{$data->nama_praktikum}}</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive mb-5">
			
					<form id="addasisten" action="/addasisten" method="post">
						@csrf

			<div class="table table-borderless">
						<table>
							<input type="hidden" name="id" value="{{$data->id_praktikum}}" readonly>
						<tr>
							<td><label for="">Asisten Praktikum</label> </td>
							<td><select  class="form-control ml-5 mb-3 selectpicker"  data-live-search="true" id="peserta" name="peserta" value="{{ old('peserta')}}" >
								<option value="" selected></option>
								@foreach ($member as $id => $name)
								<option value="{{$id}}" >{{ $name}}</option>
								@endforeach
							</select> </td>
							<span style="color:red">@error('peserta') {{ $message }} @enderror</span>
						</tr>
                    
						<tr>
							<!-- <td><label for="">Role</label></td> -->
							<td><select  class="form-control ml-5" id="role" name="role" value="{{ old('role') }}"  style="width: 25vw;" hidden>
								<option value="3" selected>asisten</option>
							</select> </td>
							<span style="color:red;">@error('role') {{ $message }} @enderror</span>
						</tr>	
						</table>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datakelas">Back</a></button>
						<button type="submit" class="btn btn-primary">Tambah Asisten Kelas</button>
					</div>
			</div>
				</form>
		
	@if (!empty($data->id_praktikum))
		
			<table id="asistenkelas" class="table table-bordered table-striped">
				<thead>
					<tr style="text-align: center;">
					<th>NO</th>
                    <th>NIM/NIP</th>
                    <th>NAMA</th>
					<th>AKSI</th>
					</tr>
				</thead>
			</table>
	@endif
	</div>				
</div>

@endsection