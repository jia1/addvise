<?php

namespace App\Http\Controllers;

class PagesController extends Controller {
    // READ: Welcome page for everyone
    public function getWelcome() {
        return view('welcome');
    }

    // REDIRECT: Landing page for users after logging in
    public function getHome() {
        return view('home');
    }

    // UPDATE: Settings page for users
    public function getSettings() {
        return view('settings');
    }

    // UPDATE: Policy Page
    public function getPolicy() {
        return view('policy');
    }

    // UPDATE: No JS
    public function getNoJS() {
        return view('nojs');
    }
}

