@extends('backend::layouts.master')

@section('title', 'Môn học - Câu hỏi')
@section('type', 'Môn học')
@section('title1')
  Danh sách câu hỏi - môn: {{ $monhoc['ten_mon_hoc'] }}
@stop
@section('content')
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="col-sm-3 ">
				<a href="{{ Route('backend.choose', [$monhoc['id'], 'page'=>Request::get('page',1)]) }}" 
					class="btn-sm btn-primary">
					<i class="fa fa-reply" aria-hidden="true"></i>
					 Quay Lại
				</a>
			</div>
			<div class="col-sm-3 ">
				<a href="javascript:;" class="btn-sm btn-warning new">
					<i class="fa fa-plus" aria-hidden="true"></i>
						Thêm Mới
				</a>
			</div>
			<div class="col-sm-3 ">
				<a href="{{ Route('backend.mon-hoc.list-bai-thi', [$monhoc['id'],'page'=>Request::get('page', 1)]) }}" 
					class="btn-sm btn-info">
					<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
						Bài Thi
				</a>
			</div>
		</div>
		<div class="col-md-6">
			<form method="get" action="" class="form-horizontal">
			    <div class="form-group">			    
			    	<div class="col-sm-8">
				      <input type="text" class="form-control" value="{{Request::get('keyword', '')}}" name="keyword" placeholder="Tìm kiếm">
				    </div>
				    <div class="col-sm-4">
				        <button type="submit" class="btn btn-default">Tìm kiếm</button>
				    </div>
			  </div>
			</form>
		</div>
	</div>
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr  class="success">
						<th>STT</th>
						<th>Nội dung câu hỏi</th>
						<th>Created_at</th>
						<th class="text-center">Hành Động</th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0; ?>
					@if(isset($cauhois) && count($cauhois) != 0 )
						@foreach($cauhois as $cauhoi)
							<?php $stt = $stt + 1; ?>
							<tr>
								<td>{{ $stt }}</td>
								<td><a href="{{ Route('backend.mon-hoc.edit-cau-hoi',[$monhoc['id'], $cauhoi['id'], 'page'=>Request::get('page',1)]) }}">
										{{ $cauhoi['noi_dung_cau_hoi'] }}
									</a>
								</td>
								<td>{{ $cauhoi['created_at'] }}</td>
								<td class="text-center">
								<?php
									if(count($cauhoi->baithis) > 0)
									{
										$baithis = $cauhoi->baithis;
										foreach($baithis as $baithi)
										{
											if(Carbon\Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon\Carbon::now())
											{
												$a = "disabled";
											}
											else{
												$a = "";
											}
										}
									}
									else{
										$a = "";
									}
								?>
									<a href="javascript:;" class="btn-sm btn-danger delete {{ $a }}" 
									dataId="{{$cauhoi->id}}">
										<i class=" fa fa-trash-o" aria-hidden="true"></i> 
										Xóa
									</a>
								</td>
							</tr>
						@endforeach
						{{ $cauhois->links() }}
					@else
						<tr>
							<td colspan="4">
								<p class="text-center">Không có câu hỏi nào của môn học này.</p>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
@endsection()
@section('modal')
<!-- Modal New Cau hoi -->
<div id="newModal" class="modal fade bs-example-modal-sm" tabindex="-1" 
	role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thêm mới câu hỏi môn: <b><i>{{ $monhoc['ten_mon_hoc'] }}</i></b></h4>
    </div>
    <form method="post" action="{{Route('backend.mon-hoc.new-cau-hoi', $monhoc['id'])}}" class="form-horizontal">
        {{csrf_field()}}

        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Nội dung câu hỏi:</label>
	        	<textarea name="noi_dung_cau_hoi" placeholder="Nội dung câu hỏi ..." class="form-control"></textarea>
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
	    				<input type="checkbox" style="opacity:1;" name="noi_dung_dap_an[1][]" value="1" class="form-control">
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
        <input type="hidden" value="{{Request::get('page', 1)}}" name="page" />
        <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Thêm mới</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        </div>
    </form>
    </div>
  </div>
</div>
<!-- End Modal New Cau hoi-->

<!-- Modal xóa câu hỏi-->

<div id="deleteModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Xóa</h4>
      </div>
      <form method="post" action="{{Route('backend.mon-hoc.delete-cau-hoi', [$monhoc['id'], 'page'=>Request::get('page',1)])}}">
         {{csrf_field()}}
         <p>Bạn có muốn xóa câu hỏi này không?</p>
         <input type="hidden" value="{{ $monhoc['id'] }}" name="mon_hoc_id"/>
         <input type="hidden" value="0" id="cau_hoi_id" name="cau_hoi_id" />
         <input type="hidden" value="{{Request::get('page', 1)}}" name="page" />
         <div class="modal-footer">
         <button type="submit" class="btn btn-danger">Xóa</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
         </div>
      </form>
    </div>
  </div>
</div>

<!-- End modal xóa câu hỏi -->
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
		$('.delete').click(function(){
            $('#cau_hoi_id').val($(this).attr('dataId'));
            $('#deleteModal').modal({'show': true});
        });
    });
//-->
</script>
@endsection()