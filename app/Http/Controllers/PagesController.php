<?php

namespace App\Http\Controllers;

use DB;
use Redis;
use SammyK;

class PagesController extends Controller {
    // READ: Welcome page for everyone
    public function getWelcome(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        return view('welcome');
    }

    public function getHome() {
        $db_arr = Redis::info()['Keyspace'];
        $num_recent_advisees = 0;
        if (count($db_arr) > 0) {
            foreach ($db_arr as $db_name=>$db_stat) {
                $num_recent_advisees += count($db_stat['keys']);
            }
        }
        $num_users = DB::table('users')->count();
        $num_advice_requests = DB::table('advice_requests')->count();
        $num_advice_given = DB::table('advice_given')->count(); 
        return view('home', [
            'num_recent_advisees' => $num_recent_advisees,
            'num_users' => $num_users,
            'num_advice_requests' => $num_advice_requests,
            'num_advice_given' => $num_advice_given,
        ]);
    }

    public function getAsk(){
        return view('ask');
    }

    public function getMe(){
        return view('me');
    }

    // READ: Addvise Policies
    public function getPolicy() {
        return view('policy');
    }

    // READ: No JS
    public function getNoJS() {
        return view('nojs');
    }
}

