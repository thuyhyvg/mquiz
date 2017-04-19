@extends('backend::layouts.master')
@section('title', 'Bảng điểm môn học')
@section('type', 'Môn học')
@section('title1')
	Bảng điểm - {{ $monhoc['ten_mon_hoc'] }}
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
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr class="success">
						<th>STT</th>
						<th>Bài Thi</th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0; ?>
					@forelse($baithis as $baithi)
						<?php $stt = $stt + 1; ?>
						<tr>
							<td>{{ $stt }}</td>
							<td><a href="{{ Route('diem.list-user', [$baithi['id'], 'page'=>Request::get('page',1)]) }}">
									{{ $baithi['ten_bai_thi'] }}
								</a>
							</td>
						</tr>
					@empty
						<tr>
							<td class="text-center" colspan="2">
								<p>Chưa có ai thi !</p>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
@stop