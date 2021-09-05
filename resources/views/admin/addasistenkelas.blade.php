@extends('admin.dashboard')
@section('title', "Tambah Asisten Kelas")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Tambah Asisten Kelas/h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">

					<form id="addasisten" action="addasisten" method="post">
						@csrf
                        <div class="form-group">
							<label for="">Kelas</label> 
							<select id="kelas" name="kelas" value="{{ old('kelas')}}">
								<option value="" selected></option>
								@foreach ($kelas as $value)
								<option value="{{$value->id_praktikum}}" >{{$value->nama_praktikum}}</option>
								@endforeach
							</select>
						</div>
						
						<div class="form-group">
							<label for="">Peserta Kelas</label>
							<select id="peserta" name="peserta" value="{{ old('peserta')}}">
								<option value="" selected></option>
								@foreach ($member as $id => $name)
								<option value="{{$id}}" >{{ $name}}</option>
								@endforeach
							</select>
							<span style="color:red">@error('peserta') {{ $message }} @enderror</span>
						</div>		
                    
						<div class="form-group">
							<label for="">Role</label>
							<select id="role" name="role" value="{{ old('role') }}">
								<option value="3" selected>asisten</option>
							</select>
							<span style="color:red">@error('role') {{ $message }} @enderror</span>
						</div>					
						
		</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datakelas">Back</a></button>
						<button type="submit" class="btn btn-primary">Tambah Asisten Kelas</button>
					</div>
					</form>
	</div>				
</div>

@endsection