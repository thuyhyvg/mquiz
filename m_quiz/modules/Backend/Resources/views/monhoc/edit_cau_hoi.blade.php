@extends('backend::layouts.master')

@section('title', 'Môn học - Câu hỏi')
@section('type', 'Môn học')
@section('title1')
  Chỉnh sửa câu hỏi của môn: {{ $monhoc['ten_mon_hoc'] }}
@stop
@section('content')
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="col-sm-3 ">
				<a href="{{ Route('backend.mon-hoc.list-cau-hoi', [$monhoc['id'], 'page'=>Request::get('page',1)]) }}" 
					class="btn-sm btn-primary">
					<i class="fa fa-reply" aria-hidden="true"></i>
					 Quay Lại
				</a>
			</div>
		</div>
	<form method="post" class="form-horizontal" action="{{ Route('backend.mon-hoc.edit-cau-hoi', [$monhoc['id'], $cauhoi['id'], 'page'=>Request::get('page',1)]) }}">
		{{csrf_field()}}

        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Nội dung câu hỏi:</label>
	        	<textarea name="noi_dung_cau_hoi" placeholder="Nội dung câu hỏi ..." class="form-control">{{ $cauhoi['noi_dung_cau_hoi'] }}</textarea>
	        </div>
        </div>
        <?php $stt = 0; ?>
        @if(isset($dapans))
	        @foreach($dapans as $da)
	        	<div id="insert">
			    	<div class="form-group">
			        	<div class="col-sm-10 col-sm-offset-1">
			        		<label class="col-sm-2 control-label">Câu trả lời: </label>
			        		<div class="col-sm-9">
			        			<input type="text" cauhoi="1" name="noi_dung_dap_an[{{ $da['id'] }}][]" 
			        				placeholder="Nội dung đáp án" class="form-control"
			        				value="{{ $da['noi_dung_dap_an'] }}">
			        		</div>
			        		<div class="col-sm-1">
			    				<input type="checkbox" name="noi_dung_dap_an[{{ $da['id'] }}][]" value="1" 
			    				class="form-control" style="opacity:1;" <?php if($da['dung_sai'] == 1){ echo "checked";} ?>>
			    			</div>
			        	</div>
			    	</div>
			    </div>
		    	
		    @endforeach

		@else
			<div id="insert">
	    		<div class="form-group">
		        	<div class="col-sm-10 col-sm-offset-1">
		        		<label class="col-sm-2 control-label">Câu trả lời: </label>
		        		<div class="col-sm-9">
		        			<input type="text" cauhoi="1" name="noi_dung_dap_an[1][]" placeholder="Nội dung đáp án" class="form-control">
		        		</div>
		        		<div class="col-sm-1">
		    				<input type="checkbox" style="opacity:1;" name="noi_dung_dap_an[1][]" value="1" class="form-control">
		    			</div>
		        	</div>
	        	</div>
	    	</div>
	    	
		@endif
		<div class="form-group">
	    	<div class="col-sm-10 col-sm-offset-1">
	    		<button type="button" class="btn btn-primary" id="add">
	    			<i class="fa fa-plus" aria-hidden="true"></i>
	    				Add
	    		</button>
	    	</div>
	    </div>
		<div class="form-group pull-right col-sm-6">
			<button type="submit" class="btn btn-warning">Chỉnh sửa</button>
			<a href="{{ Route('backend.mon-hoc.list-cau-hoi', [$monhoc['id'], 'page'=>Request::get('page',1)]) }}" 
				class="btn btn-default">
				 Hủy
			</a>
		</div>
	</form>
</div>
@endsection()
@section('script')
<script type="text/javascript">
<!--
    $(document).ready(function(){
    	$('.new').click(function(){
            $('#newModal').modal({'show': true});
        });
    	$("#add").click(function(){
        	var newAnswerId = parseInt($("#insert input[type = 'text']").last().attr('cauhoi')) + 1;
			$("#insert").append('<div class="form-group"><div class="col-sm-10 col-sm-offset-1"><label class="col-sm-2 control-label">Câu trả lời: </label><div class="col-sm-9"><input type="text" cauhoi="' + newAnswerId + '" name="noi_dung_dap_an[' + newAnswerId + '][]" placeholder="Nội dung đáp án" class="form-control"></div><div class="col-sm-1"><input type="checkbox" style="opacity:1;" name="noi_dung_dap_an[' + newAnswerId + '][]" value="1" class="form-control"></div></div></div>');
		});
    });
//-->
</script>
@endsection()