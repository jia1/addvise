<?php

namespace App\Http\Controllers;

use App\AdviceRequest;
use App\AdviceGiven;
use Log;
use Request;
use SammyK;

class AdvisorsController extends Controller {
    // CREATE: View for creating an advice in response to a request for advice
    public function getGiveAdviceNew($id, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $fb_post_id = AdviceRequest::where('id', $id)->first()->value('fb_post_id');

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $fb_page_id_uri = env('FACEBOOK_PAGE_ID_URI', false);

        if (! $fb_post_id) {
            ;
        } else {
            try {
                $response = $fb->get($fb_page_id_uri . $fb_post_id, $access_token);
                $response_array = $response->getDecodedBody();

                if (! array_key_exists('message', $response_array)) {
                    // Handle exception
                }

                $fb_post_message = $response_array['message'];
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        return view('advisors.advice.new', ['advice_request_id' => $id, 'advice_request_message' => $fb_post_message]);
    }

    // CREATE: Create an advice
    public function postGiveAdviceCreate($id, Request $request, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $advice_request_id = $id;
        $fb_post_id = AdviceRequest::where('id', $advice_request_id)->first()->value('fb_post_id');

        $message = $request->get('message');
        $is_anonymous = $request->get('is_anonymous');

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $fb_page_id_uri = env('FACEBOOK_PAGE_ID_URI', false);

        if (! $access_token || ! $fb_page_id_uri) {
            ;
        } else {
            try {
                $response = $fb->post($fb_page_id_uri . $fb_post_id . '/comments', ['message' => $message], $access_token);
                $response_array = $response->getDecodedBody();

                if (! array_key_exists('id', $response_array)) {
                    // Handle exception
                }

                $fb_id = $response_array['id'];

                // Add created advice to database
                $advice_given = new AdviceGiven;
                $advice_given->fb_comment_id = explode('_', $fb_id)[1];
                $advice_given->fb_post_id = $fb_post_id;
                $advice_given->fb_user_id = \Request::get('fb_user_id');
                $advice_given->save();
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
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

