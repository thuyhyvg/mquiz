@extends('backend::layouts.master')
@section('title', 'Thêm mới câu hỏi')
@section('type', 'Câu hỏi')
@section('title1')
  Thêm mới câu hỏi
@stop
@section('content')
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="col-sm-3 ">
				<a href="{{ Route('backend.cau-hoi', ['page'=>Request::get('page',1)]) }}" 
					class="btn-sm btn-primary">
					<i class="fa fa-reply" aria-hidden="true"></i>
					 Quay Lại
				</a>
			</div>
		</div>
		<form method="post" action="{{ Route('backend.new-cau-hoi') }}" class="form-horizontal">
        {{csrf_field()}}
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Môn học:</label>
	        	<select class="form-control" name="mon_hoc_id">
	        		<option value="">Hãy chọn 1 môn học</option>
	        		@foreach($monhocs as $monhoc)
				    	<option value="{{ $monhoc['id'] }}">{{ $monhoc['ten_mon_hoc'] }}</option>
				    @endforeach
				</select>
	        </div>
        </div>
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Nội dung câu hỏi:</label>
	        	<textarea id="text" name="noi_dung_cau_hoi" placeholder="Nội dung câu hỏi ..." class="form-control"></textarea>
	        </div>
        </div>
        
    	<div id="insert">
    		<div class="form-group">
	        	<div class="col-sm-10 col-sm-offset-1">
	        		<label class="col-sm-2 control-label">Câu trả lời: </label>
	        		<div class="col-sm-9">
	        			<input type="text" cauhoi="1" name="noi_dung_dap_an[1][]" placeholder="Nội dung đáp án" class="form-control">
	        		</div>
	        		<div class="col-sm-1">
	    				<input type="checkbox" name="noi_dung_dap_an[1][]" value="1" class="form-control" style="opacity:1;">
	    			</div>
	        	</div>
        	</div>
    	</div>
    	<div class="form-group">
	    	<div class="col-sm-10 col-sm-offset-1">
	    		<button type="button" class="btn btn-primary" id="add">
	    			<i class="fa fa-plus" aria-hidden="true"></i>
	    				Add
	    		</button>
	    	</div>
	    </div>
	    <div class="form-group pull-right col-sm-6">
	        <button type="submit" class="btn btn-warning">Thêm mới</button>
	        <a href="#" class="btn btn-default">Hủy</a>
	    </div>
    </div>
@endsection()
@section('script')
<script type="text/javascript">
<!--
    $(document).ready(function(){
    	$("#add").click(function(){
        	var newAnswerId = parseInt($("#insert input[type = 'text']").last().attr('cauhoi')) + 1;
			$("#insert").append('<div class="form-group"><div class="col-sm-10 col-sm-offset-1"><label class="col-sm-2 control-label">Câu trả lời: </label><div class="col-sm-9"><input type="text" cauhoi="' + newAnswerId + '" name="noi_dung_dap_an[' + newAnswerId + '][]" placeholder="Nội dung đáp án" class="form-control"></div><div class="col-sm-1"><input type="checkbox" style="opacity:1;" name="noi_dung_dap_an[' + newAnswerId + '][]" value="1" class="form-control"></div></div></div>');
		});
    });
//-->
</script>

@endsection()