@extends('backend::layouts.master')
@section('title', 'Danh sách môn học')
@section('type', 'Môn học')
@section('title1')
  Danh sách môn học
@stop
@section('content')
	<div class="col-md-12">
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
						<th>Bảng điểm</th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0; ?>
					@forelse($monhocs as $monhoc)
					<?php $stt = $stt + 1; ?>
						<tr>
							<td>{{ $stt }}</td>
							<td><a href="{{ Route('backend.choose', [$monhoc->id, 'page'=>Request::get('page', 1)]) }}">
									{{ $monhoc['ten_mon_hoc'] }}
								</a>
							</td>
							<td>
								<a href="{{ Route('diem.bai-thi', [$monhoc['id'], 'page'=>Request::get('page',1)]) }}"
									class="btn-sm btn-primary">
										Bảng điểm
								</a>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="3">
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
