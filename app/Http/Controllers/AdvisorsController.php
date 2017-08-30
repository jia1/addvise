<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SammyK;

class AdvisorsController extends Controller {
    // CREATE: View for creating an advice in response to a request for advice
    public function getGiveAdviceNew() {
        ;
    }

    // CREATE: Create an advice
    public function postGiveAdviceCreate(Request $request, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $advice_request_id = $request->input('id');
        // Get $fb_post_id from database, given $advice_request_id
        // $fb_post_id =

        $message = $request->get('message');
        $is_anonymous = $request->get('is_anonymous');

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $fb_page_id_uri = env('FACEBOOK_PAGE_ID_URI', false);

        if (! $access_token || ! $feed_uri) {
            Log::info('CREATE: No $access_token or $feed_uri in .env');
        } else {
            try {
                $response = $fb->post($fb_page_id_uri . $fb_post_id, ['message' => $message], $access_token);
                // $response consists of {"id": 960210}
                // Add response information to database from here
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
                Log::info($e->getMessage());
            }
        }

        // Placeholder logic
        return redirect()->action('PagesController@getWelcome');
    }

    // READ: View for showing all advice given by the user previously
    public function getGiveAdviceIndex() {
        ;
    }

    // READ: View for showing a specific advice given by the user previously
    public function getGiveAdviceShow() {
        ;
    }

    // UPDATE: View for editing and updating a specific advice given by the user previously
    public function getGiveAdviceEdit() {
        ;
    }

    // UPDATE: Update a specific advice given by the user previously
    public function putGiveAdviceUpdate() {
        ;
    }

    // DELETE: Delete a specific advice given by the user previously
    public function deleteGiveAdviceDelete() {
        ;
    }
}

