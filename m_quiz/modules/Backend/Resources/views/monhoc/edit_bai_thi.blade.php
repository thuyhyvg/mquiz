@extends('backend::layouts.master')

@section('title', 'Môn học - Sửa Bài Thi')
@section('type', 'Môn học')
@section('title1')
  Chỉnh sửa bài thi của môn: {{ $monhoc['ten_mon_hoc'] }}
@stop
@section('content')
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="col-sm-3 ">
				<a href="{{ Route('backend.mon-hoc.list-bai-thi', [$monhoc['id'], 'page'=>Request::get('page',1)]) }}" 
					class="btn-sm btn-primary">
					<i class="fa fa-reply" aria-hidden="true"></i>
					 Quay Lại
				</a>
			</div>
		</div>
		<form method="post" class="form-horizontal" 
			action="{{ Route('backend.mon-hoc.save_edit-bai-thi', [$monhoc['id'], $baithi['id'], 'page'=>Request::get('page',1)]) }}">
			{{csrf_field()}}
			<div class="form-group">
	        	<div class="col-sm-10 col-sm-offset-1">
		        	<label class="control-label">Tên bài thi:</label>
		        	<input type="text" class="form-control" name="ten_bai_thi" placeholder="Tên bài thi" 
		        	value="{{ old('ten_bai_thi', $baithi['ten_bai_thi']) }}">
		        </div>
	        </div>
	        <div class="form-group">
	        	<div class="col-sm-10 col-sm-offset-1">
		        	<label class="control-label">Ngày thi:</label>
		        	<input type="datetime-local" class="form-control" name="ngay_thi" placeholder="Ngày thi"
		        	value="<?php echo date('Y-m-d\TH:i:s', strtotime($baithi['ngay_thi'])); ?>">
		        </div>
	        </div>
	        <div class="form-group">
	        	<div class="col-sm-10 col-sm-offset-1">
		        	<label class="control-label">Thời gian (phút):</label>
		        	<input type="number" class="form-control" name="thoi_gian" placeholder="Thời gian (phút)"
		        	value="{{ $baithi['thoi_gian'] }}">
		        </div>
	        </div>
	        <div class="form-group">
	        	<div class="col-sm-10 col-sm-offset-1">
		        	<label class="control-label">Số câu hỏi:</label>
		        	<input type="number" class="form-control" name="so_cau_hoi" placeholder="Số câu hỏi"
		        	value="{{ $baithi['so_cau_hoi'] }}">
		        </div>
	        </div>
	        <div class="form-group">
	        	<div class="col-sm-10 col-sm-offset-1">
		        	<label class="col-sm-1 control-label">Khóa:</label>
		        	<div class="col-sm-1">
		        		<input type="checkbox" value="1" class="form-control" name="khoa"
		        		<?php if($baithi['khoa'] == 1) echo "checked"; ?>>
		        	</div>
		        </div>
	        </div>
	        <button type="submit" class="btn btn-warning">Chỉnh sửa</button>
		</form>
	</div>
@endsection()