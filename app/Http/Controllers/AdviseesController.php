<?php

namespace App\Http\Controllers;

use App\AdviceRequest;
use Illuminate\Http\Request;
use Log;
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
        $label = $request->get('label');

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $feed_uri = env('FACEBOOK_PAGE_FEED_URI', false);

        if (! $access_token || ! $feed_uri) {
            ;
        } else {
            try {
                $response = $fb->post($feed_uri, ['message' => $message], $access_token);
                $response_array = $response->getDecodedBody();

                if (! array_key_exists('id', $response_array)) {
                    // Handle exception
                }

                $fb_id = $response_array['id'];

                // Add created #needAddvise to database
                $advice_request = new AdviceRequest;
                $advice_requets->label = $label;
                $advice_request->fb_post_id = explode('_', $fb_id)[1];
                $advice_request->fb_user_id = \Request::get('fb_user_id');
                $advice_request->save();
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        // Placeholder logic
        return redirect()->action('PagesController@getWelcome');
    }

    // READ: View for showing all requests made by the user, plus their advice
    public function getTakeAdviceIndex(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $advice_requests = [];

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $feed_uri = env('FACEBOOK_PAGE_FEED_URI', false);

        if (! $access_token || ! $feed_uri) {
            ;
        } else {
            try {
                $response = $fb->get($feed_uri . '?fields=created_time,message,id,comments.summary(true)&limit=10',
                    $access_token);
                $response_array = $response->getDecodedBody();

                if (! array_key_exists('data', $response_array)) {
                    // Handle exception
                }

                $data = $response_array['data'];
                foreach ($data as $key=>$val) {
                    if (array_key_exists('message', $data[$key])) {
                        $advice_requests[$key] = [];
                        $advice_requests[$key]['created_time'] = $val['created_time'];
                        $advice_requests[$key]['message'] = $val['message'];
                        $advice_requests[$key]['id'] = $val['id'];
                        $advice_requests[$key]['comments'] = [];
                        foreach ($val['comments']['data'] as $c_key=>$c_val) {
                            $advice_requests[$key]['comments'][$c_key] = $c_val['message'];
                        }
                        $advice_requests[$key]['comment_count'] = $val['comments']['summary']['total_count'];
                    }
                }
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        Log::info($advice_requests);
        return view('advisees.requests.index', ['advice_requests' => json_encode($advice_requests)]);
    }

    // READ: View for showing a specific request made by the user, plus its advice
    public function getTakeAdviceShow(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $advice_requests = [];
        $fb_post_ids = AdviceRequest::select('fb_post_id')->where('fb_user_id', \Request::get('fb_user_id'))
            ->take(10)->get()->toArray();

        $fb_page_id = env('FACEBOOK_PAGE_ID', false);

        if (! $fb_page_id) {
            // Handle exception
        }

        $fb_post_ids_full = array_map(function ($arr) use ($fb_page_id) {
            return $fb_page_id . $arr['fb_post_id'];
        }, $fb_post_ids);

        $serialized_ids = implode(',', $fb_post_ids_full);

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $feed_uri = env('FACEBOOK_PAGE_FEED_URI', false);

        if (! $access_token || ! $feed_uri) {
            ;
        } else {
            try {
                $response = $fb->get('?fields=created_time,message,id,comments.summary(true)&ids=' . $serialized_ids,
                    $access_token);
                $data = $response->getDecodedBody();

                foreach ($data as $key=>$val) {
                    if (array_key_exists('message', $data[$key])) {
                        $advice_requests[$key] = [];
                        $advice_requests[$key]['created_time'] = $val['created_time'];
                        $advice_requests[$key]['message'] = $val['message'];
                        $advice_requests[$key]['id'] = $val['id'];
                        $advice_requests[$key]['comments'] = [];
                        foreach ($val['comments']['data'] as $c_key=>$c_val) {
                            $advice_requests[$key]['comments'][$c_key] = $c_val['message'];
                        }
                        $advice_requests[$key]['comment_count'] = $val['comments']['summary']['total_count'];
                    }
                }
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        return view('advisees.requests.show', ['advice_requests' => json_encode($advice_requests)]);
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

