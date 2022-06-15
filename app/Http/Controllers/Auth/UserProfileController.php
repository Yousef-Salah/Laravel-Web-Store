<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
	public function index()
	{
		return view('auth.user-profile', [
			'user' => Auth::user(),
		]);
	}

	public function update(Request $request)
	{
		$user = $request->user();
		
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['
				required',
				'email',
				Rule::unique('users')->ignore($user->id)]
		]);

		$user->update($request->all());

		return redirect()->route('profile')->with('success', 'Profile Data Updated.');
	}
}
