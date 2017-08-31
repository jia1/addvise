<?php

namespace App\Http\Controllers;

use App\AdviceRequest;
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
        $feed_uri = env('FACEBOOK_PAGE_FEED_URI', false);

        if (! $access_token || ! $feed_uri) {
            Log::info('CREATE: No $access_token or $feed_uri in .env');
        } else {
            try {
                $response = $fb->post($feed_uri, ['message' => $message], $access_token);
                $fb_id = $response->getDecodedBody()['id'];

                // Add created #needAddvise to database
                $advice_request = new AdviceRequest;
                $advice_request->facebook_post_id = explode('_', $fb_id)[1];
                $advice_request->facebook_user_id = \Request::get('fb_user_id');
                $advice_request->save();
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
                Log::info($e->getMessage());
            }
        }

        // Placeholder logic
        return redirect()->action('PagesController@getWelcome');
    }

    // READ: View for showing all requests made by the user, plus their advice
    public function getTakeAdviceIndex(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $data = [];

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $feed_uri = env('FACEBOOK_PAGE_FEED_URI', false);

        if (! $access_token || ! $feed_uri) {
            Log::info('INDEX: No $access_token or $feed_uri in .env');
        } else {
            try {
                $response = $fb->get($feed_uri . '?fields=message&until=now&since=-2weeks&limit=14', $access_token);
                $data = $response->getDecodedBody()['data'];
                $advice_requests = [];
                foreach ($data as $key=>$val) {
                    if (array_key_exists('message', $data[$key])) {
                        array_push($advice_requests, $val['message']);
                    }
                }
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
                Log::info($e->getMessage());
            }
        }

        return view('advisees.requests.index', ['advice_requests' => json_encode($advice_requests)]);
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

