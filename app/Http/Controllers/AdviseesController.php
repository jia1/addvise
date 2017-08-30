<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SammyK;

class AdviseesController extends Controller {
    // CREATE: View for creating a request for advice
    public function getTakeAdviceNew() {
        return view('advisees.requests.new');
    }

    // CREATE: Create a request for advice
    public function postTakeAdviceCreate(Request $request, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $message = $request->get('message');
        $is_anonymous = $request->get('is_anonymous');

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);

        if (! $access_token) {
            Log::info('$access_token is false');
        } else {
            try {
                $response = $fb->post('/addvise/feed', ['message' => $message], $access_token);
                // Add response information to database from here
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
                Log::info($e->getMessage());
            }
        }

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

