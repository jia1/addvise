<?php

namespace App\Http\Controllers;

class PagesController extends Controller {
    // READ: Welcome page for everyone
    public function getWelcome() {
        return view('welcome');
    }

    public function getHome() {
        return view('home');
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

