@extends('admin.dashboard')
@section('title', "Edit Data Lab")
@section('content')
<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Edit Data Lab</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">

					
					@if(Session::get('gagal'))
					<hr>
						<div class="alert alert-danger">
							{{ Session::get('gagal')  }}
						</div>
					@endif

					<form id="editlab" action="/updatelab" method="post">
						
						@csrf
							<div class="form-group">
								<label for="">Id Laboratorium</label>
								<input type="text" class="form-control" name="id" value="{{ old('id', $Info[0]->id_laboratorium) }}" readonly>
							</div>

							<div class="form-group">
								<label for="">Nama Laboratorium</label>
								<input type="text" class="form-control" name="nama_lab" value="{{ old('nama_lab', $Info[0]->nama_laboratorium) }}">
								<span style="color:red">@error('nama_lab') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Kepala Laboratorium</label>
								<select id="id_kepala" name="kepalalab" value="">                              
									@foreach ($user as $item)
                                    <option value="{{ $item->id}}" {{ $Info[0]->id_kepalalaboratorium == $item->id ? 'selected' : ''}}>{{ $item->nama_user }}</option>
                                    @endforeach
								</select>
								<span style="color:red">@error('kepalalab') {{ $message }} @enderror</span>
							</div>
						
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><a style="color: white;" href="/datalab">Kembali</a></button>
						<button type="submit" class="btn btn-primary">Edit Data Lab</button>
					</div>
					</form>
			</div>

@endsection