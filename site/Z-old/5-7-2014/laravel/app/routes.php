<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*
 * UBM AUTOMATOR ROUTES
 * */
 Route::get('/P3/COA/', function()				//Loads the Balance Sheet Credits Data for current model.
{
	return View::make('modelcreationsuite.P3.index');
});
  Route::get('/P3/LOADBSC/', function()				//Loads the Balance Sheet Credits Data for current model.
{
	return View::make('modelcreationsuite.P3.loadbalancesheetcreditsdata');
});
 Route::get('/P3/LOADBSD/', function()				//Loads the Balance Sheet Debits Data for the current model
{
	return View::make('modelcreationsuite.P3.loadbalancesheetdebitsdata');
}); 
 Route::get('/P3/LOADISC/', function()				//Loads the Income Statement Credits Data for current model.
{
	return View::make('modelcreationsuite.P3.loadincomestatementcreditsdata');
});
 Route::get('/P3/LOADISD/', function()				//Loads the Income Statement Debits Data for the current model
{
	return View::make('modelcreationsuite.P3.loadincomestatementdebitsdata');
});
 Route::get('/P3/UPDATECOA/', function()				//Updates any and all values modified on the chart of accounts page in the database.
{
	return View::make('modelcreationsuite.P3.getupdate');
}); 
 /*
 * END UBM AUTOMATOR ROUTES
 * */
Route::get('/', function()
{
	return View::make('hello');
});
Route::get('users', function()
{
	return 'Users!';
});
Route::get('dev', function()
{
	return View::make('devlogin');
});

Route::get('web', function()
{
	return View::make('site');
});
Route::get('home', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));
Route::get('/user/{username}', array(
	'as' => 'profile-user',
	'uses' => 'ProfileController@user'
));
Route::get('/amodelcreation/{username}', array(
	'as' => 'steward-model-creation',
	'uses' => 'ProfileController@amodelcreation'
));

/*
 * Authenticated group
 * */
Route::group(array('before'=> 'auth'), function(){			//Any Routes in this group cannot be reached before the user signs in.

	Route::group(array('before'=> 'csrf'), function(){		//Any Routes in this group are not succeptible to Cross Site Request Forgery
		/*
		 * Change Password (POST)
		 * */	
	 	Route::post('/account/change-password', array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
		));		
	});
/*
 * Change Password (GET)
 * */	
 	Route::get('/account/change-password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));
/*
 * Sign Out (GET)
 * */	
	Route::get('/account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));
});

/*
 * Unauthenticated group
 * */
Route::group(array('before' => 'guest'), function(){
	
	/*
	 * CSRF protection group
	 * */
	Route::group(array('before' => 'csrf'), function(){
		/*
		 * Create Account (POST)
		 * */
		 Route::post('/account/post', array(
		 'as'=> 'account-create-post',
		 'uses'=> 'AccountController@postCreate'
		 ));//Submits the form.
		/*
		 * Sign In (POST)
		 * */
		 Route::post('/account/sign-in', array(
		 		'as'=> 'account-sign-in-post',
		 		'uses' => 'AccountController@postSignIn'
		 ));//Submits the Form.
		/*
		 * Forgot Password (POST)
		 * */
		 Route::post('/account/forgot-password', array(
		 		'as'=> 'account-forgot-password-post',
		 		'uses' => 'AccountController@postForgotPassword'		 
		 ));
	});
	/*
	 * Forgot Password (GET)
	 */	
	Route::get('/account/forgot', array(
		'as' => 'account-forgot-password',
		'uses' => 'AccountController@getForgotPassword'
	));
	Route::get('/account/recover/{code}', array(
		'as' => 'account-recover',
		'uses' => 'AccountController@getRecover'
	));

	 	 
	/*
	 * Sign In (GET)
	 * */
	 Route::get('/account/sign-in', array(
	 		'as'=> 'account-sign-in',
	 		'uses' => 'AccountController@getSignIn'
	 ));//Displays the Sign In form
	/*
	 * Create Account (GET)
	 * */
	Route::get('/account/create', array(
		'as'=> 'account-create',
		'uses'=> 'AccountController@getCreate'
	));
	Route::get('/account/activate/{code}', array(
		'as'=> 'account-activate',
		'uses'=> 'AccountController@getActivate'
	));
});
