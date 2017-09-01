<?php

namespace App\Http\Controllers;

use App\AdviceRequest;
use App\AdviceGiven;
use Illuminate\Http\Request;
use Log;
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
    public function getGiveAdviceShow(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $advice_requests = [];
        $fb_post_ids = AdviceGiven::select('fb_post_id')->where('fb_user_id', \Request::get('fb_user_id'))
            ->take(10)->get()->toArray();

        $fb_page_id = env('FACEBOOK_PAGE_ID', false);

        if (! $fb_page_id) {
            ;
        }

        $fb_post_ids_full = array_map(function ($arr) use ($fb_page_id) {
            return $fb_page_id . $arr['fb_post_id'];
        }, $fb_post_ids);

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $feed_uri = env('FACEBOOK_PAGE_FEED_URI', false);

        if (! $fb_post_ids_full || ! $access_token || ! $feed_uri) {
            ;
        } else {
            try {
                $serialized_ids = implode(',', $fb_post_ids_full);


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

