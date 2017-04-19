@extends('backend::layouts.master')
@section('title', 'Danh sách môn học')
@section('type', 'Môn học')
@section('title1')
  Danh sách môn học
@stop
@section('content')
	<div class="col-md-12">
		<div class="col-md-6">
			<form method="post" class="form-horizontal" 
			action="{{ Route('backend.new-mon-hoc') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<div class="col-sm-8">
						<input type="text" class="form-control" name="ten_mon_hoc" placeholder="Tên môn học"/>
					</div>
					<div class="col-sm-4">
						<input type="submit" class="btn btn-warning" value="Thêm mới" name="ok"/>
					</div>
				</div>
			</form>
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
			{{ $monhocs->links() }}
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr  class="success">
						<th>STT</th>
						<th>Tên Môn Học</th>
						<th>Hành Động</th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0; ?>
					@forelse($monhocs as $monhoc)
					<?php $stt = $stt + 1; ?>
						<tr>
							<td>{{ $stt }}</td>
							<td><a href="{{ Route('backend.bang-diem.bai-thi', [$monhoc['id'], 'page'=>Request::get('page',1)]) }}">
									{{ $monhoc['ten_mon_hoc'] }}
								</a>
							</td>
							<td>
								<div class="col-sm-3">
									<a href="{{ Route('backend.edit-mon-hoc', [$monhoc->id, 'page'=>Request::get('page', 1)]) }}" 
										class="btn-sm btn-primary">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
										Sửa
									</a>
								</div>
								<div class="col-sm-3">
									<a href="javascript:;" class="btn-sm btn-danger delete" dataId="{{$monhoc->id}}">
										<i class=" fa fa-trash-o" aria-hidden="true"></i> 
										Xóa
									</a>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4">
								<p class="text-center">Không có môn học nào.</p>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
			{{ $monhocs->links() }}
		</div>
	</div>
@endsection()
@section('modal')
<div id="deleteModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Xóa</h4>
      </div>
      <form method="post" action="{{Route('backend.delete-mon-hoc')}}">
         {{csrf_field()}}
         <p>Bạn có muốn xóa môn học này không?</p>
         <input type="hidden" value="0" id="mon_hoc_id" name="id" />
         <input type="hidden" value="{{Request::get('page', 1)}}" name="page" />
         <div class="modal-footer">
         <button type="submit" class="btn btn-danger">Xóa</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
         </div>
      </form>
    </div>
  </div>
</div>
@endsection()

@section('script')
<script type="text/javascript">
<!--
    $(document).ready(function(){
        $('.delete').click(function(){
            $('#mon_hoc_id').val($(this).attr('dataId'));
            $('#deleteModal').modal({'show': true});
        });
    });
//-->
</script>
@endsection()