<?php

namespace App\Http\Controllers;

class AdviseesController extends Controller {
    // CREATE: View for creating a request for advice
    public function getTakeAdviceNew() {
        return view('advisees.requests.new');
    }

    // CREATE: Create a request for advice
    public function postTakeAdviceCreate() {
        // Placeholder logic
        return redirect()->action('PagesController@getWelcome');
    }

    // READ: View for showing all requests made by the user, plus their advice
    public function getTakeAdviceIndex() {
        ;
    }

    // READ: View for showing a specific request made by the user, plus its advice
    public function getTakeAdviceShow() {
        ;
    }

    // UPDATE: View for editing and updating a specific request made by the user previously
    public function getTakeAdviceEdit() {
        ;
    }

    // UPDATE: Update a specific request made by the user previously
    public function putTakeAdviceUpdate() {
        ;
    }

    // DELETE: Delete a specific request made by the user previously
    public function deleteTakeAdviceDelete() {
        ;
    }
}

