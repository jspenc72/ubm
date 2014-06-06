<?php

class HomeController extends BaseController {

	public function home(){
		/*** /
		Mail::send('emails.auth.test', array('name' => 'Jesse'), function($message) {
			
			$message->to('jspenc72@gmail.com', 'Jesse Spencer')->subject('Test Email');
		
		});/***/
		//echo $user = User::find(1)->username;						//Using Eloquent User model
		
		return View::make('home');
	}

}