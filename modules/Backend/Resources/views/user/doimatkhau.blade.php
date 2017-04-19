@extends('backend::layouts.master')
@section('title', 'Đổi mật khẩu')
@section('type', 'Đổi mật khẩu')
@section('title1')
  Đổi mật khẩu
@stop
@section('content')
	<form method="post" action = "{{ Route('user.doimatkhau') }}"
		class="form-horizontal">
		{{csrf_field()}}
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-1">
				<label class="control-label">Mật khẩu cũ:</label>
				<input type="password" class="form-control" name="password" placeholder="Mật khẩu cũ">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-1">
				<label class="control-label">Mật khẩu mới:</label>
				<input type="password" class="form-control" name="password1" placeholder="Mật khẩu mới">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-1">
				<label class="control-label">Nhập lại mật khẩu:</label>
				<input type="password" class="form-control" name="re_password" placeholder="Nhập lại mật khẩu">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-1">
				<input type="submit" class="btn btn-primary" name="ok" value="Đổi mật khẩu">
			</div>
		</div>
	</form>
@stop