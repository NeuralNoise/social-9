<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use Auth;

class AuthController extends Controller
{
	public function getSignup()
	{
		return view('auth.signup');
	}

	public function postSignup(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|unique:users|email|max:150',
			'username' => 'required|unique:users|alpha_dash|min:5|max:20',
			'password' => 'required|min:6',
		]);

		User::create([
			'email' => $request->input('email'),
			'username' => $request->input('username'),
			'password' => bcrypt($request->input('password')),
		]);

		return redirect()
			->route('home')
			->with('info', 'Your account has been created and you can now sign in.');
	}

	public function getSignin()
	{
		return view('auth.signin');
	}

	public function postSignin(Request $request)
	{
		$this->validate($request, [
			'username' => 'required',
			'password' => 'required',
		]);

		if (!Auth::attempt($request->only(['username', 'password']), $request->has('remember'))) {
			return redirect()->back()->with('info', 'Wrong credentials');
		}
		return redirect()->route('home')->with('info', 'You are now signed in.');
	}

	public function getSignout()
	{
		Auth::logout();

		return redirect()->route('home')->with('info','Successfully logged out');
	}
}
