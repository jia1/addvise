<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class FacebookWebhooksController extends Controller
{
    public function notify(Request $request) {
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

                        return response('OK', 200);
                    }
                }
            }
        }
        return response('Unauthorized', 401)
            ->header('Content-Type', 'text/plain');
    }
}
