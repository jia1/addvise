<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use SammyK;

class UsersController extends Controller
{
    /**
     * Insert a first-time user into the users table in our database
     */
    public function getUserUpsert(Request $request, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $fb_user_id = \Request::get('fb_user_id');

        $user = User::where('fb_user_id', $fb_user_id)->first();
        if ($user === null) {
            $new_user = new User;
            $new_user->fb_user_id = $fb_user_id;
            $new_user->save();
        }

        return redirect()->action('PagesController@getWelcome');
    }
}
