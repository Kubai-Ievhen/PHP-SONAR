<?php

namespace App\Api\V1\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SocialAccount;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class SocialController
 * @package App\Http\Controllers\Auth
 */
class SocialController extends Controller
{
    /**
     * @param string $provider
     * @return RedirectResponse
     */
    public function redirectToProvider(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param string $provider
     * @param JWTAuth $jwt
     * @return RedirectResponse
     * @throws \Exception
     */
    public function handleProviderCallback(string $provider, JWTAuth $jwt): RedirectResponse
    {
        $meta = [];

        $meta['provider'] = $provider;

        $socialUser = Socialite::driver($provider)->user();

        $providerData = array_merge(compact('provider'), [
            'provider_id' => $socialUser->getId(),
        ]);

        $account = SocialAccount::where($providerData)->first();

        $meta['action'] = empty($account) ? 'signup' : 'login';

        if ($account) {
            $account->avatar = $socialUser->getAvatar();
            $account->save();
            $user = $account->user;
            $meta['email-address'] = $user->email;
        } else {
            $account = new SocialAccount(array_merge($providerData, [
                'avatar' => $socialUser->getAvatar(),
            ]));

            $defaultEmail = $socialUser->getId() . '@' . $provider . 'com';
            $email = $socialUser->getEmail() ?: $defaultEmail;
            $user = User::whereEmail($email)->first();

            if (! $user) {
                $user = User::create([
                    'name' => $socialUser->getName() ?: $socialUser->getNickName(),
                    'email' => $email,
                    'password' => Uuid::uuid4(),
                    'verified' => true,
                ]);
            }

            $meta['email-address'] = $email;
            $account->user()->associate($user);
            $account->save();
        }

        $domain = config('defaults.env.spa.url');
        $path = '/auth/social-login';

        return redirect()->away($domain . $path . '?' . http_build_query([
                    'token' => $jwt->fromUser($user),
                ] + $meta));
    }
}