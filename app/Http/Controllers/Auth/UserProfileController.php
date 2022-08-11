<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
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
            'first_name' => ['required', 'string', 'max:150'],
            'last_name' => ['required', 'string', 'max:150'],
			'name' => ['required', 'string', 'max:255'],
			'email' => ['
				required',
				'email',
				Rule::unique('users')->ignore($user->id)
            ],

            'gender' => 'nullable|string|in:male,female',
            'birthday' => 'nullable|date|before:today',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'country_code' => 'required|alpha|max:2',
            'locale' => 'string|max:5',
            'timezone' => 'string',
		]);

        
        $profile = $user->profile;
        
        if(!$profile->exists) {
            $request->merge([
                'user_id' => $user->id,
            ]);
            $profile->create($request->all());
        } else {
            $profile->update($request->all());
        }

		$user->update($request->all());


		return redirect()->route('profile')->with('success', 'Profile Data Updated.');
	}
}
