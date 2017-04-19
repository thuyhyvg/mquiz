

<?php

Route::group(['middleware' => 'web',
	'domain' => 'backend.' . env('DOMAIN'),
	'namespace' => 'Modules\Backend\Http\Controllers'], function()
	{
		Route::group(['middleware' => ['auth']], function(){
			Route::get('doi-mat-khau', [
					'as' => 'user.doimatkhau',
					'uses' => 'UserController@doi_mat_khau'
				]);
			Route::post('doi-mat-khau',[
					'as' => 'user.doimatkhau',
					'uses' => 'UserController@save_doi_mat_khau'
				]);
			Route::get('/home', 'HomeController@index');
			Route::get('/', 'BackendController@index');
			Route::group(['middleware' => 'teacher'], function(){
				Route::group(['prefix' => 'mon-hoc'], function(){
					Route::get('/', ['as' => 'backend.mon-hoc', 'uses' => 'MonhocController@index']);
					Route::get('choose/{id}', ['as' => 'backend.choose', 'uses' => 'MonhocController@choose']);

					Route::get('chon-bai-thi-cau-hoi/{mon_hoc_id}/{bai_thi_id}',
						[
							'as' => 'backend.mon-hoc.chon-bai-thi-cau-hoi',
							'uses' => 'MonhocController@chon_bai_thi_cau_hoi'
						]);
					Route::post('chon-bai-thi-cau-hoi/{mon_hoc_id}/{bai_thi_id}',[
							'as' => 'backend.mon-hoc.chon-bai-thi-cau-hoi',
							'uses' => 'MonhocController@save_chon_bai_thi_cau_hoi'
						]);

					Route::get('list-cau-hoi/{mon_hoc_id}',
						[
						'as' => 'backend.mon-hoc.list-cau-hoi',
						'uses' => 'MonhocController@list_cau_hoi'
						]);
					Route::post('new-cau-hoi/{mon_hoc_id}',
						[
							'as' => 'backend.mon-hoc.new-cau-hoi',
							'uses' => 'MonhocController@new_cau_hoi'
						]);
					Route::get('edit-cau-hoi/{mon_hoc_id}/{cau_hoi_id}', [
							'as' => 'backend.mon-hoc.edit-cau-hoi',
							'uses' => 'MonhocController@edit_cau_hoi'
						]);
					Route::post('edit-cau-hoi/{mon_hoc_id}/{cau_hoi_id}', [
							'as' => 'backend.mon-hoc.edit-cau-hoi',
							'uses' => 'MonhocController@save_edit_cau_hoi'
						]);
					Route::post('delete-cau-hoi/{mon_hoc_id}', [
							'as' => 'backend.mon-hoc.delete-cau-hoi',
							'uses' => 'MonhocController@delete_cau_hoi'
						]);

					Route::get('list-bai-thi/{mon_hoc_id}',[
							'as' => 'backend.mon-hoc.list-bai-thi',
							'uses' => 'MonhocController@list_bai_thi'
						]);
					Route::post('new-bai-thi/{mon_hoc_id}', [
							'as' => 'backend.mon-hoc.new-bai-thi',
							'uses' => 'MonhocController@new_bai_thi'
						]);
					Route::get('edit-bai-thi/{mon_hoc_id}/{bai_thi_id}',[
							'as' => 'backend.mon-hoc.edit-bai-thi',
							'uses' => 'MonhocController@edit_bai_thi'
						]);
					Route::post('save-edit-bai-thi/{mon_hoc_id}/{bai_thi_id}',[
							'as' => 'backend.mon-hoc.save_edit-bai-thi',
							'uses' => 'MonhocController@save_edit_bai_thi'
						]);
					Route::post('delete-bai-thi/{mon_hoc_id}', [
							'as' => 'backend.mon-hoc.delete-bai-thi',
							'uses' => 'MonhocController@delete_bai_thi'
						]);
				});

				Route::group(['prefix' => 'cau-hoi'], function(){
					Route::get('/', [
						'as' => 'backend.cau-hoi',
						'uses' => 'CauhoiController@index'
					]);
					Route::get('new-cau-hoi',
						[
							'as' => 'backend.new-cau-hoi',
							'uses' => 'CauhoiController@new_cau_hoi'
						]);
					Route::post('new-cau-hoi',
						[
							'as' => 'backend.new-cau-hoi',
							'uses' => 'CauhoiController@save_new_cau_hoi'
						]);
					Route::post('delete-cau-hoi', [
							'as' => 'backend.delete-cau-hoi',
							'uses' => 'CauhoiController@delete_cau_hoi'
						]);
					Route::get('edit-cau-hoi/{cau_hoi_id}', [
							'as' => 'backend.cau-hoi.edit-cau-hoi',
							'uses' => 'CauhoiController@edit_cau_hoi'
						]);
					Route::post('edit-cau-hoi/{cau_hoi_id}', [
							'as' => 'backend.cau-hoi.edit-cau-hoi',
							'uses' => 'CauhoiController@save_edit_cau_hoi'
						]);
				});

				Route::group(['prefix' => 'bai-thi'], function(){
					Route::get('/', [
							'as' => 'backend.bai-thi',
							'uses' => 'BaithiController@index'
						]);
					Route::post('new-bai-thi',[
							'as' => 'backend.bai-thi.new-bai-thi',
							'uses' => 'BaithiController@new_bai_thi'
						]);
					Route::get('edit-bai-thi/{bai_thi_id}',[
							'as' => 'backend.bai-thi.edit-bai-thi',
							'uses' => 'BaithiController@edit_bai_thi'
						]);
					Route::post('edit-bai-thi/{bai_thi_id}', [
							'as' => 'backend.bai-thi.edit-bai-thi',
							'uses' => 'BaithiController@save_edit_bai_thi'
						]);
					Route::post('delete-bai-thi', [
							'as' => 'backend.bai-thi.delete-bai-thi',
							'uses' => 'BaithiController@delete_bai_thi'
						]);
					Route::get('chon-cau-hoi/{bai_thi_id}',[
							'as' => 'backend.bai-thi.chon-cau-hoi',
							'uses' => 'BaithiController@chon_cau_hoi'
						]);
					Route::post('chon-cau-hoi/{bai_thi_id}', [
							'as' => 'backend.bai-thi.chon-cau-hoi',
							'uses' => 'BaithiController@save_chon_cau_hoi'
						]);
				});
				Route::group(['prefix' => 'diem'], function(){
					Route::get('/{mon_hoc_id}', [
							'as' => 'diem.bai-thi',
							'uses' => 'BangdiemController@index'
						]);
					Route::get('list-user/{bai_thi_id}',[
							'as' => 'diem.list-user',
							'uses' =>'BangdiemController@list_user'
						]);
					Route::get('excel/{bai_thi_id}',[
							'as' => 'diem.excel',
							'uses' => 'BangdiemController@bangdiem_excel'
						]);
					Route::get('chitiet/{bai_thi_id}/{hocvien_baithi_id}',[
							'as' => 'diem.chi-tiet',
							'uses' => 'BangdiemController@bangdiem_chitiet'
						]);
				});
			});
			Route::group(['middleware' => 'admin'], function(){
				Route::group(['prefix' => 'mon-hoc'], function(){
					Route::get('admin', [
							'as' => 'backend.mon-hoc.admin',
							'uses' => 'MonhocController@index_admin'
						]);
					Route::post('new-mon-hoc', [
						'as' => 'backend.new-mon-hoc',
						'uses' => 'MonhocController@new_mon_hoc'
					]);
					Route::get('edit-mon-hoc/{id}', [
						'as' => 'backend.edit-mon-hoc',
						'uses' => 'MonhocController@edit_mon_hoc'
					]);
					Route::post('edit-mon-hoc/{id}', [
						'as' => 'backend.edit-mon-hoc',
						'uses' => 'MonhocController@save_edit_mon_hoc'
					]);
					Route::post('delete-mon-hoc', [
						'as' => 'backend.delete-mon-hoc',
						'uses' => 'MonhocController@delete_mon_hoc'
					]);
				});
				Route::group(['prefix' => 'user'], function(){
					Route::get('/', [
							'as' => 'user.list',
							'uses' => 'UserController@index'
						]);
					Route::post('update-role', [
							'as' => 'user.update-role',
							'uses' => 'UserController@updateRole'
						]);
					Route::post('new-user', [
							'as' => 'user.new-user',
							'uses' => 'UserController@new_user'
						]);
					Route::post('delete-user', [
							'as' => 'user.delete-user',
							'uses' => 'UserController@delete_user'
						]);

				});
				Route::group(['prefix' => 'bang-diem'], function(){
					Route::get('bai-thi/{mon_hoc_id}',
						[
						'as' => 'backend.bang-diem.bai-thi',
						'uses' => 'AdminController@bangdiem_baithi'
					]);
					Route::get('/{bai_thi_id}',
						[
							'as' => 'backend.bang-diem',
							'uses' => 'AdminController@bangdiem_user'
						]);
					Route::get('chi-tiet/{bai_thi_id}/{hocvien_baithi_id}', [
							'as' => 'backend.bang-diem.chi-tiet',
							'uses' => 'AdminController@bangdiem_chitiet'
						]);
					Route::get('excel/{bai_thi_id}', [
							'as' => 'backend.bang-diem.excel',
							'uses' => 'AdminController@bangdiem_excel'
						]);
				});
			});
		});
	});
