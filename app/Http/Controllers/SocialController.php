<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\SocialAccount;
use App\Models\User;
use Auth;
use Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();

        $provider = [
            'provider_id' => $userSocial->getId(),
            'provider' => $provider,
        ];

        if ($user) {
            $user->socialAccounts()->updateOrCreate($provider);
            Auth::login($user);
        } else {
            $profile = [
                'first_name' => $userSocial->getName(),
                'last_name' => '',
                'avatar' => $userSocial->getAvatar(),
            ];

            $user = User::create([
                'email' => $userSocial->getEmail(),
                'status' => User::ACTIVE,
            ]);

            $user->profile()->save(new Profile($profile));
            $user->socialAccounts()->save(new SocialAccount($provider));
            Auth::login($user);
        }

        return redirect('/');
    }
}
