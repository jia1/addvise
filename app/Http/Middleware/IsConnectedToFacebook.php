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
                $token = $fb->getJavaScriptHelper()->getAccessToken();
            }
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            $request->session()->flash('error', $e->getMessage());
            return redirect()->action('PagesController@getWelcome');
        }

        Log::info('Middleware IsConnectedToFacebook: Checking token from JavaScript...');

        if (! isset($token)) {
            $request->session()->flash('error', 'We could not get your access token. Please login again!');
            return redirect()->action('PagesController@getWelcome');
        }

        if (gettype($token) !== 'string' && ! $token->isLongLived()) {
            $oauth_client = $fb->getOAuth2Client();
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                $request->session()->flash('error', $e->getMessage());
                return redirect()->action('PagesController@getWelcome');
            }
        }

        Log::info('Middleware IsConnectedToFacebook: Setting default accss token to long-lived token...');

        $fb->setDefaultAccessToken($token);
        Session::put('fb_user_access_token', (string) $token);

        Log::info('Middleware IsConnectedToFacebook: Querying /me...');

        try {
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
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            $request->session()->flash('error', $e->getMessage() . ' Please login again.');
            return redirect()->action('PagesController@getWelcome');
        }

        Log::info('Middleware IsConnectedToFacebook: Passing user ID and token to $next...');

        $request->attributes->add(['fb_user_id' => $fb_user_id, 'fb_user_token' => $token]);
        return $next($request);
    }
}
