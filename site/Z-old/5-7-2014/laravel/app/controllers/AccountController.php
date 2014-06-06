<?php
class AccountController extends BaseController{
	public function getSignIn(){
		return View::make('account.signin');
	}
	public function postSignIn(){
	/***/	$validator = Validator::make(Input::all(),
			array(
				'email' 			=> 'required|email',
				'password' 			=> 'required',
			)
		); 
		if($validator->fails()){
			return Redirect::route('account-sign-in')
			->withErrors($validator)
			->withInput();
		}else{
			$remember = (Input::has('remember')) ? true : false;				//If Input has "remember" the variable $remember is set to true, if not it is set to false.
			
		/***/	//Attempt User Sign In if validation is successful.
			$auth = Auth::attempt(array(
					'email'=> Input::get('email'),
					'password' => Input::get('password'),
					'active' => 1
			), $remember);
			if($auth){
				//Redirect to the intended page.
				return Redirect::intended('/home/'); //Page to which the user is redirected to on sign in. Redirects user is they are not signed in and wanted to access a page only accessible while being signed in.
			}else{
				/***/return Redirect::route('account-sign-in')
						->with('global', 'Email or password was inccorect.');				
			}/***/
		}
		/***/return Redirect::route('account-sign-in')
			->with('global', 'There was a problem signing you in.'); /***/
	}
	public function getSignOut(){
		Auth::logout(); 												//This will log the user out
		return Redirect::route('home')									//This redirects the user to the home page and notifies them that they have been signed out.
				->with('global', 'You have successfully logged out.');
	}


	public function getCreate(){
		return View::make('account.create');
	}//Returns view with form
	
	public function postCreate(){
		$validator = Validator::make(Input::all(),
			array(
				'email' 			=> 'required|max:50|email|unique:users',
				'username' 			=> 'required|max:20|min:3|unique:users',
				'password' 			=> 'required|min:6',
				'password_again' 	=> 'required|same:password'
			)
		); 
		if($validator->fails()){
			return Redirect::route('account-create')
			->withErrors($validator)
			->withInput();
		}else{
			//Create account
			$email 		= Input::get('email');
			$username 	= Input::get('username');
			$password 	= Input::get('password');
			//Activation code
			$code		= str_random(60);
			$user = User::create(array(
				'email' 	=> $email,
				'username' 	=> $username,
				'password' 	=> Hash::make($password),
				'code' 		=> $code,
				'acitve' 	=> 0
			));
			if($user){
				//Send Email
				Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username'=> $username), function($message) use ($user) {
					 $message->to($user->email, $user->username)->subject('Activate your UBM Account.');
				});
				return Redirect::route('home')
						->with('global', 'Your account has been created! We have sent you an email to activate your account.');
			}
		}
	}//Submits the form

	public function getActivate($code){
		$user = User::where('code', '=', $code)->where('active', '=', 0);
		if($user->count()){
			$user= $user->first();
			//Update user record to an active account.
			$user->active 	= 1;
			$user->code 	= '';
			$user->save();
			if($user->save()){
				return Redirect::route('home')
					->with('global', 'Congratulations, your account has been activated! You can now sign in!');
			}
		}
				return Redirect::route('home')
					->with('global', 'Sorry, We could not activate your account.');		
	}//Activates the users account. Gives error if the users account could not be activated.
	public function getChangePassword(){
		return View::make('account.password');
	}
	public function postChangePassword(){
		$validator = Validator::make(Input::all(),
			array(
				'old_password' 			=> 'required',
				'password' 				=> 'required|min:6',
				'password_again' 		=> 'required|same:password'
			)
		);
		if($validator->fails()){
			//Redirect if validation fails.
			return Redirect::route('account-change-password')
					->withErrors($validator);
		}else{
			//Change Password
			$user				= User::find(Auth::user()->id);
			$old_password		= Input::get('old_password');	
			$password			= Input::get('password');	
			
			if(Hash::check($old_password, $user->getAuthPassword())){
				//password user provided matches the one stored in the database.
				$user->password = Hash::make($password);
				if($user->save()){
					return Redirect::route('home')
							->with('global', 'Your password has been changed.');
				}
			}else{
					return Redirect::route('home')
							->with('global', 'Your old password is incorrect.');				
			}
			
			
		}
		return Redirect::route('account-change-password')
			->with('global', 'Your password could not be changed.');
	}

	public function getForgotPassword(){
		return View::make('account.forgot'); 
	}
	public function postForgotPassword(){
		$validator = Validator::make(Input::all(), 
			array(
				'email' => 'required|email'
			)
		);
		if($validator->fails()){
			return Redirect::route('account-forgot-password')
				->withErrors($validator)
				->withInput();
		}else{
			//change password
			$user = User::where('email', '=', Input::get('email'));
			if($user->count()){
				$user = $user->first();
				
				//Generate new code and password.
				$code = str_random(60);
				$password = str_random(10);
				
				$user->code = $code;
				$user->password_temp = Hash::make($password);
				
				if($user->save()){
					//Send password recover email.	
					Mail::send('emails.auth.forgot', array('link' => URL::route('account-recover', $code), 'username'=> $user->username, 'password' => $password), function($message) use($user){
								 $message->to($user->email, $user->username)->subject('Your new UBM developer password.');
					});
					return Redirect::route('home')
							->with('global', 'We have sent you a new password via email.');
				}	
			}
		}
		return Redirect::route('account-forgot-password')
				->with('global', 'Could not request new password.');
	}
	public function getRecover($code){
		$user = User::where('code', '=', $code)
				->where('password_temp', '!=', '');			//the password temp field cannot be blank.

		if($user->count()){
			$user 					= $user->first();
			$user->password 		= $user->password_temp;
			$user->password_temp	= '';
			$user->code				= '';
			if($user->save()){
				return Redirect::route('home')
						->with('global', 'You account has been recovered and you can sign into your account with your new password.');
			}
		}
		return Redirect::route('home')
				->with('global','Could not recover your account.');
	}
}