<?php

namespace App\Http\Controllers;

use App\AdviceRequest;
use Illuminate\Http\Request;
use Log;
use SammyK;

class FacebookWebhooksController extends Controller
{
    public function notify(Request $request, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        if (\Request::isMethod('get')) {
            $mode = $request->input('hub_mode');
            $challenge = $request->input('hub_challenge');
            $verify_token = $request->input('hub_verify_token');
            if ($verify_token === env('FACEBOOK_WEBHOOK_VERIFY_TOKEN', '')) {
                return response($challenge, 200);
            }
        } else {
            if (\Request::isMethod('post')) {
                if ($request->header('Content-Type') === 'application/json') {
                    $sha1_header = $request->header('X-Hub-Signature');
                    $sha1_signature = substr($sha1_header, 5);
                    if ($sha1_signature === sha1(env('FACEBOOK_APP_SECRET', ''))) {
                        $request_arr = $request->json()->all();
                        if (array_key_exists('object', $request_arr)) {
                            if ($request_arr['object'] === 'page') {
                                $fb_post_id_arr = [];
                                foreach ($request_arr['entry'] as $entry) {
                                    foreach ($entry['changes'] as $change) {
                                        if ($change['field'] === 'feed') {
                                            if ($change['value']['verb'] === 'add') {
                                                $fb_post_id = $change['value']['post_id'];
                                                array_push($fb_post_id_arr, explode('_', $fb_post_id));
                                            }
                                        }
                                    }
                                }
                                $fb_user_id_rows = AdviceRequest::select('fb_post_id', 'fb_user_id')->whereIn('fb_post_id', $fb_post_id_arr)->get();
                                if (! $fb_user_id_rows) {
                                    ;
                                } else {
                                    $fb_id_arr = $fb_user_id_rows->toArray();
                                    $fb_user_id_arr = array_map(function ($arr) {
                                        return $arr['fb_user_id'];
                                    }, $fb_id_arr);
                                    $serialized_fb_user_ids = implode(',', $fb_user_id_arr);
                                    $response = $fb->get('?fields=email&ids=' . $serialized_fb_user_ids);
                                    $fb_users = $response->getDecodedBody();
                                    foreach ($fb_users as $fb_user_id=>$fb_user) {
                                        if (array_key_exists('email', $fb_user)) {
                                            if (! $fb_user['email']) {
                                                ;
                                            } else {
                                                // Email the user
                                            }
                                        }
                                    }
                                }
                                return response('OK', 200);
                            } else {
                                ;
                                return response('OK', 200);
                            }
                        }
                    }
                }
            }
        }
        return response('Unauthorized', 401)
            ->header('Content-Type', 'text/plain');
    }
}
