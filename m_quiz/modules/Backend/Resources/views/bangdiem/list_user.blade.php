@extends('backend::layouts.master')
@section('title', 'Bảng điểm bài thi')
@section('type', 'Môn học')
@section('title1')
	Bảng điểm - {{ $baithi->monhocs->ten_mon_hoc }} - {{ $baithi['ten_bai_thi'] }}
@stop
@section('content')
	<div class="col-md-12">
		<div class="col-md-6">
			<a href="{{ Route('diem.excel', [$baithi['id']]) }}"
				class="btn-sm btn-primary">
				<i class="fa fa-file-excel-o" aria-hidden="true"></i>
					In bảng điểm
			</a>
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
					<tr class="success">
						<th>STT</th>
						<th>Học viên</th>
						<th>Điểm</th>
				</thead>
				<tbody>
					@if($baithi['user_id'] == Auth::user()->id)
						<?php $stt = 0; ?>
						@forelse($hocvien_baithi as $hv_bt)
							<?php $stt = $stt + 1; ?>
							<tr>
								<td>{{ $stt }}</td>
								<td><a href="{{ Route('diem.chi-tiet', [$baithi['id'],$hv_bt['id'], 'page'=>Request::get('page',1)]) }}">
										{{ $hv_bt->users->name }}
									</a>
								</td>
								<td>{{ $hv_bt['so_cau_dung'] }}/{{ $baithi['so_cau_hoi'] }}</td>
							</tr>
						@empty
							<tr>
								<td colspan="3" class="text-center">
									<p>Chưa có ai thi !</p>
								</td>
							</tr>
						@endforelse
					@else
						<tr>
							<td colspan="3" class="text-center">
								<p>Chưa có ai thi !</p>
							</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
@stop