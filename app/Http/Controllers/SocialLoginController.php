<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Input;
use Auth;
use Redirect;
use Hash;
class SocialLoginController extends Controller
{
    public function facebookAuthRedirect() {
		return Socialite::with('facebook')->redirect();
	}
	public function facebookSuccess() {
 
		$provider = Socialite::with('facebook');
 	  	if (Input::has('code')){
	    	$user = $provider->stateless()->user();
	    	// dd($user);
		}
		return view('new',compact('user'));

	}
}
