<?php

namespace App\Http\Controllers;

use App\AdviceRequest;
use App\AdviceGiven;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;
use SammyK;

class AdvisorsController extends Controller {
    // CREATE: View for creating an advice in response to a request for advice
    public function getGiveAdviceNew($id, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $fb_post_id = AdviceRequest::where('id', $id)->first()->fb_post_id;

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $fb_page_id = env('FACEBOOK_PAGE_ID', false);

        if (! $fb_post_id) {
            ;
        } else {
            try {
                $response = $fb->get($fb_page_id . '_' . $fb_post_id, $access_token);
                $response_array = $response->getDecodedBody();

                if (! array_key_exists('message', $response_array)) {
                    // Handle corner case
                }

                $fb_post_message = $response_array['message'];

            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                $request->session()->flash('status', $e->getMessage());
                redirect()->action('PagesController@getWelcome');
            }
        }

        return view('needAddvise_advice_new', ['advice_request_id' => $id, 'advice_request_message' => $fb_post_message]);
    }

    // CREATE: Create an advice
    public function postGiveAdviceCreate($id, Request $request, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $advice_request_id = $id;
        $fb_post_id = AdviceRequest::where('id', $advice_request_id)->first()->fb_post_id;

        $message = $request->get('message');
        $is_anonymous = $request->get('is_anonymous');

        $access_token = env('FACEBOOK_PAGE_ACCESS_TOKEN', false);
        $fb_page_id = env('FACEBOOK_PAGE_ID', false);

        if (! $access_token || ! $fb_page_id) {
            ;
        } else {
            try {
                $response = $fb->post($fb_page_id . '_' . $fb_post_id . '/comments', ['message' => $message], $access_token);
                $response_array = $response->getDecodedBody();

                if (! array_key_exists('id', $response_array)) {
                    // Handle corner case
                }

                $fb_id = $response_array['id'];

                // Add created advice to database
                $advice_given = new AdviceGiven;
                $advice_given->is_anonymous = ($is_anonymous? true : false);
                $advice_given->fb_comment_id = explode('_', $fb_id)[1];
                $advice_given->fb_post_id = $fb_post_id;
                $advice_given->fb_user_id = \Request::get('fb_user_id');
                $advice_given->save();

            } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                $request->session()->flash('status', $e->getMessage());
                redirect()->action('PagesController@getWelcome');
            }
        }

        $request->session()->flash('status', 'Your advice is up! One advice a day keeps the doctor away!');
        return redirect()->action('PagesController@getWelcome');
    }

    // READ: View for showing all advice given
    public function getGiveAdviceIndex() {
        ;
    }

    // READ: View for showing all advice given by the user previously
    public function getGiveAdviceShowByUser(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        $advice_requests = [];
        $fb_post_rows = AdviceGiven::select('fb_post_id')
            ->where('fb_user_id', \Request::get('fb_user_id'))
            ->orderBy('id', 'desc')
            ->take(10)->get();

        $fb_page_id = env('FACEBOOK_PAGE_ID', false);

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

                    if (! array_key_exists('data', $data)) {
                        // Handle corner case
                    }

                    foreach ($data as $key=>$val) {
                        $advice_requests[$key] = [];
                        $advice_requests[$key]['created_time'] = Carbon::parse($val['created_time'])->diffForHumans();
                        $advice_requests[$key]['message'] = $val['message'];
                        $advice_requests[$key]['fb_post_id'] = $val['id'];
                        $advice_requests[$key]['comment_count'] = $val['comments']['summary']['total_count'];

                        $advice_requests[$key]['comments'] = [];
                        foreach ($val['comments']['data'] as $c_key=>$c_val) {
                            $fb_comment_row = AdviceGiven::select('fb_user_id')
                                ->where('fb_comment_id', explode('_', $c_val['id'])[1])
                                ->first();

                            if (! $fb_comment_row) {
                                ;
                            } else {
                                if ($fb_comment_row->fb_user_id == \Request::get('fb_user_id')) {
                                    $advice_requests[$key]['comments'][$c_key] = $c_val['message'];
                                }
                            }
                        }

                        $advice_request_from_db = AdviceRequest::select('id', 'fb_user_id', 'is_anonymous', 'label')
                            ->where('fb_post_id', explode('_', $val['id'])[1])
                            ->first();

                        $advice_requests[$key]['advice_request_id'] = null;
                        $advice_requests[$key]['fb_user_id'] = null;
                        $advice_requests[$key]['label'] = 0;
                        if (! $advice_request_from_db) {
                            ;
                        } else {
                            if (! $advice_request_from_db->is_anonymous) {
                                $advice_requests[$key]['fb_user_id'] = $advice_request_from_db->fb_user_id;
                            }
                            $advice_requests[$key]['label'] = $advice_request_from_db->label;
                            $advice_requests[$key]['advice_request_id'] = $advice_request_from_db->id;
                        }
                    }

                } catch(\Facebook\Exceptions\FacebookSDKException $e) {
                    dd($e->getMessage());
                } catch(\Facebook\Exceptions\FacebookResponseException $e) {
                    $request->session()->flash('status', $e->getMessage());
                    redirect()->action('PagesController@getWelcome');
                }
            }
        }

        return view('needAddvise_advice_me', ['advice_requests' => json_encode($advice_requests)]);
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

