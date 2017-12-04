<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegistrationController extends Controller {

    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Make user activation.
     */
    public function activation($userId, $token) {
        $user = User::findOrFail($userId);

        // Check token in user DB. if null then check data (user make first activation).
        if (is_null($user->remember_token)) {
            // Check token from url.
            if (md5($user->email) == $token) {
                // Change status and login user.
                $user->status = 1;
                
                $user->save();
                \Session::flash('flash_message', trans('interface.ActivatedSuccess'));

                // Make login user.
                Auth::login($user, true);
            } else {
                // Wrong token.
                \Session::flash('flash_message_error', trans('interface.ActivatedWrong'));
            }
        } else {
            // User was activated early.
            \Session::flash('flash_message_error', trans('interface.ActivatedAlready'));
        }
        return redirect('/');
    }

}
