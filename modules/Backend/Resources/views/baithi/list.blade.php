@extends('backend::layouts.master')
@section('title', 'Danh sách bài thi')
@section('type')
  Bài thi
@stop
@section('title1', 'Danh sách bài thi')
@section('content')

	<div class="col-md-12">
		<div class="col-md-6">
			<div class="col-sm-3">
				<a href="javascript:;" class="btn-sm btn-warning new">
          <i class="fa fa-plus" aria-hidden="true"></i>
            Thêm mới
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
			{{ $baithis->links() }}
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr  class="success">
						<th>STT</th>
						<th>Tên Bài Thi</th>
						<th>Môn học</th>
						<th class="text-center" colspan="2">Hành Động</th>
					</tr>
				</thead>
				<tbody>
          @if(count($baithis) > 0)
            <?php $stt = 0; ?>
            @foreach($baithis as $baithi)
                <?php $stt = $stt + 1;?>
                <tr>
                    <td>{{ $stt }}</td>
                    <td>
                        <a href="{{ Route('backend.bai-thi.chon-cau-hoi', [$baithi['id'], 'page'=>Request::get('page',1)]) }}">
                            {{ $baithi['ten_bai_thi'] }}
                        </a>
                    </td>
                    <td>{{ $baithi->monhocs->ten_mon_hoc }}</td>
                    <td><a href="{{ Route('backend.bai-thi.edit-bai-thi', [$baithi['id'], 'page'=>Request::get('page',1)]) }}" 
                      class="btn-sm btn-primary">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                       Sửa
                      </a>
                    </td>
                    <td class="text-center">
                        <a href="javascript:;" class="btn-sm btn-danger delete" dataId="{{$baithi->id}}">
                            <i class=" fa fa-trash-o" aria-hidden="true"></i>
                            Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
          @else
            <tr>
              <td colspan="4" class="text-center">
                <p>Không có bài thi nào !</p>
              </td>
            </tr>
          @endif
				</tbody>
			</table>
			{{ $baithis->links() }}
		</div>
	</div>
@stop
@section('modal')

<!-- Modal New Bài thi -->
<div id="newModal" class="modal fade bs-example-modal-sm" tabindex="-1" 
  role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thêm mới bài thi </h4>
    </div>
    <form method="post" action="{{ Route('backend.bai-thi.new-bai-thi', ['page'=>Request::get('page',1)]) }}" class="form-horizontal">
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
            <label class="control-label">Tên bài thi:</label>
            <input type="text" class="form-control" name="ten_bai_thi" placeholder="Tên bài thi" 
            value="{{ old('ten_bai_thi') }}">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-10 col-sm-offset-1">
            <label class="control-label">Ngày thi:</label>
            <input type="datetime-local" class="form-control" name="ngay_thi" placeholder="Ngày thi">
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
<!-- Start Modal delete Bài thi -->

<div id="deleteModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Xóa</h4>
      </div>
      <form method="post" action="{{ Route('backend.bai-thi.delete-bai-thi', ['page'=>Request::get('page',1)]) }}">
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

<!-- End modal delete câu hỏi -->
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