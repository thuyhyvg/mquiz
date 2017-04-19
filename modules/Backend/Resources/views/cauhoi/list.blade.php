@extends('backend::layouts.master')
@section('title', 'Danh sách câu hỏi')
@section('type', 'Câu hỏi')
@section('title1')
  Danh sách câu hỏi
@stop
@section('content')
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="col-sm-3">
				<a href="{{ Route('backend.new-cau-hoi') }}" class="btn-sm btn-warning">
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
			{{ $cauhois->links() }}
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr  class="success">
						<th>STT</th>
						<th>Tên Câu Hỏi</th>
						<th>Môn học</th>
						<th class="text-center">Hành Động</th>
					</tr>
				</thead>
				<tbody>
          @if(count($cauhois) > 0)
            <?php $stt = 0; ?>
            @foreach($cauhois as $cauhoi)
                <?php $stt = $stt + 1;?>
                <tr>
                    <td>{{ $stt }}</td>
                    <td>
                        <a href="{{ Route('backend.cau-hoi.edit-cau-hoi',
                            [$cauhoi['id'], 'page'=>Request::get('page',1)]) }}">
                            {{ $cauhoi['noi_dung_cau_hoi'] }}
                        </a>
                    </td>
                    <td>{{ $cauhoi->monhocs->ten_mon_hoc }}</td>
                    <td class="text-center">
                        <a href="javascript:;" class="btn-sm btn-danger delete" dataId="{{$cauhoi->id}}">
                            <i class=" fa fa-trash-o" aria-hidden="true"></i>
                            Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
          @else
            <tr>
              <td colspan="4" class="text-center">
                <p>Không có câu hỏi nào !</p>
              </td>
            </tr>
          @endif
				</tbody>
			</table>
			{{ $cauhois->links() }}
		</div>
	</div>
@stop
@section('modal')
<!-- Start Modal delete Câu hỏi -->

<div id="deleteModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Xóa</h4>
      </div>
      <form method="post" action="{{ Route('backend.delete-cau-hoi', ['page'=>Request::get('page',1)]) }}">
         {{csrf_field()}}
         <p>Bạn có muốn xóa câu hỏi này không?</p>
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

<!-- End modal delete câu hỏi -->
@endsection()

@section('script')
<script type="text/javascript">
<!--
    $(document).ready(function(){
        $('.delete').click(function(){
            $('#cau_hoi_id').val($(this).attr('dataId'));
            $('#deleteModal').modal({'show': true});
        });
    });
//-->
</script>
@endsection()