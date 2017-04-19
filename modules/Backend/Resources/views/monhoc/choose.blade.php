@extends('backend::layouts.master')
@section('title', 'Choose')
@section('type', 'Choose')
@section('title1')
  Câu hỏi, bài thi của môn học: {{ $monhoc['ten_mon_hoc'] }}
@stop
@section('content')
	<div class="col-md-12">
		<div class="col-sm-4 ">
			<a href="{{ Route('backend.mon-hoc', ['page'=>Request::get('page', 1)]) }}" class="btn-sm btn-primary">
				<i class="fa fa-reply" aria-hidden="true"></i>
				 Quay Lại
			</a>
		</div>
	</div>
	<br/>
	<br/>
    <div class="col-md-12">
        <div class="col-md-3 col-sm-4">
        	<a href="{{ Route('backend.mon-hoc.list-cau-hoi', [$monhoc['id'],'page'=>Request::get('page', 1)]) }}" 
                class="thumbnail purple ">
        		<i class="fa fa-user fa-5x"></i><br/>
        		Câu Hỏi
        	</a>
        </div>
        <div class="col-md-3 col-sm-4">
        	<a href="{{ Route('backend.mon-hoc.list-bai-thi', [$monhoc['id'],'page'=>Request::get('page', 1)]) }}" 
                class="thumbnail purple">
        		<i class="fa fa-user fa-5x"></i><br/>
        		Bài Thi
        	</a>
        </div>
    </div>
@endsection()