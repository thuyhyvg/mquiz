@extends('backend::layouts.master')

@section('title', 'Môn học - Bài thi')
@section('type', 'Môn học')
@section('title1')
  Danh sách bài thi - môn: {{ $monhoc['ten_mon_hoc'] }}
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
						Thêm mới
				</a>
			</div>
			<div class="col-sm-3 ">
				<a href="{{ Route('backend.mon-hoc.list-cau-hoi', [$monhoc['id'],'page'=>Request::get('page', 1)]) }}"
					class="btn-sm btn-info">
					<i class="fa fa-question" aria-hidden="true"></i>
						Câu Hỏi
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
						<th>Tên bài thi</th>
						<th>Ngày - Giờ thi</th>
						<th>Thời gian</th>
						<th>Số câu hỏi</th>
						<th>Khóa</th>
						<th class="text-center" colspan="2">Hành Động</th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 1; ?>
					@if(isset($baithis) && count($baithis) != 0)
						@foreach($baithis as $baithi)
							<?php $stt = $stt++; ?>
							<tr>
								<td>{{ $stt }}</td>
								<td>
									<a href="{{ Route('backend.mon-hoc.chon-bai-thi-cau-hoi', [$monhoc['id'], $baithi['id'], 'page'=>Request::get('page',1)]) }}">
										{{ $baithi['ten_bai_thi'] }}
									</a>
								</td>
								<td>{{ $baithi['ngay_thi'] }}</td>
								<td>{{ $baithi['thoi_gian'] }} Phút</td>
								<td>{{ $baithi['so_cau_hoi'] }}</td>
								<td>@if($baithi['khoa'] != 1) Đóng @else Mở @endif</td>
								<td>
								<?php if(Carbon\Carbon::createFromTimeStamp(strtotime($baithi['ngay_thi'])) < Carbon\Carbon::now())
								{
									$a = "disabled";
								}
								else{
									$a = "";
								}
								?>
									<a href="{{ Route('backend.mon-hoc.edit-bai-thi', [$monhoc->id, $baithi['id'], 'page'=>Request::get('page', 1)]) }}"
									class="btn-sm btn-primary <?php echo $a; ?>" >
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									 		Sửa
									</a>
								</td>
								<td><a href="javascript:;" class="btn-sm btn-danger delete <?php echo $a; ?>" dataId="{{$baithi->id}}">
										<i class=" fa fa-trash-o" aria-hidden="true"></i>
										 Xóa
									</a>
								</td>
							</tr>
						@endforeach
						{{ $baithis->links() }}
					@else
						<tr>
							<td colspan="7">
								<p class="text-center">Môn học này chưa có bài thi nào !</p>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
@endsection()

@section('modal')
<!-- Modal New Bài thi -->
<div id="newModal" class="modal fade bs-example-modal-sm" tabindex="-1"
	role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thêm mới bài thi môn: <b><i>{{ $monhoc['ten_mon_hoc'] }}</i></b></h4>
    </div>
    <form method="post" action="{{Route('backend.mon-hoc.new-bai-thi', $monhoc['id'])}}" class="form-horizontal">
        {{csrf_field()}}

        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Tên bài thi:</label>
	        	<input type="text" class="form-control" name="ten_bai_thi" placeholder="Tên bài thi"
	        	value="{{ old('ten_bai_thi') }}">
	        </div>
        </div>
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Ngày thi:</label>
	        	<input type="datetime-local" class="form-control" name="ngay_thi" placeholder="Ngày thi"
	        	min="<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date('Y-m-d\TH:i:s', time()) ?>">
	        </div>
        </div>
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Thời gian (phút):</label>
	        	<input type="number" class="form-control" name="thoi_gian" placeholder="Thời gian (phút)">
	        </div>
        </div>
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Số câu hỏi:</label>
	        	<input type="number" class="form-control" name="so_cau_hoi" placeholder="Số câu hỏi">
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
<!-- End modal new bài thi -->

<!-- Modal xóa bài thi -->

<div id="deleteModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Xóa</h4>
      </div>
      <form method="post" action="{{Route('backend.mon-hoc.delete-bai-thi', [$monhoc['id']])}}">
         {{csrf_field()}}
         <p>Bạn có muốn xóa bài thi này không?</p>
         <input type="hidden" value="0" id="bai_thi_id" name="bai_thi_id" />
         <input type="hidden" value="{{Request::get('page', 1)}}" name="page" />
         <div class="modal-footer">
         <button type="submit" class="btn btn-danger">Xóa</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
         </div>
      </form>
    </div>
  </div>
</div>

<!-- End modal xóa bài thi -->
@endsection()

@section('script')
<script type="text/javascript">
<!--
    $(document).ready(function(){
        $('.new').click(function(){
            $('#newModal').modal({'show': true});
        });
        $('.delete').click(function(){
            $('#bai_thi_id').val($(this).attr('dataId'));
            $('#deleteModal').modal({'show': true});
        });
    });
//-->
</script>
@endsection()