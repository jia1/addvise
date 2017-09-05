<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\AdviceRequest;
use Illuminate\Http\Request;
use Log;
use SammyK;

class AdviseesController extends Controller {

    // CREATE: Create a request for advice
    public function postTakeAdviceCreate(Request $request, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        // Form values
        $is_anonymous = $request->get('is_anonymous');
        $label = $request->get('label');
        $message = $request->get('message');

        // Environment variables
        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $fb_page_id = env('FACEBOOK_PAGE_ID', false);

        if (! $access_token || ! $fb_page_id) {
            // Handle corner case

        } else {
            try {
                $response = $fb->post($fb_page_id . '/feed', ['message' => $message], $access_token);
                $response_array = $response->getDecodedBody();

                if (! array_key_exists('id', $response_array)) {
                    // Handle corner case: E.g. Facebook server is down
                }

                $fb_id = $response_array['id'];

                // Add created #needAddvise to database
                $advice_request = new AdviceRequest;
                $advice_request->label = $label;
                $advice_request->is_anonymous = ($is_anonymous? true : false);
                $advice_request->fb_post_id = explode('_', $fb_id)[1];
                $advice_request->fb_user_id = \Request::get('fb_user_id');
                $advice_request->save();

            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        return redirect()->action('PagesController@getWelcome');
    }

    // READ: View for showing all (10) requests, plus their advice
    public function getTakeAdviceIndex(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        // Data to be passed to the view
        $advice_requests = [];

        // Environment variables
        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $fb_page_id = env('FACEBOOK_PAGE_ID', false);

        if (! $access_token || ! $fb_page_id) {
            // Handle corner case

        } else {
            try {
                $response = $fb->get($fb_page_id . '/feed?fields=created_time,message,id,comments.summary(true)&limit=10',
                    $access_token);
                $response_array = $response->getDecodedBody();

                if (! array_key_exists('data', $response_array)) {
                    // Handle corner case
                }

                $data = $response_array['data'];
                foreach ($data as $key=>$val) {
                    if (array_key_exists('message', $data[$key])) {
                        $advice_requests[$key] = [];
                        $advice_requests[$key]['created_time'] = Carbon::parse($val['created_time'])->diffForHumans();
                        $advice_requests[$key]['message'] = $val['message'];
                        $advice_requests[$key]['fb_post_id'] = $val['id'];
                        $advice_requests[$key]['comments'] = [];
                        foreach ($val['comments']['data'] as $c_key=>$c_val) {
                            $advice_requests[$key]['comments'][$c_key] = $c_val['message'];
                        }
                        $advice_requests[$key]['comment_count'] = $val['comments']['summary']['total_count'];

                        $advice_request_from_db = AdviceRequest::select(['id', 'fb_user_id', 'is_anonymous', 'label'])
                            ->where('fb_post_id', explode('_', $val['id'])[1])->first();
                        
                        $advice_requests[$key]['advice_request_id'] = null;
                        $advice_requests[$key]['fb_user_id'] = null;
                        $advice_requests[$key]['label'] = 0;

                        if (! $advice_request_from_db) {
                            ;
                        } else {
                            if (! $advice_request_from_db->value('is_anonymous')) {
                                $advice_requests[$key]['fb_user_id'] = $advice_request_from_db->value('fb_user_id');
                            }
                            $advice_requests[$key]['label'] = $advice_request_from_db->value('label');
                            $advice_requests[$key]['advice_request_id'] = $advice_request_from_db->value('id');
                        }
                    }
                }
            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        return view('needAddvise_index', ['advice_requests' => json_encode($advice_requests)]);
    }

    // READ: View for showing all (10) requests made by the user, plus their advice
    public function getTakeAdviceShowByUser(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        // Data to be passed to the view
        $advice_requests = [];

        // Fetch fb_post_id from database
        $fb_post_rows = AdviceRequest::select(['fb_post_id', 'label'])
            ->where('fb_user_id', \Request::get('fb_user_id'))
            ->take(10)->get();

        if (! $fb_post_rows) {
            ;
        } else {
            $fb_post_rows_arr = $fb_post_rows->toArray();
            $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
            $fb_page_id = env('FACEBOOK_PAGE_ID', false);

            if (! $access_token || ! $fb_page_id) {
                // Handle corner case

            } else {
                try {
                    $fb_post_ids_full = array_map(function ($arr) use ($fb_page_id) {
                        return $fb_page_id . '_' .  $arr['fb_post_id'];
                    }, $fb_post_rows_arr);
                    $serialized_ids = implode(',', $fb_post_ids_full);

                    $response = $fb->get('?fields=created_time,message,id,comments.summary(true)&ids=' . $serialized_ids,
                        $access_token);
                    $data = $response->getDecodedBody();

                    foreach ($data as $key=>$val) {
                        if (array_key_exists('message', $data[$key])) {
                            $advice_requests[$key] = [];
                            $advice_requests[$key]['created_time'] = Carbon::parse($val['created_time'])->diffForHumans();
                            $advice_requests[$key]['message'] = $val['message'];
                            $advice_requests[$key]['fb_post_id'] = $val['id'];
                            $advice_requests[$key]['comments'] = [];
                            foreach ($val['comments']['data'] as $c_key=>$c_val) {
                                $advice_requests[$key]['comments'][$c_key] = $c_val['message'];
                            }
                            $advice_requests[$key]['comment_count'] = $val['comments']['summary']['total_count'];
                        }
                    }

                    $i = 0;
                    foreach ($advice_requests as $key=>$val) {
                        $advice_requests[$key]['label'] = $fb_post_rows_arr[$i++]['label'];
                    }
                } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                    dd($e->getMessage());
                }
            }
        }

        return view('needAddvise_me', ['advice_requests' => json_encode($advice_requests)]);
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

