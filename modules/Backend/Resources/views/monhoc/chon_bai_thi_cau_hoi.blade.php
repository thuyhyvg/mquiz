@extends('backend::layouts.master')

@section('title', 'Môn học - Câu hỏi')
@section('type', 'Môn học - Câu hỏi')
@section('title1')
  {{ $baithi['ten_bai_thi'] }} - môn: {{ $monhoc['ten_mon_hoc'] }}
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
					@if(isset($cauhois) && (count($cauhois) != 0))
					<form method="post" action="{{ Route('backend.mon-hoc.chon-bai-thi-cau-hoi', [$monhoc['id'], $baithi['id']]) }}" class="form-horizontal">
        				{{csrf_field()}}
        				<input type="submit" value="Lưu" name="ok" class="btn btn-primary">	
						@foreach($cauhois as $cauhoi)
							<?php $stt = $stt + 1; ?>
							<tr>
								<td>{{ $stt }}</td>
								<td><a href="{{ Route('backend.mon-hoc.edit-cau-hoi',[$monhoc['id'], $cauhoi['id'], 'page'=>Request::get('page',1)]) }}">
										{{ $cauhoi['noi_dung_cau_hoi'] }}
									</a>
								</td>
								<td>{{ $cauhoi['created_at'] }}</td>
								<td>
									{{--*/ $check = ($cauhoi->baithi_cauhoi->filter(function($v) use ($baithi){
										return $v->bai_thi_id == $baithi->id;
								})->count()) ? 'checked' : '' /*--}}

									<div class="col-sm-5 col-sm-offset-3">
										<input type="checkbox" name="cauhoi[]" class="form-control" value="{{ $cauhoi['id'] }}"
										{{ $check }}
										>
									</div>
								</td>
							</tr>
						@endforeach
						{{ $cauhois->links() }}
					</form>
					@else
						<tr>
							<td colspan="4">
								<p class="text-center">Không có câu hỏi nào !.</p>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
@stop


@section('script')
<script type="text/javascript">
<!--
    $(document).ready(function(){
        $('.new').click(function(){
            $('#newModal').modal({'show': true});
        });
        $("#add").click(function(){

        	var newAnswerId = parseInt($("#insert input[type = 'text']").last().attr('cauhoi')) + 1;
			$("#insert").append('<div class="form-group"><div class="col-sm-10 col-sm-offset-1"><label class="col-sm-2 control-label">Câu trả lời: </label><div class="col-sm-9"><input type="text" cauhoi="' + newAnswerId + '" name="noi_dung_dap_an[' + newAnswerId + '][]" placeholder="Nội dung đáp án" class="form-control"></div><div class="col-sm-1"><input type="checkbox" name="noi_dung_dap_an[' + newAnswerId + '][]" value="1" class="form-control"></div></div></div>');
		});
		$('.delete').click(function(){
            $('#cau_hoi_id').val($(this).attr('dataId'));
            $('#deleteModal').modal({'show': true});
        });
    });
//-->
</script>
@stop