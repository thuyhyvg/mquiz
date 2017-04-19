<?php namespace Modules\Backend\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\User;
use App\Role;
use App\RoleUser;
use Request;
use Illuminate\Http\Request as Request1;
use Modules\Backend\Http\Requests\UserRequest;
use Modules\Backend\Http\Requests\DoimatkhauRequest;
use Auth;
use Hash;
use Validator;
use Crypt;

class UserController extends Controller {
	
	public function index()
	{
		$roles = Role::all();
		$keyword = Request::get('keyword', '');
		if($keyword)
		{
			$users = User::where('name', 'like', "%$keyword%")
				->orderBy('created_at', 'desc')->paginate(10);
			$users->appends(['keyword' => $keyword]);
		}
		else{
			$users = User::orderBy('created_at', 'desc')->paginate(10);
		}
		return view('backend::user.index', ['users' => $users, 'roles' => $roles]);
	}

	public function updateRole(Request1 $request)
	{
		$r = $_POST['role'];
		$user_id = $request->get('user_id');
		$roles = RoleUser::where('user_id', $user_id)->get();
		if($r != 3)
		{
			foreach($roles as $role)
			{
				$role->role_id = $r;
				$role->save();	
			}
		}
		return response()->json(['roles' => $roles, 'r' => $r]);
	}

	public function new_user(UserRequest $request)
	{
		if($request->role_id == "")
		{
			return redirect()->route('user.list')->withErrors('Phải chọn 1 quyền');
		}
		else
		{
			$user = new User;
			$user->name = $request->name;
			$user->email = $request->email;
			$user->password = bcrypt($request->password);

			$user->save();

			$roleuser = new RoleUser;
			$roleuser->user_id = $user->id;
			$roleuser->role_id = $request->role_id;

			$roleuser->save();

			return redirect()->route('user.list')->withSuccess('Thêm mới người dùng thành công !');
		}
	}

	public function delete_user(Request1 $request)
	{
		$user = User::find($request->get('user_id', 0));
		$roleuser = RoleUser::where('user_id', $user['id'])->get();
		$baithi = count($user->baithis);
		$hocvien_baithi = count($user->hocvien_baithi);
		$cauhoi = count($user->cauhois);
		foreach($user->roles()->get() as $role)
		{
			if($role['slug'] == 'admin')
			{
				return redirect()->route('user.list')
					->withErrors('Không thể xóa user này');
			}
			else if($baithi > 0 || $hocvien_baithi > 0 || $cauhoi > 0)
			{
				return redirect()->route('user.list')
					->withErrors('Không thể xóa user này');
			}
			else{
				foreach($roleuser as $ru)
				{
					$ru->delete();
				}
				$user->delete();
				return redirect()->route('user.list')
					->withSuccess('Xóa user thành công !');
			}
		}
	}

	public function doi_mat_khau()
	{
		return view('backend::user.doimatkhau');
	}

	public function save_doi_mat_khau(DoimatkhauRequest $request)
	{
		$id = Auth::user()->id;
		$user = User::find($id);
		if(Hash::check($request->password, $user->password) == false)
		{
			return redirect()->route('user.doimatkhau')
				->withErrors('Mật khẩu cũ không đúng');
		}
		else{
			$user->password = bcrypt($request->password1);

			$user->save();
			return redirect('logout')
				->withSuccess('Đổi mật khẩu thành công, mời bạn đăng nhập lại !');
		}
	}
}