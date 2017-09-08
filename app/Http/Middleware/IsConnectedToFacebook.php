<?php

namespace App\Http\Middleware;

use Closure;
use App;
use App\User;
use Log;
use SammyK;
use Session;

class IsConnectedToFacebook
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info('Middleware IsConnectedToFacebook: Executing...');

        try {
            $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
            $token = Session::get('fb_user_access_token');

            if (! isset($token)) {
                // $token = $fb->getAccessTokenFromRedirect();
                $token = $fb->getJavaScriptHelper()->getAccessToken();
            }
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            $request->session()->flash('error', 'We are sorry to have befriended the FacebookSDKException. Please give us a moment to unfriend it.');
            return redirect()->action('PagesController@getWelcome');
        }

        if (! isset($token)) {
            /*
            $helper = $fb->getRedirectLoginHelper();
            if (! $helper->getError()) {
                abort(403, 'Forbidden');
            }
            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
            );
             */
            return redirect()->action('PagesController@getWelcome');
        }

        if (gettype($token) !== 'string' && ! $token->isLongLived()) {
            $oauth_client = $fb->getOAuth2Client();
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                $request->session()->flash('error', 'We are sorry to have befriended the FacebookSDKException. Please give us a moment to unfriend it.');
                return redirect()->action('PagesController@getWelcome');
            }
        }

        $fb->setDefaultAccessToken($token);
        Session::put('fb_user_access_token', (string) $token);

        $m_response = $fb->get('/me');
        $m_response_arr = $m_response->getDecodedBody();
        if (! array_key_exists('id', $m_response_arr)) {
            ;
        } else {
            $fb_user_id = $m_response_arr['id'];
            $user = User::where('fb_user_id', $fb_user_id)->first();
            if (! $user) {
                $new_user = new User;
                $new_user->fb_user_id = $fb_user_id;
                $new_user->save();
            }
        }

        $request->attributes->add(['fb_user_id' => $fb_user_id, 'fb_user_token' => $token]);
        return $next($request);
    }
}
