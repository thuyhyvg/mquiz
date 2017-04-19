<?php namespace Modules\Backend\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\User;
use App\Monhoc;
use App\Baithi;
use App\Cauhoi;
use Auth;
class BackendController extends Controller {
	
	public function index()
	{
		if(Auth::user()->isAdmin() == true)
		{
			$cauhoi = Cauhoi::count();
			$baithi = Baithi::count();
		}
		elseif(Auth::user()->isTeacher() == true)
		{
			$cauhoi = Cauhoi::where('user_id', Auth::user()->id)->count();
			$baithi = Baithi::where('user_id', Auth::user()->id)->count();
		}
		$monhoc = Monhoc::count();
		$users = User::all();
		foreach($users as $key=>$value)
		{	
			$user = count($value->isStudent());
		}
		return view('backend::index', 
			[
				'cauhoi' => $cauhoi,
				'baithi' => $baithi,
				'monhoc' => $monhoc,
				'user' => $user
			]);
	}
	
}