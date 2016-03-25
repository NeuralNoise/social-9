<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::auth();

	Route::get('/', [
		'uses' => 'HomeController@index',
		'as' => 'home',
	]);

	Route::get('/alert', function () {
		return redirect()->route('home')->with('info', 'You have signed up!');
	});

	Route::get('signup', [
		'uses' => 'AuthController@getSignup',
		'as' => 'auth.signup'
	]);
	Route::post('signup', [
		'uses' => 'AuthController@postSignup',
	]);
	Route::get('signin', [
		'uses' => 'AuthController@getSignin',
		'as' => 'auth.signin'
	]);
	Route::post('signin', [
		'uses' => 'AuthController@postSignin',
	]);

	Route::get('signout', [
		'uses' => 'AuthController@getSignout',
		'as' => 'auth.signout'
	]);
	Route::get('search', [
		'uses' => 'SearchController@getResults',
		'as' => 'search.results'
	]);
	Route::get('user/{username}', [
		'uses' => 'ProfileController@getProfile',
		'as' => 'profile.index'
	]);
	/**
	 * Profiles
	 */
	Route::get('profile/edit', [
		'uses' => 'ProfileController@getEdit',
		'as' => 'profile.edit',
		'middleware' => ['auth']
	]);
	Route::post('profile/edit', [
		'uses' => 'ProfileController@postEdit',
		'middleware' => ['auth']
	]);

	/**
	 * Friends
	 */

	Route::get('friends', [
		'uses' => 'FriendController@getIndex',
		'as' => 'friends.index',
		'middleware' => ['auth']
	]);

	Route::get('friends/add/{username}', [
		'uses' => 'FriendController@getAdd',
		'as' => 'friends.add',
		'middleware' => ['auth']
	]);

	Route::get('friends/accept/{username}', [
		'uses' => 'FriendController@getAccept',
		'as' => 'friend.accept',
		'middleware' => ['auth']
	]);
	Route::post('friends/delete/{username}', [
		'uses' => 'FriendController@postDelete',
		'as' => 'friends.delete',
		'middleware' => ['auth']
	]);
	/**
	 * Statuses
	 */
	Route::post('status', [
		'uses' => 'StatusController@postStatus',
		'as' => 'status.post',
		'middleware' => ['auth']
	]);

	Route::post('status/{statusId}/reply', [
		'uses' => 'StatusController@postReply',
		'as' => 'status.reply',
		'middleware' => ['auth']
	]);

	Route::get('status/{statusId}/like', [
		'uses' => 'StatusController@getLike',
		'as' => 'status.like',
		'middleware' => ['auth']
	]);
});

