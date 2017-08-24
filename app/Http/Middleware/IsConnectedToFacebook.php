<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Log;

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
        Log::info('Executing middleware IsConnectedToFacebook');
        try {
            $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
            $token = $fb->getJavaScriptHelper()->getAccessToken();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            Log::info($e->getMessage());
            // Failed to obtain access token
            dd($e->getMessage());
        }

        // $token will be null if no cookie was set or no OAuth data
        // was found in the cookie's signed request data
        if (! $token) {
            Log::info('No cookie found from JavaScriptHelper');
            // User hasn't logged in using the JS SDK yet
            return redirect('/');
        }

        return $next($request);
    }
}
