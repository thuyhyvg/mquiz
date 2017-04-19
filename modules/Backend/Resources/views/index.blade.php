@extends('backend::layouts.master')

@section('title', 'Quiz - Backend')
@section('type', 'Quiz')
@section('title1', 'Welcome To Quiz')
@section('content')
	<div class="padding-md">
		<div class="row">
			<div class="col-sm-6 col-md-3">
				<div class="panel-stat3 bg-danger">
					<h2 class="m-top-none" id="userCount">{{ $user }}</h2>
					<h5>Sinh viên</h5>
					<div class="stat-icon">
						<i class="fa fa-users fa-3x"></i>
					</div>
					<div class="refresh-button">
						<i class="fa fa-refresh"></i>
					</div>
					<div class="loading-overlay">
						<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
					</div>
				</div>
			</div><!-- /.col -->
			<div class="col-sm-6 col-md-3">
				<div class="panel-stat3 bg-info">
					<h2 class="m-top-none"><span id="serverloadCount">{{ $monhoc }}</span></h2>
					<h5>Môn học</h5>
					<div class="stat-icon">
						<i class="fa fa-file-text fa-3x"></i>
					</div>
					<div class="refresh-button">
						<i class="fa fa-refresh"></i>
					</div>
					<div class="loading-overlay">
						<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
					</div>
				</div>
			</div><!-- /.col -->
			<div class="col-sm-6 col-md-3">
				<div class="panel-stat3 bg-warning">
					<h2 class="m-top-none" id="orderCount">{{ $baithi }}</h2>
					<h5>Bài thi</h5>
					<div class="stat-icon">
						<i class="fa fa-list fa-3x"></i>
					</div>
					<div class="refresh-button">
						<i class="fa fa-refresh"></i>
					</div>
					<div class="loading-overlay">
						<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
					</div>
				</div>
			</div><!-- /.col -->
			<div class="col-sm-6 col-md-3">
				<div class="panel-stat3 bg-success">
					<h2 class="m-top-none" id="visitorCount">{{ $cauhoi }}</h2>
					<h5>Câu hỏi</h5>
					<div class="stat-icon">
						<i class="fa fa-question-circle-o fa-3x"></i>
					</div>
					<div class="refresh-button">
						<i class="fa fa-refresh"></i>
					</div>
					<div class="loading-overlay">
						<i class="loading-icon fa fa-refresh fa-spin fa-lg"></i>
					</div>
				</div>
			</div><!-- /.col -->
		</div>
	</div>
@stop