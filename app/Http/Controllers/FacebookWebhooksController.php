<?php

namespace App\Http\Controllers;

use App\AdviceRequest;
use App\Mail\FacebookWebhookNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Log;
use SammyK;

class FacebookWebhooksController extends Controller
{
    public function notify(Request $request, SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
        if (\Request::isMethod('get')) {
            Log::info('FBWebhooksC: /GET');
            $mode = $request->input('hub_mode');
            $challenge = $request->input('hub_challenge');
            $verify_token = $request->input('hub_verify_token');
            if ($verify_token === env('FACEBOOK_WEBHOOK_VERIFY_TOKEN', '')) {
                return response($challenge, 200);
            }
        } else {
            if (\Request::isMethod('post')) {
                Log::info('FBWebhooksC: /POST');
                if ($request->header('Content-Type') === 'application/json') {
                    $sha1_header = $request->header('X-Hub-Signature');
                    $sha1_signature = substr($sha1_header, 5);
                    $request_arr = $request->json()->all();
                    $server_signature = hash_hmac('sha1', json_encode($request_arr), env('FACEBOOK_APP_SECRET', ''), 0);
                    Log::info('FBWebhooksC: From FB - ' . $sha1_signature);
                    Log::info('FBWebhooksC: From me - ' . $server_signature);
                    if (true || $sha1_signature === $server_signature) {
                        Log::info($request_arr);
                        if (array_key_exists('object', $request_arr)) {
                            if ($request_arr['object'] === 'page') {
                                $fb_post_id_arr = [];
                                foreach ($request_arr['entry'] as $entry) {
                                    foreach ($entry['changes'] as $change) {
                                        if ($change['field'] === 'feed') {
                                            if ($change['value']['verb'] === 'add') {
                                                $fb_post_id = $change['value']['post_id'];
                                                Log::info('FBWebhooksC: $fb_post_id - ' . $fb_post_id);
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
                                                Mail::to($fb_user['email'])
                                                    ->cc('jiayeerawr@gmail.com')
                                                    ->queue('$advice_request_id', '$fb_post_id', '$message');
                                            }
                                        }
                                    }
                                }
                                return response('OK', 200);
                            } else {
                                if ($request_arr['object'] === 'permissions') {
                                    foreach ($request_arr['entry'] as $change) {
                                        foreach ($change['changed_fields'] as $i=>$field) {
                                            if ($field === 'email') {
                                                Log::info('FBWebhooksC: $field - ' . $field);
                                                // Check verb
                                            }
                                        }
                                    }
                                    return response('OK', 200);
                                }
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
