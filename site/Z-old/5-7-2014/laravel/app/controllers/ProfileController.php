<?php 
class ProfileController extends BaseController {
	public function user($username){
		$user = User::where('username', '=', $username);
		if($user->count()){
			$user = $user->first();
			return View::make('profile.user')	
					->with('user', $user);			
		}
		 return App::abort(404);
	}
	public function amodelcreation($username){
		$user = User::where('username', '=', $username);
		if($user->count()){
			$user = $user->first();
			return View::make('managementreporting.amodelcreation')	
					->with('user', $user);			
		}
		 return App::abort(404);		
	}
}
