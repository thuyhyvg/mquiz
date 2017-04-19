@extends('backend::layouts.master')
@section('title', 'Danh sách user')
@section('type', 'User')
@section('title1')
  Danh sách người dùng
@stop
@section('content')
	<div class="col-sm-12">
		<div class="col-sm-6">
			<div class="col-sm-3">
				<a href="#" class="btn-sm btn-warning new">
					<i class="fa fa-plus" aria-hidden="true"></i>
					Thêm mới
				</a>
			</div>
		</div>
		<div class="col-sm-6">
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
						<th>Họ Tên</th>
						<th>Email</th>
						<th class="text-center">Quyền</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
					<?php $stt = 0; ?>
					@forelse($users as $user)
						<?php $stt = $stt + 1; ?>
						<tr>
							<td>{{ $stt }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							@foreach($user->roles()->get() as $role)
								<td class="text-center">
									<select name="role" data-id="{{ $user['id'] }}"
										data-token="{{ csrf_token() }}" 
										class="btn-sm btn-default selectrole"
										<?php if($role->slug == 'admin'){ echo "disabled"; }?>>
										@foreach($roles as $r)
											@if($role['slug'] != 'admin')
												@if($r['slug'] != 'admin')
													<option value="{{ $r['id'] }}"
														<?php if($role->id == $r['id']){ echo "selected"; }?>>
															{{ $r['name'] }}
													</option>
												@endif
											@else if($role['slug'] == 'admin')
												<option value="{{ $r['id'] }}"
													<?php if($role->id == $r['id']){ echo "selected"; }?>>
														{{ $r['name'] }}
												</option>
											@endif
										@endforeach
									</select>
								</td>
							@endforeach
							<td><a href="javascript:;" class="btn-sm btn-danger delete" dataId="{{$user->id}}">
									<i class=" fa fa-trash-o" aria-hidden="true"></i> 
									 Xóa
								</a>
							</td>
						</tr>
					@empty
						<tr>
							<td colspa="5" class="text-center">
								<p>Không có user nào.</p>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
@stop

@section('modal')
<!-- Modal New User -->
<div id="newModal" class="modal fade bs-example-modal-sm" tabindex="-1" 
	role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thêm mới tài khoản:</i></b></h4>
    </div>
    <form method="post" action="{{ Route('user.new-user') }}" 
    	class="form-horizontal">
        {{csrf_field()}}
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Họ Tên:</label>
	        	<input type="text" class="form-control" name="name" placeholder="Họ Tên">
	        </div>
        </div>
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
        		<label class="control-label">Quyền:</label>
        		<select name="role_id" class="form-control">
        			<option value = "">Chọn một quyền</option>
        			@foreach($roles as $r)
        				<option value="{{ $r['id'] }}">{{ $r['name'] }}</option>
        			@endforeach
        		</select>
        	</div>
        </div>
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Email:</label>
	        	<input type="email" class="form-control" name="email" placeholder="Email">
	        </div>
        </div>
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Password:</label>
	        	<input type="password" class="form-control" name="password" placeholder="Password">
	        </div>
        </div>
        <div class="form-group">
        	<div class="col-sm-10 col-sm-offset-1">
	        	<label class="control-label">Re-Password:</label>
	        	<input type="password" class="form-control" name="re_password" placeholder="Confirm Password">
	        </div>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-warning">Thêm mới</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        </div>
    </form>
    </div>
  </div>
</div>
<!-- End modal new User -->

<!-- Modal xóa User -->

<div id="deleteModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Xóa</h4>
      </div>
      <form method="post" action="{{ Route('user.delete-user') }}">
         {{csrf_field()}}
         <p>Bạn có muốn xóa user này không?</p>
         <input type="hidden" value="0" id="user_id" name="user_id" />
         <input type="hidden" value="{{Request::get('page', 1)}}" name="page" />
         <div class="modal-footer">
         <button type="submit" class="btn btn-danger">Xóa</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
         </div>
      </form>
    </div>
  </div>
</div>

<!-- End modal xóa User -->
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
	        $('.new').click(function(){
	            $('#newModal').modal({'show': true});
	        });
	    });

	    $('.delete').click(function(){
            $('#user_id').val($(this).attr('dataId'));
            $('#deleteModal').modal({'show': true});
        });

		$('.selectrole').on('change',function(){
			var role =  $(this).val();
			var user_id = $(this).data('id');
			var token = $(this).data('token');
			 $.ajax({
			    url:'/user/update-role',
			    type: 'POST',
			    data: { _token :token,role:role, user_id:user_id},
			    success:function(response){
			    	if(response.r == 3)
			    	{
			    		alert('Không thể cấp quyền Admin cho user này');
			    	}
			    	else{
			       		console.log(response.r);
			       	}
			    }
			});
		})
	</script>
@stop